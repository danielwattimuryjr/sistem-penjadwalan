<x-app-layout title="Penjadwalan">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Jadwal Otomatis</h5>
                        <a href="{{ route('admin.schedules.generate') }}" class="btn btn-primary">Generate Jadwal</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Lapangan</th>
                                    <th>Jenis Sesi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $item)
                                <tr>
                                    <td>{{ $item->timeSlot->day_of_week }}</td>
                                    <td>{{ $item->timeSlot->start_time }} - {{ $item->timeSlot->end_time }}</td>
                                    <td>{{ $item->court->name }}</td>
                                    <td>
                                        <span class="badge bg-
                        {{ $item->session_type === 'latihan' ? 'primary' :
                          ($item->session_type === 'sparring' ? 'warning text-dark' : 'danger') }}">
                                            {{ ucfirst($item->session_type) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada jadwal.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>