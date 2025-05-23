        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
            <img
                src="{{ asset('assets/dist/img/BKK.png') }}"
                alt="BKK"
                class="brand-image elevation-3"
                style="opacity: 0.8"
            />
            <span class="brand-text font-weight-light">BKK SMK MUH KDH</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img
                    src="{{ asset('assets/dist/img/avatar.png') }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                />
                </div>
                <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
                >
                <li class="nav-item">
                    <a href="/home" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/data_loker" class="nav-link {{ request()->is('data_loker') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-building"></i>
                    <p>
                        Data Loker
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/status_pelamar" class="nav-link {{ request()->is('status_pelamar') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-address-card"></i>
                    <p>
                        Status pelamar
                    </p>
                    </a>
                </li>
                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Loker
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Active Page</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inactive Page</p>
                        </a>
                    </li>
                    </ul>
                </li> --}}
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>