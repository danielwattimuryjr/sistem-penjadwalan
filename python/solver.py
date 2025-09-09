from datetime import datetime, timedelta
from pulp import *
from typing import List, Dict, Any

class ClubScheduler:
    def __init__(self, min_players: int = 4):  # Reduced default to 2 for testing
        self.min_players = min_players
        self.day_mapping = {
            'Monday': 0, 'Tuesday': 1, 'Wednesday': 2, 'Thursday': 3,
            'Friday': 4, 'Saturday': 5, 'Sunday': 6
        }
        self.reverse_day_mapping = {v: k for k, v in self.day_mapping.items()}

    def get_next_week_dates(self):
        """Generate dates for next week starting from next Monday"""
        today = datetime.now()
        days_ahead = 7 - today.weekday()  # Days until next Monday
        next_monday = today + timedelta(days=days_ahead)

        week_dates = {}
        for i in range(7):
            date = next_monday + timedelta(days=i)
            day_name = self.reverse_day_mapping[i]
            week_dates[day_name] = date.strftime('%Y-%m-%d')

        return week_dates

    def parse_time_slots(self, data: Dict[str, Any]):
        """Parse available time slots for players and courts"""
        time_slots = []
        player_availability = {}
        court_availability = {}

        # Process players
        for player in data['players']:
            player_id = player['id']
            player_availability[player_id] = []

            for avail in player['availabilities']:
                day = avail['day_of_week']
                start_time = avail['start_time']
                end_time = avail['end_time']

                slot = (day, start_time, end_time)
                if slot not in time_slots:
                    time_slots.append(slot)

                player_availability[player_id].append(slot)

        # Process courts
        for court in data['courts']:
            court_id = court['id']
            court_availability[court_id] = []

            for avail in court['availabilities']:
                day = avail['day_of_week']
                start_time = avail['start_time']
                end_time = avail['end_time']

                slot = (day, start_time, end_time)
                if slot not in time_slots:
                    time_slots.append(slot)

                court_availability[court_id].append(slot)

        return time_slots, player_availability, court_availability

    def create_schedule(self, data: Dict[str, Any]) -> List[Dict[str, Any]]:
        """Create optimal schedule using linear programming"""

        # Parse data
        time_slots, player_availability, court_availability = self.parse_time_slots(data)
        players = [p['id'] for p in data['players']]
        courts = [c['id'] for c in data['courts']]

        print(f"Debug - Time slots: {time_slots}")
        print(f"Debug - Players: {players}")
        print(f"Debug - Courts: {courts}")

        # Create the problem
        prob = LpProblem("Club_Scheduling", LpMaximize)

        # Decision variables
        # x[p][c][s] = 1 if player p plays on court c in slot s
        x = {}
        for p in players:
            for c in courts:
                for s in time_slots:
                    x[(p, c, s)] = LpVariable(f"x_{p}_{c}_{s}", cat='Binary')

        # y[s] = 1 if slot s is used
        y = {}
        for s in time_slots:
            y[s] = LpVariable(f"y_{s}", cat='Binary')

        # Objective: Prioritize using all viable slots, then maximize participation
        slot_usage = lpSum([y[s] for s in time_slots])
        total_sessions = lpSum([x[(p, c, s)] for p in players for c in courts for s in time_slots])
        prob += 100 * slot_usage + total_sessions

        # Constraints

        # 1. Player availability constraint
        for p in players:
            for c in courts:
                for s in time_slots:
                    if s not in player_availability[p]:
                        prob += x[(p, c, s)] == 0

        # 2. Court availability constraint
        for c in courts:
            for p in players:
                for s in time_slots:
                    if s not in court_availability[c]:
                        prob += x[(p, c, s)] == 0

        # 3. Each player can only be in one place at a time
        for p in players:
            for s in time_slots:
                prob += lpSum([x[(p, c, s)] for c in courts]) <= 1

        # # 4. Each court has capacity limit
        # for c in courts:
        #     for s in time_slots:
        #         prob += lpSum([x[(p, c, s)] for p in players]) <= 8  # Max 8 players per court

        # 5. Minimum players constraint - if a slot is used, minimum players required
        for s in time_slots:
            total_players_in_slot = lpSum([x[(p, c, s)] for p in players for c in courts])
            prob += total_players_in_slot >= self.min_players * y[s]
            # If no one is playing in this slot, y[s] should be 0
            prob += y[s] <= total_players_in_slot

        # # 6. Each player plays at most once per day
        # for p in players:
        #     for day in self.day_mapping.keys():
        #         day_slots = [s for s in time_slots if s[0] == day]
        #         prob += lpSum([x[(p, c, s)] for c in courts for s in day_slots]) <= 1

        # Solve the problem
        status = prob.solve(PULP_CBC_CMD(msg=0))

        print(f"Problem Status: {LpStatus[status]}")

        # Debug: Print slot analysis
        for s in time_slots:
            available_players = [p for p in players if s in player_availability[p]]
            available_courts = [c for c in courts if s in court_availability[c]]
            print(f"Slot {s}: {len(available_players)} players available: {available_players}, Courts: {available_courts}")

        # Extract results
        schedule = []
        week_dates = self.get_next_week_dates()

        for s in time_slots:
            day, start_time, end_time = s

            # Collect all players and courts for this slot
            slot_assignments = []
            for c in courts:
                court_players = []
                for p in players:
                    if x[(p, c, s)].varValue == 1:
                        court_players.append(p)

                if len(court_players) >= self.min_players:
                    slot_assignments.append({
                        'court': c,
                        'players': sorted(court_players)
                    })

            # Create schedule entries for each court that has enough players
            for assignment in slot_assignments:
                schedule.append({
                    'day': day,
                    'date': week_dates[day],
                    'start_time': start_time,
                    'end_time': end_time,
                    'players': assignment['players'],
                    'court': assignment['court'],
                    'player_count': len(assignment['players'])
                })

        return sorted(schedule, key=lambda x: (self.day_mapping[x['day']], x['start_time']))