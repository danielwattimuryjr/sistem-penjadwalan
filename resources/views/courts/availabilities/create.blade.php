<x-app-layout title="Tambah Jadwal Lapangan">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('courts.availabilities.store', $court->id) }}">
            @csrf
            <div class="mb-3">
              <label for="day_of_week" class="form-label">Hari</label>
              <select name="day_of_week" id="day_of_week" class="form-select @error('day_of_week') is-invalid @enderror" required>
                <option value="">Pilih Hari</option>
                @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                  <option value="{{ $day }}" @selected(old('day_of_week') == $day)>{{ $day }}</option>
                @endforeach
              </select>
              @error('day_of_week') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label for="start_time" class="form-label">Jam Mulai</label>
              <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}" required>
              @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label for="end_time" class="form-label">Jam Selesai</label>
              <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required>
              @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>