<x-app-layout title="Edit Pemain">
    <x-slot name="styles">
        <link rel="stylesheet" href="/vendor/data-table/dataTables.bootstrap5.min.css">
    </x-slot>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.players.update', $player) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Pemain</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ $player->name }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jersey_number" class="form-label">Nomor Punggung</label>
                            <input type="number" name="jersey_number" id="jersey_number"
                                class="form-control @error('jersey_number') is-invalid @enderror"
                                value="{{ $player->jersey_number }}">
                            @error('jersey_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Posisi</label>
                            <select name="position" id="position"
                                class="form-select @error('position') is-invalid @enderror">
                                <option value="">Pilih Posisi</option>
                                <option value="PG" {{ $player->position == 'PG' ? 'selected' : '' }}>PG (Point Guard)
                                </option>
                                <option value="SG" {{ $player->position == 'SG' ? 'selected' : '' }}>SG (Shooting Guard)
                                </option>
                                <option value="SF" {{ $player->position == 'SF' ? 'selected' : '' }}>SF (Small Forward)
                                </option>
                                <option value="PF" {{ $player->position == 'PF' ? 'selected' : '' }}>PF (Power Forward)
                                </option>
                                <option value="C" {{ $player->position == 'C' ? 'selected' : '' }}>C (Center)</option>
                            </select>
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="/vendor/jquery/jquery-3.7.1.min.js"></script>
        <script src="/vendor/data-table/dataTables.min.js"></script>
        <script src="/vendor/data-table/dataTables.bootstrap5.min.js"></script>
        <script>
            new DataTable('#data-table');
        </script>
    </x-slot>
</x-app-layout>