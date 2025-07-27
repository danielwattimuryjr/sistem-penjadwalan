<x-app-layout title="Lapangan">
    <x-slot name="styles">
        <link rel="stylesheet" href="/vendor/data-table/dataTables.bootstrap5.min.css">
    </x-slot>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('admin.courts.create')}}" class="btn btn-primary">
                                Tambah Lapangan
                            </a>
                        </div>
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table" id="data-table">
                                    <thead>
                                        <tr>
                                            <td class="text-start">No</td>
                                            <td>Nama Lapangan</td>
                                            <td>Lokasi</td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($courts as $court)
                                        <tr>
                                            <td class="text-start">{{ $loop->iteration }}</td>
                                            <td>{{ $court->name }}</td>
                                            <td>{{ $court->location }}</td>
                                            <td>
                                                <a href="{{ route('admin.courts.edit', $court) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.courts.destroy', $court) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.courts.show', $court) }}"
                                                    class="btn btn-secondary btn-sm">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Lapangan</td>
                                            <td>Lokasi</td>
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