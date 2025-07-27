<x-app-layout title="Tambah Pemain">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.players.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Pemain</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jersey_number" class="form-label">Nomor Punggung</label>
                            <input type="number" name="jersey_number" id="jersey_number"
                                class="form-control @error('jersey_number') is-invalid @enderror"
                                value="{{ old('jersey_number') }}">
                            @error('jersey_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Posisi</label>
                            <select name="position" id="position"
                                class="form-select @error('position') is-invalid @enderror">
                                <option value="">Pilih Posisi</option>
                                <option value="PG" {{ old('position')=='PG' ? 'selected' : '' }}>PG (Point Guard)
                                </option>
                                <option value="SG" {{ old('position')=='SG' ? 'selected' : '' }}>SG (Shooting Guard)
                                </option>
                                <option value="SF" {{ old('position')=='SF' ? 'selected' : '' }}>SF (Small Forward)
                                </option>
                                <option value="PF" {{ old('position')=='PF' ? 'selected' : '' }}>PF (Power Forward)
                                </option>
                                <option value="C" {{ old('position')=='C' ? 'selected' : '' }}>C (Center)</option>
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
</x-app-layout>