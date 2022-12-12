<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <a class="nav-link" href="index">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </a>
          <a class="nav-link" href="tambah-jamaah">
            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            Data Jamaah
          </a>
          <a class="nav-link" href="paket">
            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
            Data Paket
          </a>
          <a class="nav-link" href="jadwal">
            <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
            Data Jadwal
          </a>
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Transaksi
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="pemesanan">Pemesanan</a>
              <a class="nav-link" href="pembayaran">Pembayaran</a>
            </nav>
          </div>
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Laporan
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="laporan-pendaftaran">Pendaftaran</a>
              <a class="nav-link" href="laporan-pembayaran">Pembayaran</a>
              <a class="nav-link" href="laporan-jadwal">Jadwal</a>
            </nav>
          </div>
          <a class="nav-link" href="tambah-admin">
            <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
            Data Admin
          </a>
          <a class="nav-link" href="logout">
            <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
            Logout
          </a>
        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Login Sebagai <?php echo $_SESSION['level'] ?> :</div>
        <?php echo $_SESSION['nama_lengkap'] ?>
      </div>
    </nav>
  </div>