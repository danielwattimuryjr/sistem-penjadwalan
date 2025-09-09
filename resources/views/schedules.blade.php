<x-guest-layout>
    <div class="banner-wrap banner-5">
        <div class="banner grid-limit">
            <h2 class="banner-title">SCHEDULES</h2>
            <p class="banner-sections">
                <span class="banner-section">Home</span>
                <svg class="arrow-icon">
                    <use xlink:href="#svg-arrow"></use>
                </svg>
                <span class="banner-section">Schedules</span>
            </p>
        </div>
    </div>

    <div class="layout-content-full v2 grid-limit layout-item gutter-big">
        <div class="tab-wrap">
            <div class="tab-body">
                <div class="tab-item">
                    <div style="display: table; margin: 0 auto">
                        <form
                            id="filterForm"
                            action="{{ route('guest.schedules') }}"
                            method="get"
                        >
                            @csrf
                            <div
                                class="form-group col-xs-6"
                                style="max-width: 200px"
                            >
                                <label style="color: #fff">Season</label>
                                <select name="year" class="form-control">
                                    <option value="">Pilih Season</option>
                                    @foreach ($yearOptions as $yo)
                                        <option
                                            value="{{ $yo->year }}"
                                            {{ request('year') == $yo->year ? 'selected' : '' }}
                                        >
                                            {{ $yo->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div
                                class="form-group col-xs-6"
                                style="max-width: 200px"
                            >
                                <label style="color: #fff">Jenis Sesi</label>
                                <select name="jenis_sesi" class="form-control">
                                    <option value="">Pilih Sesi</option>
                                    <option
                                        value="latihan"
                                        {{ request('jenis_sesi') == 'latihan' ? 'selected' : '' }}
                                    >
                                        Latihan
                                    </option>
                                    <option
                                        value="sparring"
                                        {{ request('jenis_sesi') == 'sparring' ? 'selected' : '' }}
                                    >
                                        Sparring
                                    </option>
                                    <option
                                        value="perlombaan"
                                        {{ request('jenis_sesi') == 'perlombaan' ? 'selected' : '' }}
                                    >
                                        Perlombaan
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="widget-match-box row" style="padding: 30px 0px">
                        <h2
                            class="banner-title"
                            style="color: #fff; text-align: center"
                        >
                            Season {{ request('year', now()->year) }}
                        </h2>
                        <h3 style="color: #fff; text-align: center">
                            {{ request('jenis_sesi', 'Semua Kompetisi') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            document
                .querySelectorAll('#filterForm select')
                .forEach((select) => {
                    select.addEventListener('change', function () {
                        this.form.submit();
                    });
                });
        </script>
    </x-slot>
</x-guest-layout>
