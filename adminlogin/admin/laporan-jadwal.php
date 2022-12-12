<?php require 'config/auth.php'; ?>

<?php $title = 'Laporan Jadwal Keberangkatan';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow p-3 mb-3 mt-3">
                    <h1>Laporan Jadwal Keberangkatan</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Data Laporan Jadwal Keberangkatan Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="row p-3">
                    <div class="card mb-4 shadow">
                         <div class="text-center p-3">
                              <h5>Tabel Jadwal Keberangkatan Albadriyah Wisata</h5>
                         </div>
                         <a href="cetak-jadwal" target="_blank" class="btn btn-success col-2">Cetak Laporan</a>
                         <div class="card-body">
                              <table id="datatablesSimple" class="table table-hover table-bordered">
                                   <thead class="table-dark">
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">Tgl. Keberangkatan</th>
                                             <th class="text-center">Tgl. Kepulangan</th>
                                             <th class="text-center">Nama Paket</th>
                                             <th class="text-center">Pesawat</th>
                                             <th class="text-center">No. Pesawat</th>
                                             <th class="text-center">Jumlah Jamaah</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php
                                $data_jadwal = "SELECT * FROM jadwal
                                INNER JOIN paket ON jadwal.id_paket = paket.id_paket
                                ORDER BY id_jadwal
                                ";
                                $sql_rm = mysqli_query($kon, $data_jadwal) or die(mysqli_error($kon));
                                while ($hasil = mysqli_fetch_array($sql_rm)) {
                                ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= date('d-M-Y', strtotime($hasil['tanggal_keberangkatan'])); ?></td>
                                             <td><?= date('d-M-Y', strtotime($hasil['tanggal_kepulangan'])); ?></td>
                                             <td><?= $hasil['nama_paket']; ?></td>
                                             <td><?= $hasil['pesawat']; ?></td>
                                             <td><?= $hasil['nopesawat']; ?></td>
                                             <td><?= $hasil['kuota_pendaftaran']; ?></td>
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