<x-app-layout title="Penjadwalan">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div
                        class="d-flex justify-content-between align-items-center"
                    >
                        <h5 class="card-title">Jadwal Otomatis</h5>
                        <a
                            href="{{ route('admin.schedules.generate') }}"
                            class="btn btn-primary"
                        >
                            Generate Jadwal
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Lapangan</th>
                                    <th>Jenis Sesi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->date)->format('l, d F Y') }}
                                        </td>
                                        <td>
                                            {{ $item->start_time }} -
                                            {{ $item->end_time }}
                                        </td>
                                        <td>{{ $item->court->name }}</td>
                                        <td>
                                            @if ($item->type)
                                                <span
                                                    class="badge bg-{{
                                                        $item->type === 'latihan'
                                                            ? 'primary'
                                                            : ($item->type === 'sparring'
                                                                ? 'warning text-dark'
                                                                : 'danger')
                                                    }}"
                                                >
                                                    {{ $item->type }}
                                                </span>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('admin.schedules.edit', $item) }}"
                                                class="btn btn-warning btn-sm"
                                            >
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('admin.schedules.destroy', $item) }}"
                                                method="POST"
                                                class="d-inline"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                >
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="4"
                                            class="text-center text-muted"
                                        >
                                            Belum ada jadwal.
                                        </td>
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
