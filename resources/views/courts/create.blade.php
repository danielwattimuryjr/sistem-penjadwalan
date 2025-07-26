<x-app-layout title="Tambah Lapangan">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('courts.store') }}" method="post">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nama Lapangan</label>
              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="location" class="form-label">Lokasi</label>
              <textarea name="location" rows="5" id="location" class="form-control @error('location') is-invalid @enderror">{{old('location')}}</textarea>
              @error('location')
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