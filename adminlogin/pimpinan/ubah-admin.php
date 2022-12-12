<?php require 'config/auth.php'; ?>

<?php $title = 'Edit Data Admin';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (update_admin($_POST) > 0) {
        echo "<script>alert('Selamat! Data Admin Berhasil Di Update. Terima Kasih.');window.location='tambah-admin'</script>";
    } else {
        echo "<script>alert('Maaf! Data Admin Gagal Di Update. Terima Kasih.');window.location='tambah-admin'</script>";
    }
}

// Ambil id user dari url
$id_user = (int)$_GET['id_user'];

// Query ambil data user
$admin = select("SELECT * FROM admin WHERE id_user = $id_user")[0];
?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card mb-3 mt-3 shadow p-3">
                    <h1>Ubah Admin</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                         <li class="breadcrumb-item active">Ubah Admin</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow">
                    <div class="card-body">
                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="id_user" id="id_user" value="<?= $admin['id_user']; ?>">
                              <input type="hidden" name="fotolama" id="fotolama" value="<?= $admin['foto']; ?>">
                              <div class="row mb-3">
                                   <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                             required value="<?= $admin['nama_lengkap']; ?>">
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                             required value="<?= $admin['tempat_lahir']; ?>">
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tgl. Lahir</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                             required value="<?= $admin['tanggal_lahir']; ?>">
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="alamat" id="alamat" class="form-control" required
                                             value="<?= $admin['alamat']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="nohp" class="col-sm-2 col-form-label">No. Handphone</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nohp" id="nohp" class="form-control" required
                                             value="<?= $admin['nohp']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="username" class="col-sm-2 col-form-label">Username</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="username" id="username" class="form-control" disabled
                                             required value="<?= $admin['username']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="password" class="col-sm-2 col-form-label">Password</label>
                                   <div class="col-sm-10">
                                        <input type="password" name="password" id="password" class="form-control">
                                        <small>Silahkan kosongkan password jika tidak ingin diganti.</small>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="level" class="col-sm-2 col-form-label">Level</label>
                                   <div class="col-sm-10">
                                        <select name="level" id="level" class="form-control" required>
                                             <?php $level = $admin['level']; ?>
                                             <option value="Admin" <?= $level == 'Admin' ? 'selected' : null ?>>Admin
                                             </option>
                                             <option value="Pimpinan" <?= $level == 'Pimpinan' ? 'selected' : null ?>>
                                                  Pimpinan</option>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                   <div class="col-sm-10">
                                        <input type="file" name="foto" id="foto" class="form-control">
                                        <p>
                                             <small>Gambar Sebelumnya</small>
                                        </p>
                                        <a href="assets/img/<?= $admin['foto']; ?>" target="_blank">
                                             <img src="../../assets/img/upload/<?= $_SESSION['foto'] ?>" alt="foto"
                                                  width="100px"></a>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan" class="btn btn-primary"
                                             style="float : right; ">Update Data</button>
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