<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html "
            target="_blank">
            <img src="/soft-ui/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Soft UI Dashboard 3</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')"
                icon="fas fa-fw fa-tachometer-alt" label="Dashboard" />

            <x-nav-link href="{{ route('admin.players.index') }}" :active="request()->routeIs('admin.players.*')"
                icon="fas fa-fw fa-users" label="Data Pemain" />

            <x-nav-link icon="fas fa-fw fa-clock" label="Time Slots" />

            <x-nav-link href="{{ route('admin.courts.index') }}" :active="request()->routeIs('admin.courts.*')"
                icon="fas fa-fw fa-basketball-ball" label="Lapangan" />

            <x-nav-link href="{{ route('admin.schedules.index') }}" :active="request()->routeIs('admin.schedules.*')"
                icon="fas fa-fw fa-calendar-week" label="Penjadwalan" />
        </ul>
    </div>
</aside>