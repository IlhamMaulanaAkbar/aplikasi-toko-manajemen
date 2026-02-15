<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img d-flex align-items-center gap-3">
                <img src="{{ asset('assets/images/logos/logo-livi.jpg') }}" width="45" height="45"
                    class="rounded-circle object-fit-cover" />

                <span class="logo-text fw-bolder fs-3">
                    Livi <br> Beauty House
                </span>
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-6"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i class="ti ti-atom"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <!-- ---------------------------------- -->
                <!-- Dashboard -->
                <!-- ---------------------------------- -->
                @if (auth()->user()->role->name !== 'manager')
                    <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)"
                            aria-expanded="false">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-flex">
                                    <i class="ti ti-layout-grid"></i>
                                </span>
                                <span class="hide-menu">Produk</span>
                            </div>

                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a class="sidebar-link justify-content-between" href="{{ route('produk.index') }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Stok Barang</span>
                                    </div>

                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link justify-content-between"
                                    href="{{ route('jenis-barang.index') }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Jenis Barang</span>
                                    </div>

                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link justify-content-between"
                                    href="{{ route('satuan-barang.index') }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Satuan Barang</span>
                                    </div>

                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="sidebar-divider lg"></span>
                    </li>
                    <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">Menu</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" href="{{ route('barang-masuk.index') }}"
                            aria-expanded="false">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-flex">
                                    <i class="ti ti-package"></i>
                                </span>
                                <span class="hide-menu">Barang Masuk</span>
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" href="{{ route('barang-keluar.index') }}"
                            aria-expanded="false">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-flex">
                                    <i class="ti ti-package"></i>
                                </span>
                                <span class="hide-menu">Barang Keluar</span>
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" href="{{ route('barang-expired.index') }}"
                            aria-expanded="false">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-flex">
                                    <i class="ti ti-package"></i>
                                </span>
                                <span class="hide-menu">Barang Expired</span>
                            </div>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" href="{{ route('permintaan-barang.index') }}"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <i class="ti ti-package"></i>
                            </span>
                            <span class="hide-menu">Permintaan Barang</span>
                        </div>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Laporan</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" href="{{ route('laporan.produk.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <i class="ti ti-file"></i>
                            </span>
                            <span class="hide-menu">Laporan Stok Produk</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" href="{{ route('laporan.barang-masuk.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <i class="ti ti-file"></i>
                            </span>
                            <span class="hide-menu">Laporan Barang Masuk</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" href="{{ route('laporan.barang-keluar.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <i class="ti ti-file"></i>
                            </span>
                            <span class="hide-menu">Laporan Barang Keluar</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" href="{{ route('laporan.barang-expired.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <i class="ti ti-file"></i>
                            </span>
                            <span class="hide-menu">Laporan Barang <br> Expired</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" href="{{ route('laporan.permintaan-barang.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <i class="ti ti-file"></i>
                            </span>
                            <span class="hide-menu">Laporan Permintaan <br> Barang</span>
                        </div>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                @if (auth()->user()->role->name !== 'Super Admin')
                    <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">Manajemen Akun</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" href="{{ route('users.index') }}"
                            aria-expanded="false">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-flex">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Kelola Akun</span>
                            </div>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
