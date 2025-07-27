<x-app-layout title="Detail Pemain">
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama Pemain</dt>
                        <dd class="col-sm-9">{{ $player->name }}</dd>

                        <dt class="col-sm-3">Nomor Punggung</dt>
                        <dd class="col-sm-9">{{ $player->jersey_number }}</dd>

                        <dt class="col-sm-3">Posisi</dt>
                        <dd class="col-sm-9">{{ $player->position }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Jadwal Ketersediaan Pemain</h5>
                        <a href="{{ route('admin.players.availabilities.create', $player) }}"
                            class="btn btn-primary btn-sm">Tambah Jadwal</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($player->availabilities->count())
                                @foreach ($player->availabilities as $availability)
                                <tr>
                                    <td>{{ $availability->day_of_week }}</td>
                                    <td>{{ $availability->start_time }}</td>
                                    <td>{{ $availability->end_time }}</td>
                                    <td>
                                        <form
                                            action="{{ route('admin.players.availabilities.destroy', [$player, $availability]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada ketersediaan</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>