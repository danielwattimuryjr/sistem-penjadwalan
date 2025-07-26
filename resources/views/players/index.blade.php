<x-app-layout title="Data Pemain">
  <x-slot name="styles">
    <link rel="stylesheet" href="/vendor/data-table/dataTables.bootstrap5.min.css">
  </x-slot>

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <a href="{{route('players.create')}}" class="btn btn-primary">
                Tambah Pemain
              </a>
            </div>
            <div class="col">
              <div class="table-responsive">
                <table class="table" id="data-table">
                  <thead>
                    <tr>
                      <td>No</td>
                      <td>Nama Pemain</td>
                      <td>Nomor Punggung</td>
                      <td>Posisi</td>
                      <td>Actions</td>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($players as $player)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $player->name }}</td>
                        <td class="text-center">{{ $player->jersey_number }}</td>
                        <td class="text-center">{{ $player->position }}</td>
                        <td>
                          <a href="{{ route('players.edit', $player) }}" class="btn btn-warning btn-sm">
                            Edit
                          </a>
                          <form action="{{ route('players.destroy', $player) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                              Hapus
                            </button>
                          </form>
                          <a href="{{ route('players.show', $player) }}" class="btn btn-secondary btn-sm">
                            Detail
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>

                  <tfoot>
                    <tr>
                      <td>No</td>
                      <td>Nama Pemain</td>
                      <td>Nomor Punggung</td>
                      <td>Posisi</td>
                      <td>Actions</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
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