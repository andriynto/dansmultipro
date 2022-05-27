<!--  Main navbar -->
<div class="navbar navbar-expand-md navbar-dark navbar-static bg-primary-700">
    <div class="navbar-brand">
        <a href="{{ url('/') }}" class="d-inline-block">
            
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> Profile Saya</a>
                    <div class="dropdown-divider"></div>
                    {{-- <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Pengaturan Akun</a> --}}
                    <a href="{{ url('logout') }}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>

        <span class="badge badge-secondary align-self-center d-none d-lg-inline-block mr-lg-3"><i class="icon-location4"></i> DAnS MultiPro</span>
    </div>

    <div class="order-1 order-lg-2 d-flex flex-1 flex-lg-0 justify-content-end align-items-center">
        <span class="badge badge-success d-none d-lg-inline-block mr-3">Active</span>

        <ul class="navbar-nav flex-row align-items-center h-100">
            <li class="nav-item nav-item-dropdown-lg dropdown">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <span>{{ auth()->user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right wmin-lg-250 py-2">
                    <a href="javascript:void(0);">
                        <div class="dropdown-item d-flex py-2">
                            <div class="flex-1">
                                <div class="font-weight-semibold">Profile Saya</div>
                                <span class="text-muted font-size-sm">Profile, overview</span>
                            </div>
                            <span class="btn btn-dark-100 btn-icon btn-sm text-body border-transparent rounded-pill ml-1">
                                <i class="icon-user-plus"></i>
                            </span>
                        </div>
                    </a>

                    <div class="dropdown-item d-flex py-2">
                        <div class="flex-1">
                            <div class="font-weight-semibold">Pengaturan Akun</div>
                            <span class="text-muted font-size-sm">Access, permissions</span>
                        </div>
                        <span class="btn btn-dark-100 btn-icon btn-sm text-body border-transparent rounded-pill ml-1">
                            <i class="icon-cog5"></i>
                        </span>
                    </div>

                    <a href="{{ url('logout') }}">
                        <div class="dropdown-item d-flex py-2">
                            <div class="flex-1">
                                <div class="font-weight-semibold">Logout</div>
                                <span class="text-muted font-size-sm">Security logoff</span>
                            </div>
                            <span class="btn btn-dark-100 btn-icon btn-sm text-body border-transparent rounded-pill ml-1">
                                <i class="icon-switch2"></i>
                            </span>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!--  Main navbar -->