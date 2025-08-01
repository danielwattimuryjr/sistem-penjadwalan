<div class="header-wrap">
    <div class="header grid-limit">
        <!-- BAHASA -->
        <div class="widget-selectables" style="visibility:hidden;">
            <div class="widget-options-wrap">
                <div id="lang-dropdown-trigger" class="current-option">
                    <div id="lang-dropdown-option-value" class="current-option-value">
                        <img class="widget-option-img" src="https://www.satriamuda.id/img/flags/flag-ind.png"
                            alt="flag-ind">
                        <p class="widget-option-text">Bahasa Indonesia</p>
                    </div>
                    <svg class="arrow-icon">
                        <use xlink:href="#svg-arrow"></use>
                    </svg>
                </div>
            </div>
        </div>
        <!-- WIDGET SOSIAL -->
        <div class="mobile-menu-pull mobile-menu-open"><svg class="menu-pull-icon">
                <use xlink:href="#svg-menu-pull"></use>
            </svg></div>
        <div class="widget-selectables" id="sosmed_header">
            <div class="loginwrap">
                @if(Auth::check())
                <a title="Profile" href="#" class="button tiny log-button text-white"
                    style="background:#2D3D75;padding:0 14px 0 14px">
                    {{ Auth::user()->email }}
                </a>
                <form action="{{ route('logout') }}" method="post" style="display: inline;">
                    @csrf

                    <a title="logout" href="{{ route('logout') }}" class="button tiny log-button text-white" onclick="event.preventDefault();
                                        this.closest('form').submit();"
                        style="background:#ED2227;padding:0 14px 0 14px">
                        Logout
                    </a>
                </form>
                @else
                <a title="Login" href="{{ route('login') }}" class="button tiny log-button text-white"
                    style="background:#2D3D75;padding:0 14px 0 14px">
                    Login
                </a>
                <a title="Sign Up" href="{{ route('register') }}" class="button tiny log-button text-white  "
                    style="background:#ED2227;padding:0 14px 0 14px">
                    Sign Up
                </a>
                @endif
            </div>
        </div>
    </div>
</div>