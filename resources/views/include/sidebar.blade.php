<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" data-key="t-menu">Menu</li>

            <li>
                <a href="{{ route('dashboard') }}">
                    <i data-feather="home"></i>
                    <span data-key="t-dashboard">Dashboard</span>
                </a>
            </li>

            <li class="menu-title" data-key="t-apps">Apps</li>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="edit"></i>
                    <span data-key="t-ecommerce">Proses Input</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('data.create') }}" key="t-products">Data Komponen Mesin</a></li>
                    <li><a href="{{ route('partmasuk.create') }}" data-key="t-product-detail">Part Masuk</a></li>
                    <li><a href="{{ route('partkeluar.create') }}" data-key="t-orders">Part Keluar</a></li>
                    <li><a href="{{ route('stock.create') }}" data-key="t-orders">Stock Part</a></li>
                    <li><a href="{{ route('harga.create') }}" data-key="t-orders">Harga Part</a></li>
                    <li><a href="{{ route('purchase.create') }}" data-key="t-orders">Purchase Request</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="user"></i> 
                    <span data-key="t-ecommerce">User</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('users.index') }}" data-key="t-orders">User Account</a></li>
                </ul>
            </li>

            <!-- <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="archive"></i>
                    <span data-key="t-ecommerce">Pemindahan Data</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('spareparts.import.view') }}" data-key="t-orders">Import</a></li>
                </ul>
            </li> -->
    </div>
    <!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->