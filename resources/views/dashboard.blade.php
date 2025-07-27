<x-app-layout title="Dashboard">
    <div class="row">
        <div class="col mt-4 mt-lg-0">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h6 class="mb-0">Selamat datang, {{ Auth::user()->name }}! 🙌</h6>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>