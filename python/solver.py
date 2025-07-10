from pulp import LpProblem, LpVariable, LpBinary, lpSum, LpMaximize

class LinearProgramming:
  def __init__(self, data):
    self.data = data
    self.model = LpProblem("Multi_Schedule_Optimization", LpMaximize)
    self.train_vars = {}  # latihan
    self.spar_vars = {}   # sparring
    self.game_vars = {}   # pertandingan

  def build_variables(self):
    for slot in self.data["time_slots"]:
      slot_id = slot["id"]
      self.train_vars[slot_id] = LpVariable(f"x_train_{slot_id}", cat=LpBinary)
      self.spar_vars[slot_id] = LpVariable(f"x_spar_{slot_id}", cat=LpBinary)
      self.game_vars[slot_id] = LpVariable(f"x_game_{slot_id}", cat=LpBinary)

  def set_objective(self):
    # Goal: maksimalkan total sesi yang terpakai
    self.model += (
      lpSum(self.train_vars.values()) +
      lpSum(self.spar_vars.values()) +
      lpSum(self.game_vars.values())
    ), "Maximize_Scheduled_Sessions"

  def add_constraints(self):
    # Constraint 1: Satu slot hanya boleh dipakai untuk 1 jenis kegiatan
    for slot in self.data["time_slots"]:
      slot_id = slot["id"]
      self.model += (
          self.train_vars[slot_id] +
          self.spar_vars[slot_id] +
          self.game_vars[slot_id] <= 1
      ), f"One_type_per_slot_{slot_id}"

    # Constraint 2: Batas jumlah tiap jenis kegiatan
    self.model += lpSum(self.train_vars.values()) >= 3, "Min_3_Trainings"
    self.model += lpSum(self.spar_vars.values()) <= 1, "Max_1_Sparring"
    self.model += lpSum(self.game_vars.values()) <= 1, "Max_1_Game"

    # Constraint 3: Lapangan tersedia
    for slot in self.data["time_slots"]:
      slot_id = slot["id"]
      valid = False
      for court in self.data.get("court_availability", []):
        if court["day"] == slot["day"] and court["start"] <= slot["start"] and court["end"] >= slot["end"]:
          valid = True
          break
      if not valid:
        self.model += self.train_vars[slot_id] == 0, f"NoCourt_train_{slot_id}"
        self.model += self.spar_vars[slot_id] == 0, f"NoCourt_spar_{slot_id}"
        self.model += self.game_vars[slot_id] == 0, f"NoCourt_game_{slot_id}"

    # Constraint 4: Minimal 5 pemain tersedia untuk tiap slot
    for slot in self.data["time_slots"]:
      slot_id = slot["id"]
      available_players = 0
      for player in self.data.get("players", []):
        for avail in player.get("availability", []):
          if avail["day"] == slot["day"] and avail["start"] <= slot["start"] and avail["end"] >= slot["end"]:
            available_players += 1
            break
      if available_players < 5:
        self.model += self.train_vars[slot_id] == 0, f"NotEnoughPlayer_train_{slot_id}"
        self.model += self.spar_vars[slot_id] == 0, f"NotEnoughPlayer_spar_{slot_id}"
        self.model += self.game_vars[slot_id] == 0, f"NotEnoughPlayer_game_{slot_id}"

  def solve(self):
    self.build_variables()
    self.set_objective()
    self.add_constraints()
    self.model.solve()

    result = []
    for slot in self.data["time_slots"]:
      slot_id = slot["id"]
      if self.train_vars[slot_id].varValue == 1:
        result.append({"slot": slot_id, "type": "latihan"})
      elif self.spar_vars[slot_id].varValue == 1:
        result.append({"slot": slot_id, "type": "sparring"})
      elif self.game_vars[slot_id].varValue == 1:
        result.append({"slot": slot_id, "type": "pertandingan"})

    return {
      "status": "success",
      "schedule": result
    }