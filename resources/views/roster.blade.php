<x-guest-layout>
    <div class="banner-wrap banner-5">
        <div class="banner grid-limit">
            <h2 class="banner-title">SATRIA MUDA PERTAMINA - Roster</h2>
            <p class="banner-sections">
                <span class="banner-section">Home</span>
                <svg class="arrow-icon">
                    <use xlink:href="#svg-arrow"></use>
                </svg>
                <span class="banner-section">Roster</span>
            </p>
        </div>
    </div>

    <div class="layout-content-full v2 grid-limit layout-item gutter-big">
        <div class="widget-item">
            @foreach($players->chunk(5) as $playerGroup)
            <div class="widget-player-preview mb-4">
                @foreach($playerGroup as $p)
                <div class="player-preview">
                    <div class="player-preview-info">
                        <p class="player-preview-name text-white">{{ $p->name }}</p>
                        <p class="player-number">{{ $p->jersey_number }}</p>
                        <p class="player-position">{{ $p->position }}</p>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>