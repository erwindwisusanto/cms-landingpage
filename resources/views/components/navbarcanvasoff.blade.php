<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Landing Page</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('website') == 'dengue' ? 'active' : '' }}" href="{{ route('cms', ['website' => 'dengue']) }}">Dengue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('website') == 'pharmacy_bali' ? 'active' : '' }}" href="{{ route('cms', ['website' => 'pharmacy_bali']) }}">Pharmacy Bali</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('website') == 'whitening_clinics' ? 'active' : '' }}" href="{{ route('cms', ['website' => 'whitening_clinics']) }}">Whitening</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('website') == 'pharmacy_jakarta' ? 'active' : '' }}" href="{{ route('cms', ['website' => 'pharmacy_jakarta']) }}">Pharmacy Jakarta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('website') == 'apotek_jakarta' ? 'active' : '' }}" href="{{ route('cms', ['website' => 'apotek_jakarta']) }}">Apotek Jakarta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('website') == 'balihomelab' ? 'active' : '' }}" href="{{ route('cms', ['website' => 'balihomelab']) }}">Bali Home Lab</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('website') == 'pharmacy_bali_v2' ? 'active' : '' }}" href="{{ route('cms', ['website' => 'pharmacy_bali_v2']) }}">Pharmacy Bali v2</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
