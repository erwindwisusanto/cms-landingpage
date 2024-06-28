<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route("index") }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Websites</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route("cms", ['website' => "dengue"]) }}">Dengue</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("cms", ['website' => "pharmacy"]) }}">Pharmacy</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("cms", ['website' => "whitening"]) }}">Whitening</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
