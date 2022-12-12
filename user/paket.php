<?php require 'config/auth.php'; ?>

<?php $title = 'Paket';  ?>

<?php include 'layout/header.php'; ?>

<?php
$data_paket = select("SELECT * FROM paket INNER JOIN jadwal ON paket.id_paket=jadwal.id_paket");
?>

<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow p-3 mt-2 mb-2">
                    <h1>Paket</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Paket Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="row p-3">
                    <div class="card mb-4 shadow">
                         <div class=" text-center p-3">
                              <h5>Tabel Paket Albadriyah Wisata</h5>
                         </div>
                         <div class="card-body">
                              <table id="datatablesSimple" class="table table-bordered table-hover">
                                   <thead class="table-dark">
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">Kode Paket</th>
                                             <th class="text-center">Jenis Paket</th>
                                             <th class="text-center">Nama Paket</th>
                                             <th class="text-center">Pesawat</th>
                                             <th class="text-center">Hotel Mekkah</th>
                                             <th class="text-center">Hotel Madinah</th>
                                             <th class="text-center">Harga</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data_paket as $paket) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $paket['kode_paket']; ?></td>
                                             <td><?= $paket['jenis']; ?></td>
                                             <td><?= $paket['nama_paket']; ?></td>
                                             <td><?= $paket['pesawat']; ?></td>
                                             <td><?= $paket['hotel_mekkah']; ?></td>
                                             <td><?= $paket['hotel_madinah']; ?></td>
                                             <td><?= number_format($paket['harga']); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
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