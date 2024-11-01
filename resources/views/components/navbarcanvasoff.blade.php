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
                <span class="menu-title">Website</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('cms', ['website' => 'dengue']) }}">denguehospital.com</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('cms', ['website' => 'pharmacy_bali']) }}">pharmacybali.com</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('cms', ['website' => 'whitening_clinics']) }}">whiteningclinics.com</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('cms', ['website' => 'pharmacy_jakarta']) }}">pharmacyjakarta.com</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('cms', ['website' => 'apotek_jakarta']) }}">apotikjakarta.com</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('cms', ['website' => 'balihomelab']) }}">balihomelab.com</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('cms', ['website' => 'pharmacy_bali_v2']) }}">pharmacybali.com v2</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('cms', ['website' => 'whitening_clinic_v2']) }}">whiteningclinics.com v2</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('cms', ['website' => 'whitening_dot_clinic_v2']) }}">whitening.clinic.com v2</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('cms', ['website' => 'dengue_v2']) }}">denguehospital.com v2</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('cms', ['website' => 'jakartahomelab']) }}">jakartahomelab.com v2</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
