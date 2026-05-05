<?php
ini_set('session.cookie_lifetime', 0);

if(session_status() == PHP_SESSION_NONE)
session_start();
require_once "config/auth.php";

cek_login();

if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}

if(!isset($_SESSION['role'])){
    header("location:login.php");
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Halaman Utama</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
    .nav-sidebar .nav-link.active {
      background-color: #007bff !important;
      color: #fff !important;
      border-radius: 5px;
    }

    .nav-sidebar .nav-link {
      transition: all 0.3s ease;
    }

    .nav-sidebar .nav-link:hover {
      background-color: rgba(0,123,255,0.2);
      transform: translateX(5px);
    }

    .nav-sidebar .nav-link:active {
      transform: scale(0.95);
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="index.php" class="nav-link">Home</a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Contact</a>
  </li>
</ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light">iyuup</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="images (4).jpg" class="img-circle elevation-2">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          <?php
          echo $_SESSION['username'];
          ?>
        </a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

        <li class="nav-item">
          <a href="index.php" class="nav-link <?= ($page == '' ? 'active' : '') ?>">
            <i class="fas fa-home"></i>
            <p>Home</p>
          </a>
        </li>

        <?php if($_SESSION['role'] == 'admin'){ ?>
        <li class="nav-item <?= ($page=='guru' || $page=='mapel' || $page=='kelas' || $page=='siswa' || $page=='jadwal_kelas' || $page=='detail_jadwal') ? 'menu-open' : '' ?>">
        <?php } ?>
          <a href="#" class="nav-link <?= ($page=='guru' || $page=='mapel' || $page=='kelas' || $page=='siswa' || $page=='jadwal_kelas' || $page=='detail_jadwal') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Starter Pages<i class="right fas fa-angle-left"></i></p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="index.php?page=guru" class="nav-link <?= ($page=='guru') ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Guru</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=mapel" class="nav-link <?= ($page=='mapel') ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Mata Pelajaran</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=kelas" class="nav-link <?= ($page=='kelas') ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Kelas</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=siswa" class="nav-link <?= ($page=='siswa') ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Siswa</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=jadwal_kelas" class="nav-link <?= ($page=='jadwal_kelas') ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Jadwal Kelas</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=detail_jadwal" class="nav-link <?= ($page=='detail_jadwal') ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Detail Jadwal</p>    
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Simple Link <span class="right badge badge-danger">New</span></p>
          </a>
        </li>

        <li class="nav-item">
          <a href="logout.php" class="nav-link text-danger" onclick="return confirm('Yakin mau logout?')">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h1 class="m-0">Starter Page</h1>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <?php
          if ($page == "") {
            include "page/dashboard_admin.php";
          } elseif (!file_exists("page/$page.php")) {
            echo "File tidak ditemukan";
          } else {
            include "page/$page.php";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="main-footer">
  <strong>Copyright &copy; Salsabillah Rimadany.</strong>
</footer>

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
  window.addEventListener("beforeunload", function () {
    navigator.sendBeacon("logout.php");
  });
</script>

</body>
</html>