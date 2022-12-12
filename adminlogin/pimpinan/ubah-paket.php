<?php require 'config/auth.php'; ?>

<?php $title = 'Ubah Data Paket';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (update_paket($_POST) > 0) {
        echo "<script>alert('Selamat! Data Paket Berhasil Di Update. Terima Kasih.');window.location='paket'</script>";
    } else {
        echo "<script>alert('Maaf! Data Paket Gagal Di Update.');window.location='paket'</script>";
    }
}

// Ambil id paket dari url
$id_paket = (int)$_GET['id_paket'];

// Query ambil data user
$paketid = select("SELECT * FROM paket WHERE id_paket = $id_paket")[0];

?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow p-3 mt-3 mb-3">
                    <h1>Paket</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Update Paket Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow">
                    <div class="card-body">

                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="id_paket" id="id_paket" value="<?= $paketid['id_paket']; ?>">
                              <div class="row mb-3">
                                   <label for="kode_paket" class="col-sm-2 col-form-label">Kode Paket</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="kode_paket" id="kode_paket" class="form-control"
                                             value="<?= $paketid['kode_paket']; ?>" readonly>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="nama_paket" class="col-sm-2 col-form-label">Nama Paket</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nama_paket" id="nama_paket" class="form-control"
                                             value="<?= $paketid['nama_paket']; ?>">
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="jenis" class="col-sm-2 col-form-label">Jenis Paket</label>
                                   <div class="col-sm-10">
                                        <select name="jenis" id="jenis" class="form-control" required>
                                             <option value="">Pilih jenis paket</option>
                                             <option value="umroh"
                                                  <?php if($paketid['jenis'] == 'umroh') { echo 'selected'; } ?>>Umroh
                                             </option>
                                             <option value="haji"
                                                  <?php if($paketid['jenis'] == 'haji') { echo "selected"; }?>>Haji
                                             </option>
                                        </select>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="pesawat" class="col-sm-2 col-form-label">Pesawat</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="pesawat" id="pesawat" class="form-control"
                                             value="<?= $paketid['pesawat']; ?>">
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="hotel_mekkah" class="col-sm-2 col-form-label">Hotel Mekkah</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="hotel_mekkah" id="hotel_mekkah" class="form-control"
                                             value="<?= $paketid['hotel_mekkah']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="hotel_madinah" class="col-sm-2 col-form-label">Hotel Madinah</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="hotel_madinah" id="hotel_madinah" class="form-control"
                                             value="<?= $paketid['hotel_madinah']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan"
                                             class="btn btn-primary">Update Paket</button>
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