<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Menu</div>
          <a class="nav-link" href="index">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </a>
          <a class="nav-link" href="paket">
            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
            Paket
          </a>
          <a class="nav-link" href="jadwal">
            <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
            Jadwal
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
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Cetak Laporan
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="laporan-pembayaran">Laporan Pembayaran</a>
            </nav>
          </div>
          <a class="nav-link" href="logout">
            <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
            Logout
          </a>
        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Login Sebagai User:</div>
        <?php echo $_SESSION['nama_lengkap'] ?>
      </div>
    </nav>
  </div>