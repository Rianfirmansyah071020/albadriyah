<?php require 'config/auth.php'; ?>

<?php $title = 'Tambah Data Admin';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (create_admin($_POST) > 0) {
        echo "<script>alert('Selamat! Data Admin Berhasil Ditambahkan. Terima Kasih.');window.location='tambah-admin'</script>";
    } else {
        echo "<script>alert('Maaf! Data Admin Gagal Ditambahkan. Terima Kasih.');window.location='tambah-admin'</script>";
    }
}

?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card mb-3 mt-3 p-3 shadow">
                    <h1>Data Admin</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                         <li class="breadcrumb-item active">Data Admin</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow">
                    <div class="card-body">
                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">
                              <div class="row mb-3">
                                   <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                             required>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                             required>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tgl. Lahir</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                             required>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="alamat" id="alamat" class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="nohp" class="col-sm-2 col-form-label">No. Handphone</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nohp" id="nohp" class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="username" class="col-sm-2 col-form-label">Username</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="username" id="username" class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="password" class="col-sm-2 col-form-label">Password</label>
                                   <div class="col-sm-10">
                                        <input type="password" name="password" id="password" class="form-control"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="level" class="col-sm-2 col-form-label">Level</label>
                                   <div class="col-sm-10">
                                        <select name="level" id="level" class="form-control" required>
                                             <option disabled="disabled" selected="selected">Pilih</option>
                                             <option>Admin</option>
                                             <option>Pimpinan</option>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                   <div class="col-sm-10">
                                        <input type="file" name="foto" id="foto" class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan"
                                             class="btn btn-primary">Tambah Admin</button>
                                   </div>
                              </div>

                         </form><!-- End General Form Elements -->
                    </div>
               </div>
               <div class="card mb-4 shadow p-3">
                    <div class="text-center p-3">
                         <h5>Tabel Data Admin</h5>
                    </div>
                    <div class="card-body">
                         <table id="datatablesSimple" class="table table-bordered table-hover">
                              <thead class="table-dark">
                                   <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Nama Lengkap</th>
                                        <th class="text-center">Tempat Lahir</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">No. Handphone</th>
                                        <th class="text-center">Level</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                            $data_admin = select("SELECT * FROM admin"); ?>
                                   <?php $no = 1; ?>
                                   <?php foreach ($data_admin as $admin) : ?>
                                   <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $admin['username']; ?></td>
                                        <td><?= $admin['nama_lengkap']; ?></td>
                                        <td><?= $admin['tempat_lahir']; ?></td>
                                        <td><?= date('d-M-Y', strtotime($admin['tanggal_lahir'])); ?></td>
                                        <td><?= $admin['alamat']; ?></td>
                                        <td><?= $admin['nohp']; ?></td>
                                        <td><?= $admin['level']; ?></td>
                                        <td><img src="../../assets/img/upload/<?= $admin['foto'] ?>" width="50px"></td>
                                        <td width="15%">
                                             <a href="ubah-admin?id_user=<?= $admin['id_user']; ?>"
                                                  class="btn btn-success"
                                                  onclick="return confirm('Apakah Anda Yakin Untuk Edit Data Admin?')">Edit</a>
                                             <a href=" hapus-admin?id_user=<?= $admin['id_user']; ?>"
                                                  class="btn btn-danger"
                                                  onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Admin?')">Hapus</a>
                                        </td>
                                   </tr>
                                   <?php endforeach; ?>
                              </tbody>
                         </table>
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