<div id="sidebar" class="sidebar">
    <!-- Aplication Brand -->
    <div class="app-brand">
        <a href="/admin/dashboard" title="Sleek Dashboard">
            <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                height="33" viewBox="0 0 30 33">
                <g fill="none" fill-rule="evenodd">
                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                </g>
            </svg>
            <span class="brand-name text-truncate">Toko Hanzah</span>
        </a>
    </div>
    <!-- begin sidebar scrollbar -->
    <div class="sidebar-scrollbar">

        <!-- sidebar menu -->
        <ul class="nav sidebar-inner" id="sidebar-menu">



            <li class="has-sub @yield('dashboard')">
                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                    aria-expanded="false" aria-controls="dashboard">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    <span class="nav-text">Dashboard</span> <b class="caret"></b>
                </a>
                <ul class="collapse show" id="dashboard" data-parent="#sidebar-menu">
                    <div class="sub-menu">


                        <li class="@yield('dashboard')">
                            <a class="sidenav-item-link" href="/dashboard">
                                <span class="nav-text">Ecommerce</span>

                            </a>
                        </li>

                    </div>
                </ul>
            </li>

            <li class="has-sub @yield('tabel')">
                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#tables"
                    aria-expanded="false" aria-controls="tables">
                    <i class="mdi mdi-table"></i>
                    <span class="nav-text">Tabel</span> <b class="caret"></b>
                </a>
                <ul class="collapse @yield('tabel')" id="tables" data-parent="#sidebar-menu">
                    <div class="sub-menu">


                        <li class="has-sub @yield('master')">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#tableMaster" aria-expanded="false" aria-controls="tableMaster">
                                <span class="nav-text ">Tabel Master</span> <b class="caret"></b>

                            </a>
                            <ul class="collapse @yield('master')" id="tableMaster">
                                <div class="sub-menu">

                                    <li class="@yield('barang')">
                                        <a href="/barang">Tabel Barang</a>
                                    </li>

                                    <li class="@yield('pelanggan')">
                                        <a href="/pelanggan">Tabel Pelanggan</a>
                                    </li>

                                    <li class="@yield('pemasok')">
                                        <a href="/pemasok">Tabel Pemasok</a>
                                    </li>

                                </div>
                            </ul>
                        </li>

                        <li class="has-sub @yield('transaksi')">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#data-tables" aria-expanded="false" aria-controls="data-tables">
                                <span class="nav-text ">Tabel Transaksi</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse @yield('transaksi')" id="data-tables">
                                <div class="sub-menu">

                                    <li class="@yield('penjualan')">
                                        <a href="/penjualan">Tabel Penjualan Barang</a>
                                    </li>

                                    <li class="@yield('pembelian')">
                                        <a href="/pembelian">Tabel Pembelian Barang</a>
                                    </li>

                                </div>
                            </ul>
                        </li>


                    </div>
                </ul>
            </li>

    </div>

</div>
