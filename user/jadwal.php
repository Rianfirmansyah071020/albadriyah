<?php require 'config/auth.php'; ?>

<?php $title = 'Jadwal';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow p-3 mt-2 mb-2">
                    <h1>Jadwal</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Jadwal Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="row p-3">
                    <div class="card mb-4">
                         <div class="text-center p-3">
                              <h5>Tabel Jadwal Albadriyah Wisata</h5>
                         </div>
                         <div class="card-body">
                              <table id="datatablesSimple" class="table table-bordered table-hover">
                                   <thead class="table-dark">
                                        <tr>
                                             <th>No.</th>
                                             <th>Kode Jadwal</th>
                                             <th>Kode Paket</th>
                                             <th>Harga</th>
                                             <th>Isi Kamar</th>
                                             <th>Tanggal Keberangkatan</th>
                                             <th>No. Pesawat</th>
                                             <th>Tanggal Kepulangan</th>
                                             <th>Kuota Pendaftaran</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php $data_jadwal = mysqli_query($kon, "SELECT * FROM paket INNER JOIN jadwal ON paket.id_paket = jadwal.id_paket");
                                while ($jadwal = mysqli_fetch_array($data_jadwal)) {
                                ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $jadwal['kode_jadwal']; ?></td>
                                             <td><?= $jadwal['kode_paket']; ?></td>
                                             <td><?= number_format($jadwal['harga']) ?></td>
                                             <td><?= $jadwal['isi_kamar']; ?></td>
                                             <td><?= $jadwal['tanggal_keberangkatan']; ?></td>
                                             <td><?= $jadwal['nopesawat']; ?></td>
                                             <td><?= $jadwal['tanggal_kepulangan']; ?></td>
                                             <td><?= $jadwal['kuota_pendaftaran']; ?></td>
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