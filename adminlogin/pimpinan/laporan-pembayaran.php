<?php require 'config/auth.php'; ?>

<?php $title = 'Laporan Pembayaran';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow p-3 mb-3 mt-3">
                    <h1>Laporan Pembayaran</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Data Laporan Pembayaran Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="row p-3">
                    <div class="card mb-4 shadow">
                         <div class="text-center p-3">
                              <h5>Tabel Pembayaran Albadriyah Wisata</h5>
                         </div>
                         <a href="cetak-pembayaran" target="_blank" class="btn btn-success col-2">Cetak Laporan</a>
                         <div class="card-body">
                              <table id="datatablesSimple" class="table table-bordered table-hover">
                                   <thead class="table-dark">
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">No. Pembayaran</th>
                                             <th class="text-center">No. Pemesanan</th>
                                             <th class="text-center">No. Registrasi</th>
                                             <th class="text-center">Tanggal Bayar</th>
                                             <th class="text-center">Jumlah Bayar</th>
                                             <th class="text-center">Bukti Transfer</th>
                                             <th class="text-center">Status</th>
                                             <th class="text-center">Aksi</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php
                                $data_pembayaran = "SELECT * FROM pembayaran 
                                                    INNER JOIN pendaftaran ON pembayaran.id_pend = pendaftaran.id_pend
                                                    INNER JOIN pemesanan ON pembayaran.id_pemesanan = pemesanan.id_pemesanan
                                
                                ";
                                $sql_rm = mysqli_query($kon, $data_pembayaran);
                                while ($pembayaran = mysqli_fetch_array($sql_rm)) {
                                ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $pembayaran['no_pembayaran']; ?></td>
                                             <td><?= $pembayaran['no_pemesanan']; ?></td>
                                             <td><?= $pembayaran['no_registrasi']; ?></td>
                                             <td><?= date('d-M-Y', strtotime($pembayaran['tanggal_bayar'])); ?></td>
                                             <td><?= $pembayaran['jumlah_bayar']; ?></td>
                                             <td><img src="../../assets/img/upload/<?= $pembayaran['bukti_transfer'] ?>"
                                                       width="50px"></td>
                                             <td><?= $pembayaran['status_pembayaran']; ?></td>
                                             <td>
                                                  <a href="cetak-kwitansi?id_pembayaran=<?= $pembayaran['id_pembayaran']; ?>"
                                                       target="_blank" class="btn btn-success">Kwitansi</a>
                                             </td>
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