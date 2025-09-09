<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\SchedulePlayer;
use Illuminate\Support\Facades\Http;
use App\Models\Player;
use App\Models\Court;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UpdateScheduleRequest;
use Exception;

class ScheduleController extends Controller
{
    private string $schedulerUrl;

    public function __construct()
    {
        $this->schedulerUrl = env('PYTHON_API_URL', 'http://localhost:5000') . '/solve';
    }

    public function index()
    {
        $schedules = Schedule::orderBy('date')->get();
        return view('penjadwalan.index', compact('schedules'));
    }

    public function show(Schedule $schedule)
    {
        return view('penjadwalan.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $schedule->load(['court', 'players']);
        return view('penjadwalan.edit', compact('schedule'));
    }

    public function update(Schedule $schedule, UpdateScheduleRequest $request)
    {
        $schedule->update($request->validated());

        return to_route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return to_route('admin.schedules.index')->with('success', 'Schedule deleted successfully.');
    }

    public function generate()
    {
        DB::beginTransaction();

        try {
            $schedulerData = $this->prepareSchedulerData();

            if (empty($schedulerData['players']) || empty($schedulerData['courts'])) {
                return to_route('admin.schedules.index')->with('error', 'Tidak ada data players atau courts yang tersedia');
            }

            $optimizedSchedule = $this->callPythonScheduler($schedulerData);

            if (empty($optimizedSchedule)) {
                return to_route('admin.schedules.index')->with('error', 'Tidak dapat membuat jadwal dengan constraint yang ada');
            }

            $savedSchedules = $this->saveSchedulesToDatabase($optimizedSchedule);

            DB::commit();

            return to_route('admin.schedules.index')->with('success', "Berhasil membuat {$savedSchedules->count()} jadwal");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error generating schedule: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return to_route('admin.schedules.index')->with('error', 'Terjadi error saat membuat jadwal: ' . $e->getMessage());
        }
    }

    private function prepareSchedulerData(): array
    {
        $playersData = Player::with('availabilities')->get()->map(function ($player) {
            return [
                'id' => $player->id,
                'name' => $player->name,
                'availabilities' => $player->availabilities->map(function ($avail) {
                    return [
                        'day_of_week' => $avail->day_of_week,
                        'start_time' => $avail->start_time,
                        'end_time' => $avail->end_time
                    ];
                })->toArray()
            ];
        })->filter(function ($player) {
            return count($player['availabilities']) > 0; // Only players with availability
        })->values()->toArray();

        // Get courts with their availabilities
        $courtsData = Court::with('availabilities')->get()->map(function ($court) {
            return [
                'id' => $court->id,
                'name' => $court->name, // For debugging
                'availabilities' => $court->availabilities->map(function ($avail) {
                    return [
                        'day_of_week' => $avail->day_of_week,
                        'start_time' => $avail->start_time,
                        'end_time' => $avail->end_time
                    ];
                })->toArray()
            ];
        })->filter(function ($court) {
            return count($court['availabilities']) > 0; // Only courts with availability
        })->values()->toArray();

        return [
            'players' => $playersData,
            'courts' => $courtsData
        ];
    }

    private function callPythonScheduler(array $data): array
    {
        try {
            Log::info('Calling Python scheduler with data:', $data);

            $response = Http::timeout(30)->post($this->schedulerUrl, $data);

            if (!$response->successful()) {
                throw new Exception("Scheduler service error: " . $response->body());
            }

            $result = $response->json();

            Log::info('Python scheduler response:', $result);

            return $result['schedule'] ?? $result ?? [];
        } catch (Exception $e) {
            Log::error('Python scheduler call failed: ' . $e->getMessage());
            throw new Exception('Gagal menghubungi layanan scheduler: ' . $e->getMessage());
        }
    }

    private function saveSchedulesToDatabase(array $schedules)
    {
        $savedSchedules = collect();

        foreach ($schedules as $scheduleData) {
            // Update if exists, otherwise insert
            $schedule = Schedule::updateOrCreate(
                [
                    'date'       => $scheduleData['date'],
                    'start_time' => $scheduleData['start_time'],
                    'end_time'   => $scheduleData['end_time'],
                    'court_id'   => $scheduleData['court'],
                ],
                [
                    'day_of_week' => $scheduleData['day'],
                ]
            );

            // Sync players (update instead of duplicate attach)
            $schedule->players()->sync($scheduleData['players']);

            $savedSchedules->push($schedule);
        }

        return $savedSchedules;
    }
}
