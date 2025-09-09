<x-app-layout title="Edit Jadwal">
    <div class="row g-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Pemain</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Pos.</th>
                            </thead>
                            <tbody>
                                @foreach ($schedule->players as $p)
                                    <tr>
                                        <td>{{ $p->jersey_number }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->position }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Jadwal</h5>
                </div>

                <div class="card-body">
                    <form
                        action="{{ route('admin.schedules.update', $schedule) }}"
                        method="post"
                    >
                        @method('PUT')
                        @csrf

                        <dl class="row">
                            <dt class="col-sm-3">Tanggal</dt>
                            <dd class="col-sm-9">
                                {{ \Carbon\Carbon::parse($schedule->date)->format('l, d F Y') }}
                            </dd>

                            <dt class="col-sm-3">Jam</dt>
                            <dd class="col-sm-9">
                                {{ $schedule->start_time . ' - ' . $schedule->end_time }}
                            </dd>

                            <dt class="col-sm-3">Lapangan</dt>
                            <dd class="col-sm-9">
                                {{ $schedule->court->name }}
                            </dd>

                            <dt class="col-sm-3">Lokasi</dt>
                            <dd class="col-sm-9">
                                {{ $schedule->court->location }}
                            </dd>

                            <dt class="col-sm-3">Jenis Jadwal</dt>
                            @if (Auth::user()->hasRole('manager'))
                                <dd class="col-sm-9">
                                    <select
                                        name="type"
                                        id="type"
                                        class="form-select @error('type') is-invalid @enderror"
                                    >
                                        <option value="" disabled>
                                            Pilih Jenis Jadwal
                                        </option>
                                        <option
                                            value="latihan"
                                            {{ old('type') == 'latihan' ? 'selected' : '' }}
                                            {{ $schedule->type == 'latihan' ? 'selected' : '' }}
                                        >
                                            Latihan
                                        </option>
                                        <option
                                            value="sparring"
                                            {{ old('type') == 'sparring' ? 'selected' : '' }}
                                            {{ $schedule->type == 'sparring' ? 'selected' : '' }}
                                        >
                                            Sparring
                                        </option>
                                        <option
                                            value="perlombaan"
                                            {{ old('type') == 'perlombaan' ? 'selected' : '' }}
                                            {{ $schedule->type == 'perlombaan' ? 'selected' : '' }}
                                        >
                                            Perlombaan
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </dd>
                            @else
                                <dd class="col-sm-9">
                                    {{ $schedule->type }}
                                </dd>
                            @endif
                        </dl>

                        <div class="row">
                            <div class="col">
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-primary"
                                >
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
