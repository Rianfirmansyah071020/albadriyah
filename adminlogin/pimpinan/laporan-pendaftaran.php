<?php require 'config/auth.php'; ?>

<?php $title = 'Laporan Pendaftaran';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow mt-3 mb-3 p-3">
                    <h1>Laporan Pendaftaran</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Data Laporan Pendaftaran Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="row p-3">
                    <div class="card mb-4 shadow">
                         <div class="text-center p-3">
                              <h5>Tabel Pemesanan Albadriyah Wisata</h5>
                         </div>
                         <a href="cetak-pendaftaran" target="_blank" class="btn btn-success col-2">Cetak Laporan</a>
                         <div class="card-body">
                              <table id="datatablesSimple" class="table table-bordered table-hover">
                                   <thead class="table-dark">
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">No. Registrasi</th>
                                             <th class="text-center">NIK</th>
                                             <th class="text-center">Nama Jamaah</th>
                                             <th class="text-center">Tempat/Tgl.Lahir</th>
                                             <th class="text-center">Jenis Kelamin</th>
                                             <th class="text-center">No. Hp</th>
                                             <th class="text-center">Alamat</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php
                                $data_pendaftaran = "SELECT * FROM pendaftaran ORDER BY id_pend";
                                $sql_rm = mysqli_query($kon, $data_pendaftaran);
                                while ($pendaftaran = mysqli_fetch_array($sql_rm)) {
                                ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $pendaftaran['no_registrasi']; ?></td>
                                             <td><?= $pendaftaran['nik']; ?></td>
                                             <td><?= $pendaftaran['nama_lengkap']; ?></td>
                                             <td><?= $pendaftaran['tempat_lahir']; ?>,
                                                  <?= date('d-M-Y', strtotime($pendaftaran['tanggal_lahir'])); ?></td>
                                             <td><?= $pendaftaran['jk']; ?></td>
                                             <td><?= $pendaftaran['no_hp']; ?></td>
                                             <td><?= $pendaftaran['alamat']; ?></td>
                                        </tr>
                                        <?php } ?>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </main>
     <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
               <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Albadriyah Wisata 2022</div>
               </div>
          </div>
     </footer>
</div>
</div>

<?php include 'layout/footer.php'; ?>