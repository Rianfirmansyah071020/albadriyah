<?php require 'config/auth.php'; ?>

<?php $title = 'Update Data Jadwal';  ?>

<?php include 'layout/header.php'; ?>

<?php
$data_jadwal = select("SELECT * FROM jadwal");
?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (update_jadwal($_POST) > 0) {
        echo "<script>alert('Selamat! Data Jadwal Berhasil Di Update. Terima Kasih.');window.location='jadwal'</script>";
    } else {
        echo "<script>alert('Maaf! Data Jadwal Gagal Di Update.');window.location='jadwal'</script>";
    }
}

// Ambil id jadwal dari url
$id_jadwal = (int)$_GET['id_jadwal'];

// Query ambil data user
$jadwalid = select("SELECT * FROM paket, jadwal WHERE id_jadwal = $id_jadwal")[0];

?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow mb-3 mt-3 p-3">
                    <h1>Jadwal</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Update Jadwal Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow">
                    <div class="card-body">
                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="id_jadwal" id="id_jadwal"
                                   value="<?= $jadwalid['id_jadwal']; ?>">
                              <div class="row mb-3">
                                   <label for="kode_jadwal" class="col-sm-2 col-form-label">Kode Jadwal</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="kode_jadwal" id="kode_jadwal" class="form-control"
                                             value="<?= $jadwalid['kode_jadwal']; ?>" readonly>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="kode_paket" class="col-sm-2 col-form-label">Kode Paket</label>
                                   <div class="col-sm-10">
                                        <select name="kode_paket" id="kode_paket" class="form-control" required>
                                             <option value="">Pilih kode paket</option>
                                             <?php
                                    //query menampilkan data kode paket ke combobox
                                    $query    = mysqli_query($kon, "SELECT * FROM paket ORDER BY id_paket");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                             <option value="<?= $data['id_paket']; ?>">
                                                  <?php echo $data['kode_paket']; ?></option>
                                             <?php
                                    }
                                    ?>
                                        </select>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                   <div class="col-sm-10">
                                        <input type="number" name="harga" id="harga" class="form-control"
                                             value="<?= $jadwalid['harga']; ?>">
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="isi_kamar" class="col-sm-2 col-form-label">Isi Kamar</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="isi_kamar" id="isi_kamar" class="form-control"
                                             value="<?= $jadwalid['isi_kamar']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="tanggal_keberangkatan" class="col-sm-2 col-form-label">Tgl.
                                        Keberangkatan</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_keberangkatan" id="tanggal_keberangkatan"
                                             class="form-control" value="<?= $jadwalid['tanggal_keberangkatan']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="nopesawat" class="col-sm-2 col-form-label">No. Pesawat</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nopesawat" id="nopesawat" class="form-control"
                                             value="<?= $jadwalid['nopesawat']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="tanggal_kepulangan" class="col-sm-2 col-form-label">Tgl.
                                        Kepulangan</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_kepulangan" id="tanggal_kepulangan"
                                             class="form-control" value="<?= $jadwalid['tanggal_kepulangan']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="kuota_pendaftaran" class="col-sm-2 col-form-label">Kuota
                                        Pendaftaran</label>
                                   <div class="col-sm-10">
                                        <input type="number" name="kuota_pendaftaran" id="kuota_pendaftaran"
                                             class="form-control" value="<?= $jadwalid['kuota_pendaftaran']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan"
                                             class="btn btn-primary">Update Jadwal</button>
                                   </div>
                              </div>

                         </form><!-- End General Form Elements -->
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