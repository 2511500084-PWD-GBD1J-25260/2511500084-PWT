<?php

require_once "config/auth.php";
hanya_admin();
?>

<?php
include __DIR__ . "/../config/koneksi.php";

if (isset($_POST['tambah'])) {

    $id_kelas   = $_POST['id_kelas'];
    $thn_ajaran = $_POST['thn_ajaran'];
    $semester   = $_POST['semester'];

    if (empty($id_kelas) || empty($thn_ajaran) || empty($semester)) {
        echo '<div class="alert alert-danger">Data tidak boleh kosong!</div>';
    } else {

        $insert = mysqli_query($conn, "INSERT INTO jadwal_kelas 
        (id_kelas, thn_ajaran, semester) 
        VALUES ('$id_kelas','$thn_ajaran','$semester')");

        if ($insert) {
            echo '<div class="alert alert-success">Berhasil ditambahkan</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal_kelas">';
        } else {
            echo '<div class="alert alert-danger">Gagal: '. mysqli_error($conn) .'</div>';
        }
    }
}
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Tambah Jadwal</h1>
  </div>
</div>

<section class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form method="POST">

<!-- KELAS -->
<div class="form-group">
<label>Kelas</label>
<select name="id_kelas" class="form-control">
<option value="">-- Pilih Kelas --</option>
<?php
$kelas = mysqli_query($conn, "SELECT * FROM kelas");
while ($k = mysqli_fetch_assoc($kelas)) {
?>
<option value="<?= $k['id_kelas']; ?>">
    <?= $k['nm_kelas']; ?>
</option>
<?php } ?>
</select>
</div>


<div class="form-group">
<label>Tahun Ajaran</label>
<input type="text" name="thn_ajaran" class="form-control" placeholder="2025/2026">
</div>


<div class="form-group">
<label>Semester</label>
<select name="semester" class="form-control">
<option value="">-- Pilih --</option>
<option value="ganjil">Ganjil</option>
<option value="genap">Genap</option>
</select>
</div>

<br>

<button type="submit" name="tambah" class="btn btn-primary">
  Simpan
</button>

<a href="index.php?page=jadwal_kelas" class="btn btn-secondary">
  Kembali
</a>

</form>

</div>
</div>
</div>
</div>
</section>