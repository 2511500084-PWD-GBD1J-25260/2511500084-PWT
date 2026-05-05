<?php
require_once "config/Koneksi.php";

/** @var mysqli $conn */

// CEK LOGIN (PAKAI JAVASCRIPT, BUKAN HEADER)
if (!isset($_SESSION['username'])) {
    echo "<script>window.location='login.php';</script>";
    exit;
}

// PROSES SIMPAN
if (isset($_POST['simpan'])) {

    $username = $_SESSION['username'];
    $p1 = $_POST['p1'];
    $pb = $_POST['pb'];

    // cek password lama
    $cek = mysqli_query($conn,
    "SELECT * FROM admin WHERE username='$username' AND password='$p1'");

    if (mysqli_num_rows($cek) > 0) {

        mysqli_query($conn,
        "UPDATE admin SET password='$pb' WHERE username='$username'");

        echo "<script>alert('password berhasil diganti');</script>";

        // redirect sesuai role
        if ($_SESSION['role'] == "guru") {
            echo "<script>window.location='index.php?page=guru';</script>";
        } elseif ($_SESSION['role'] == "siswa") {
            echo "<script>window.location='index.php?page=siswa';</script>";
        } else {
            echo "<script>window.location='index.php?page=dashboard';</script>";
        }

        exit;

    } else {
        echo "<div class='alert alert-danger'>password lama salah</div>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <h1>ganti password</h1>
    </div>
</div>

<form method="POST">
    <input type="password" name="p1" placeholder="password Lama" class="form-control" required><br>
    <input type="password" name="pb" placeholder="password Baru" class="form-control" required><br>

    <button type="submit" name="simpan" class="btn btn-primary">
        ganti password
    </button>
</form>