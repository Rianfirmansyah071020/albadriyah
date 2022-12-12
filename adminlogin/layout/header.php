<?php

include 'config/app.php';

$tampiluser =mysqli_query($kon, "SELECT * FROM admin WHERE username='$_SESSION[username]'");
$user =mysqli_fetch_array($tampiluser);
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="" />
     <meta name="author" content="" />
     <title>Dashboard Admin - Albadriyah Wisata</title>
     <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
     <link href="css/styles.css" rel="stylesheet" />
     <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
     <script src="js/jquery-3.4.1.js"></script>
     <link rel="stylesheet" href="../admin/sass/main.css">
</head>

<body class="sb-nav-fixed">
     <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
          <!-- Navbar Brand-->
          <a class="navbar-brand ps-3" href="halaman_admin">Albadriyah Wisata</a>
          <!-- Sidebar Toggle-->
          <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
          <!-- Navbar Search-->
          <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

          </form>
          <!-- Navbar-->
          <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
               <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                         data-bs-toggle="dropdown" aria-expanded="false">
                         <img src="../../assets/img/upload/<?= $_SESSION['foto'] ?>" alt="" class="img-profil">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                         <li><a class="dropdown-item" href="logout">Logout</a></li>
                    </ul>
               </li>
          </ul>
     </nav>