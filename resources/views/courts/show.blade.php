<x-app-layout title="Detail Lapangan">
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama Lapangan</dt>
                        <dd class="col-sm-9">{{ $court->name }}</dd>

                        <dt class="col-sm-3">Lokasi</dt>
                        <dd class="col-sm-9">{{ $court->location }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Jadwal Ketersediaan Lapangan</h5>
                        <a href="{{ route('admin.courts.availabilities.create', $court) }}"
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
                                @if($court->availabilities->count())
                                @foreach ($court->availabilities as $availability)
                                <tr>
                                    <td>{{ $availability->day_of_week }}</td>
                                    <td>{{ $availability->start_time }}</td>
                                    <td>{{ $availability->end_time }}</td>
                                    <td>
                                        <form
                                            action="{{ route('admin.courts.availabilities.destroy', [$court, $availability]) }}"
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