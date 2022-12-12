<?php require 'config/auth.php'; ?>

<?php $title = 'Pemesanan';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (create_pemesanan($_POST) > 0) {
        echo "<script>alert('Selamat! Data Pemesanan Berhasil Ditambahkan. Terima Kasih.');window.location='pemesanan'</script>";
    } else {
        echo "<script>alert('Maaf! Data Pemesanan Gagal Ditambahkan.');window.location='pemesanan'</script>";
    }
}

?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow mt-3 mb-3 p-3">
                    <h1>Pemesanan</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Data Pemesanan Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow">
                    <div class="card-body">
                         <?php

                    $ambil = mysqli_query($kon, "SELECT max(no_pemesanan) as kodeTerbesar FROM pemesanan");
                    $data = mysqli_fetch_array($ambil);
                    $kodereg = $data['kodeTerbesar'];

                    // mengambil angka dari nomor terbesar, menggunakan fungsi substr
                    // dan diubah ke integer dengan (int)
                    $urutan = (int) substr($kodereg, 3, 3);

                    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                    $urutan++;

                    // membentuk nomor registrasi baru
                    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
                    $huruf = "PS";
                    $kodereg = $huruf . sprintf("%03s", $urutan);

                    ?>
                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">
                              <div class="row mb-3">
                                   <label for="no_pemesanan" class="col-sm-2 col-form-label">No. Pemesanan</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="no_pemesanan" id="no_pemesanan" class="form-control"
                                             value="<?php echo $kodereg ?>" readonly>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="no_registrasi" class="col-sm-2 col-form-label">No. Registrasi</label>
                                   <div class="col-sm-10">
                                        <select name="no_registrasi" id="no_registrasi" class="form-control" required>
                                             <option value="">Pilih</option>
                                             <?php
                                    $query = mysqli_query($kon, "select * from pendaftaran order by id_pend asc");
                                    $result1 = mysqli_query($kon, "select * from pendaftaran");
                                    while ($row1 = mysqli_fetch_array($result1)) { ?>
                                             <option value="<?= $row1['id_pend'] ?>"><?= $row1['no_registrasi'] ?>
                                             </option>
                                             <?php } ?>
                                        </select>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="tanggal_pemesanan" class="col-sm-2 col-form-label">Tanggal
                                        Pemesanan</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan"
                                             class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="kode_jadwal" class="col-sm-2 col-form-label">Kode Jadwal</label>
                                   <div class="col-sm-10">

                                        <select name="kode_jadwal" id="kode_jadwal" class="form-control"
                                             onchange='changeValue(this.value)' required>
                                             <option value="">Pilih</option>
                                             <?php
                                    $query = mysqli_query($kon, "select * from jadwal order by id_jadwal asc");
                                    $result = mysqli_query($kon, "select * from jadwal");
                                    $jsArray = "var prdName = new Array();\n";
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<option value="' . $row['id_jadwal'] . '">' . $row['kode_jadwal'] . '</option>';
                                        $jsArray .= "prdName['" . $row['id_jadwal'] . "'] = {harga:'" . addslashes($row['harga']) . "' ,kode:'" . addslashes($row['id_jadwal']) . "',kode4:'" . addslashes($row['id_paket']) . "'};\n";
                                    }
                                    ?>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <input type="hidden" name="kode" id="kode" class="form-control" required>
                                   <input type="hidden" name="kode4" id="kode4" class="form-control" required>
                                   <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                   <div class="col-sm-10">
                                        <input type="number" name="harga" id="harga" class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan"
                                             class="btn btn-primary">Tambah Pemesanan</button>
                                   </div>
                              </div>

                         </form><!-- End General Form Elements -->
                    </div>
               </div>
               <div class="row p-3">
                    <div class="card mb-4 shadow">
                         <div class="text-center p-3">
                              <h5>Tabel Pemesanan Albadriyah Wisata</h5>
                         </div>
                         <div class="card-body">
                              <table id="datatablesSimple" class="table table-bordered table-hover">
                                   <thead class="table-dark">
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">No. Pemesanan</th>
                                             <th class="text-center">No. Registrasi</th>
                                             <th class="text-center">Tanggal Pemesanan</th>
                                             <th class="text-center">Kode Jadwal</th>
                                             <th class="text-center">Harga</th>
                                             <th class="text-center">Telah Bayar</th>
                                             <th class="text-center">Sisa</th>
                                             <th class="text-center">Status</th>
                                             <th class="text-center">Aksi</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php
                                $data_pemesanan = "SELECT * FROM pemesanan
                                            INNER JOIN pendaftaran ON pemesanan.id_pend = pendaftaran.id_pend
                                            INNER JOIN jadwal ON pemesanan.id_jadwal = jadwal.id_jadwal
                                            ";
                                $sql_rm = mysqli_query($kon, $data_pemesanan) or die(mysqli_error($kon));
                                while ($pemesanan = mysqli_fetch_array($sql_rm)) {
                                ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $pemesanan['no_pemesanan']; ?></td>
                                             <td><?= $pemesanan['no_registrasi']; ?></td>
                                             <td><?= date('d-M-Y', strtotime($pemesanan['tanggal_pemesanan'])); ?></td>
                                             <td><?= $pemesanan['kode_jadwal']; ?></td>
                                             <td>Rp. <?= number_format($pemesanan['harga'], 0, ',', '.'); ?></td>
                                             <td>Rp. <?= number_format($pemesanan['telah_bayar'], 0, ',', '.'); ?></td>
                                             <td>Rp. <?= number_format($pemesanan['sisa'], 0, ',', '.'); ?></td>
                                             <td><?= $pemesanan['status']; ?></td>
                                             <td>
                                                  <a href="ubah-pemesanan?id_pemesanan=<?= $pemesanan['id_pemesanan']; ?>"
                                                       class="btn btn-success">Edit</a>
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

<script type="text/javascript">
<?php echo $jsArray; ?>

function changeValue(id) {
     document.getElementById('harga').value = prdName[id].harga;
     document.getElementById('kode').value = prdName[id].kode;
     document.getElementById('kode4').value = prdName[id].kode4;
};
</script>