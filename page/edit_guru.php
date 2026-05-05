<?php

require_once "config/auth.php";
hanya_admin();
?>

<?php
include __DIR__ . "/../config/koneksi.php";

if (!isset($conn)) {
    die("Koneksi tidak ditemukan!");
}


$kd = $_GET['kd'];


$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM guru WHERE kd_guru='$kd'"));


if (isset($_POST['Update'])) {

    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    
    if (empty($nm_guru) || empty($jenkel)) {
        echo '<div class="alert alert-danger">Data tidak boleh kosong!</div>';
        return;
    }

    
    $update = mysqli_query($conn, "UPDATE guru SET 
        nm_guru='$nm_guru',
        jenkel='$jenkel',
        pend_terakhir='$pend',
        hp='$hp',
        alamat='$alamat'
        WHERE kd_guru='$kd'
    ");

    if ($update) {
        echo '<div class="alert alert-success">Data berhasil diupdate</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
    } else {
        echo '<div class="alert alert-danger">Gagal update</div>';
    }
}
?>

<section class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<h3>Edit Data Guru</h3>

<form method="POST">

<div class="form-group">
<label>Kode Guru</label>
<input type="text" value="<?= $data['kd_guru']; ?>" class="form-control" readonly>
</div>

<div class="form-group">
<label>Nama Guru</label>
<input type="text" name="nm_guru" value="<?= $data['nm_guru']; ?>" class="form-control">
</div>

<div class="form-group">
<label>Jenis Kelamin</label>
<select name="jenkel" class="form-control">
    <option value="L" <?= $data['jenkel']=='L'?'selected':'' ?>>Laki-laki</option>
    <option value="P" <?= $data['jenkel']=='P'?'selected':'' ?>>Perempuan</option>
</select>
</div>

<div class="form-group">
<label>Pendidikan Terakhir</label>
<input type="text" name="pend_terakhir" value="<?= $data['pend_terakhir']; ?>" class="form-control">
</div>

<div class="form-group">
<label>HP</label>
<input type="text" name="hp" value="<?= $data['hp']; ?>" class="form-control">
</div>

<div class="form-group">
<label>Alamat</label>
<textarea name="alamat" class="form-control"><?= $data['alamat']; ?></textarea>
</div>

<br>
<button type="submit" name="Update" class="btn btn-primary">Update</button>

<a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>
</div>
</div>
</section>