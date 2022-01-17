<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ Request::is('admin') ? 'active' : '' }}">
                    <a href="{{route('admin.home')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Painel de controle</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::path() == 'admin/alerts' ? 'active' : '' }}">
                    <a href="{{route('alerts.home')}}" class='sidebar-link'>
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Alertas</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>