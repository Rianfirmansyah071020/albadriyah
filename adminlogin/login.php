<?php
session_start();
include 'config/app.php';


if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($kon, "SELECT * FROM admin WHERE username ='$username'");

    // Cek username
    if (mysqli_num_rows($result) === 1) {
        // Cek Password
        $row = mysqli_fetch_assoc($result);
        if ($row['level'] == "Admin") {
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['tempat_lahir'] = $row['tempat_lahir'];
            $_SESSION['tanggal_lahir'] = $row['tanggal_lahir'];
            $_SESSION['alamat'] = $row['alamat'];
            $_SESSION['nohp'] = $row['nohp'];
            $_SESSION['foto'] = $row['foto'];
            echo "<script>alert('Login Berhasil! Silahkan Klik Tombol OK.');window.location='admin'</script>";
        } else if ($row['level'] == "Pimpinan") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['tempat_lahir'] = $row['tempat_lahir'];
            $_SESSION['tanggal_lahir'] = $row['tanggal_lahir'];
            $_SESSION['alamat'] = $row['alamat'];
            $_SESSION['nohp'] = $row['nohp'];
            $_SESSION['foto'] = $row['foto'];
            // alihkan ke halaman dashboard pimpinan
            echo "<script>alert('Login Berhasil! Silahkan Klik Tombol OK.');window.location='pimpinan'</script>";
        } else {
            // alihkan ke halaman login kembali
            echo "<script>alert('Gagal Login! Silahkan Memasukkan Username Dan Password Dengan Benar. Terima Kasih.');window.location='login'</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="" />
     <meta name="author" content="" />
     <title>Login Admin Albadriyah Wisata</title>
     <link href="css/styles.css" rel="stylesheet" />
     <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
     <div id="layoutAuthentication">
          <div id="layoutAuthentication_content">
               <main>
                    <div class="container">
                         <div class="row justify-content-center">
                              <div class="col-lg-5">
                                   <div class="card shadow-lg border-0 rounded-lg mt-5">
                                        <div class="card-header"><Br />
                                             <center><img src="assets/img/logo2.png"></center>
                                             <h3 class="text-center font-weight-light my-4">Login Admin</h3>
                                        </div>
                                        <div class="card-body">
                                             <form action="" method="POST">
                                                  <div class="form-floating mb-3">
                                                       <input class="form-control" name="username" id="username"
                                                            type="text" placeholder="name@example.com" />
                                                       <label for="username">Username</label>
                                                  </div>
                                                  <div class="form-floating mb-3">
                                                       <input class="form-control" name="password" id="password"
                                                            type="password" placeholder="Password" />
                                                       <label for="password">Password</label>
                                                  </div>
                                                  <div
                                                       class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                       <button class="btn btn-primary w-100" type="submit" name="login"
                                                            id="login">Login</button>
                                                  </div>
                                             </form>
                                        </div>
                                        <div class="card-footer text-center py-3">
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </main>
          </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
     </script>
     <script src="js/scripts.js"></script>
</body>

</html>