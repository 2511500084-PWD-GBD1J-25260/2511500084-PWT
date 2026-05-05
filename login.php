<?php
ini_set('session.cookie_lifetime', 0);
session_start();
include "config/koneksi.php";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // VALIDASI KOSONG
    if ($username == "" || $password == "") {
        $error = "Username dan Password wajib diisi!";
    } else {

// ================= LOGIN SISWA =================
$querySiswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$username' AND password='$password'");
$dataSiswa = mysqli_fetch_assoc($querySiswa);

if ($dataSiswa) {
    $_SESSION['username'] = $dataSiswa['nm_siswa'];
    $_SESSION['role'] = 'siswa';
    $_SESSION['nis'] = $dataSiswa['nis'];
    $_SESSION['id_kelas'] = $dataSiswa['id_kelas'];

    header("Location: index.php");
    exit;
}

// ================= LOGIN ADMIN =================
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'admin';
    header("Location: index.php");
    exit;
}
        $error = "Username / Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- iCheck bootstrap -->
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php if(isset($error)){ ?>
      <div class="alert alert-danger">
          <?= $error; ?>
      </div>
      <?php } ?>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">

        <!-- /.col -->
          <div class="col-12">
            <input type="submit" name="login" value="login" class="btn 
            btn-primary btn-block">
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

