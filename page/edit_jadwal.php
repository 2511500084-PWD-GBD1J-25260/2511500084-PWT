<?php

require_once "config/auth.php";
hanya_admin();
?>

<?php
include __DIR__ . "/../config/koneksi.php";

if (!isset($conn)) {
    die("Koneksi tidak ditemukan!");
}


$kd = isset($_GET['kd']) ? $_GET['kd'] : '';

if (empty($kd)) {
    die("ID tidak ditemukan!");
}

$query = mysqli_query($conn, "SELECT * FROM jadwal_kelas WHERE id_jadwal='$kd'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan!");
}


if (isset($_POST['update'])) {

    $id_kelas   = $_POST['id_kelas'];
    $thn_ajaran = $_POST['thn_ajaran'];
    $semester   = $_POST['semester'];

    if (empty($id_kelas) || empty($thn_ajaran) || empty($semester)) {
        echo '<div class="alert alert-danger">Data tidak boleh kosong!</div>';
    } else {

        $update = mysqli_query($conn, "UPDATE jadwal_kelas SET
            id_kelas='$id_kelas',
            thn_ajaran='$thn_ajaran',
            semester='$semester'
            WHERE id_jadwal='$kd'
        ");

        if ($update) {
            echo '<div class="alert alert-success">Berhasil diupdate</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal_kelas">';
        } else {
            echo '<div class="alert alert-danger">Gagal: '. mysqli_error($conn) .'</div>';
        }
    }
}
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Edit Jadwal</h1>
  </div>
</div>

<section class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form method="POST">


<div class="form-group">
<label>ID Jadwal</label>
<input type="text" value="<?= $data['id_jadwal']; ?>" class="form-control" readonly>
</div>


<div class="form-group">
<label>Kelas</label>
<select name="id_kelas" class="form-control">
<option value="">-- Pilih Kelas --</option>
<?php
$kelas = mysqli_query($conn, "SELECT * FROM kelas");
while ($k = mysqli_fetch_assoc($kelas)) {
?>
<option value="<?= $k['id_kelas']; ?>"
<?= $k['id_kelas'] == $data['id_kelas'] ? 'selected' : '' ?>>
<?= $k['nm_kelas']; ?>
</option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label>Tahun Ajaran</label>
<input type="text" name="thn_ajaran" value="<?= $data['thn_ajaran']; ?>" class="form-control">
</div>

<div class="form-group">
<label>Semester</label>
<select name="semester" class="form-control">
<option value="ganjil" <?= $data['semester']=='ganjil'?'selected':'' ?>>Ganjil</option>
<option value="genap" <?= $data['semester']=='genap'?'selected':'' ?>>Genap</option>
</select>
</div>

<br>

<button type="submit" name="update" class="btn btn-success">
  Update
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