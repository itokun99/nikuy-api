<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
        </div>
        <div class="sidebar-brand-text mx-3">EliTES Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Umum
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/member">
            <i class="fa fa-users"></i>
            <span>Member</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/bisnis">
            <i class="fas fa-business-time"></i>
            <span>Bisnis</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/paket">
            <i class="fas fa-boxes    "></i>
            <span>Paket Membership</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="?hal=member-data" data-toggle="collapse" data-target="#kursusan"
            aria-expanded="true" aria-controls="kursusan">
            <i class="fas fa-chalkboard    "></i>
            <span>Kursus</span>
        </a>
        <div id="kursusan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data:</h6>
                <a class="collapse-item" href="/admin/kelas"><i class="fas fa-users">
                    </i> Kelas</a>
                <a class="collapse-item" href="/admin/pilar"> <i class="fa fa-building" aria-hidden="true"></i>
                    Pilar</a>
                <a class="collapse-item" href="/admin/pembagian-kelas"> <i class="fas fa-chalkboard-teacher"></i>
                    Pembagian Kelas</a>
                <a class="collapse-item" href="/admin/kursus"><i class="fas fa-chalkboard-teacher"></i>
                    Kursus</a>
                <a class="collapse-item" href="/admin/file-kursus"><i class="fas fa-chalkboard-teacher"></i>
                    File</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/event">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span>Event</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/transaksi">
            <i class="fas fa-money-bill" aria-hidden="true"></i>
            <span>Transaksi</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/rating">
            <i class="fa fa-star" aria-hidden="true"></i>
            <span>Rating</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/pesan">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>Pesan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Informasi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/administrator">
            <i class="fas fa-user-cog"></i>
            <span>Administrator</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/data-provinsi">
            <i class="fa fa-map-signs" aria-hidden="true"></i>
            <span>Data Provinsi</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/sosial-media">
            <i class="fa fa-comment" aria-hidden="true"></i>
            <span>Sosial Media</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/banner">
            <i class="fa fa-image" aria-hidden="true"></i>
            <span>Banner</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/masa-berlaku">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span>Masa Berlaku</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pembayaran" aria-expanded="true"
            aria-controls="pembayaran">
            <i class="fas fa-dollar-sign"></i>
            <span>Pembayaran</span>
        </a>
        <div id="pembayaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/admin/metode-pembayaran">
                    <i class="fas fa-money-bill-wave"></i>
                    Metode Pembayaran
                </a>
                <a class="collapse-item" href="/admin/bank">
                    <i class="fas fa-university"></i>
                    Daftar Bank
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#riwayat" aria-expanded="true"
            aria-controls="riwayat">
            <i class="far fa-clock"></i>
            <span>Riwayat</span>
        </a>
        <div id="riwayat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/admin/riwayat-admin"><i class="fas fa-users">
                    </i> Admin</a>
                <a class="collapse-item" href="/admin/riwayat-member"> <i class="fas fa-users"
                        aria-hidden="true"></i>
                    Member</a>
            </div>
        </div>
    </li>

</ul>
