<?php require 'config/auth.php'; ?>

<?php $title = 'Dashboard';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card p-3 shadow mt-2 mb-2">
                    <h1 class="">Dashboard</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
               </div>
               <div class="row">
                    <div class="col-xl-4">
                         <div class="card shadow ">
                              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                   <img src="../assets/img/upload/<?= $user['foto'] ?>" alt="Profile"
                                        class="rounded-circle" width="150px">
                                   <h2><?php echo $_SESSION['nama_lengkap'] ?></h2>
                                   <h6><?php echo $_SESSION['kota'] ?> | <?php echo $_SESSION['provinsi'] ?></h6>
                              </div>
                         </div>
                    </div>
                    <div class="col-xl-8">
                         <div class="card shadow">
                              <div class="card-body pt-3">
                                   <!-- Bordered Tabs -->
                                   <ul class="nav nav-tabs nav-tabs-bordered">

                                        <li class="nav-item">
                                             <button class="nav-link active" data-bs-toggle="tab"
                                                  data-bs-target="#profile-overview">Overview</button>
                                        </li>

                                   </ul>
                                   <div class="tab-content pt-2">

                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                             <h5 class="card-title">Detail Profil</h5>

                                             <div class="row">
                                                  <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['nama_lengkap'] ?>
                                                  </div>
                                             </div>

                                             <div class="row">
                                                  <div class="col-lg-3 col-md-4 label">T. Tanggal Lahir</div>
                                                  <div class="col-lg-9 col-md-8">
                                                       <?php echo $_SESSION['tempat_lahir'] ?>,
                                                       <?php echo date('d-M-Y', strtotime($user['tanggal_lahir'])); ?>
                                                  </div>
                                             </div>

                                             <div class="row">
                                                  <div class="col-lg-3 col-md-4 label">Alamat</div>
                                                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['alamat'] ?></div>
                                             </div>

                                             <div class="row">
                                                  <div class="col-lg-3 col-md-4 label">Kabupaten/Kota</div>
                                                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['kota'] ?></div>
                                             </div>

                                             <div class="row">
                                                  <div class="col-lg-3 col-md-4 label">Provinsi</div>
                                                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['provinsi'] ?>
                                                  </div>
                                             </div>

                                             <div class="row">
                                                  <div class="col-lg-3 col-md-4 label">No. Handphone</div>
                                                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['no_hp'] ?></div>
                                             </div>

                                             <div class="row">
                                                  <div class="col-lg-3 col-md-4 label">Email</div>
                                                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['email'] ?></div>
                                             </div>

                                        </div>

                                   </div><!-- End Bordered Tabs -->

                              </div>
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