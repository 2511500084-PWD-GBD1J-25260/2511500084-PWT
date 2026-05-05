<?php

require_once "config/auth.php";
hanya_admin();
?>

<?php
include __DIR__ . "/../config/koneksi.php";

if (!isset($conn)) {
    die("Koneksi tidak ditemukan!");
}

$carikode = mysqli_query($conn, "SELECT MAX(kd_guru) as kode FROM guru");
$data = mysqli_fetch_array($carikode);
$kode = $data['kode'];

if ($kode == NULL) {
    $urutan = 1;
} else {
    $urutan = (int) substr($kode, 2) + 1;
}

$hasilkode = "G-" . str_pad($urutan, 3, "0", STR_PAD_LEFT);


if (isset($_POST['tambah'])) {

    $kd_guru = $hasilkode;
    $id_user = $_POST['id_user'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    
    if (empty($nm_guru) || empty($jenkel)) {
        echo '<div class="alert alert-danger">Data tidak boleh kosong!</div>';
        return;
    }

    
    $insert = mysqli_query($conn, "INSERT INTO guru 
    (kd_guru, id_user, nm_guru, jenkel, pend_terakhir, hp, alamat) 
    VALUES 
    ('$kd_guru','$id_user','$nm_guru','$jenkel','$pend','$hp','$alamat')");

    if ($insert) {
        echo '<div class="alert alert-success">Berhasil Disimpan</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
    } else {
        echo '<div class="alert alert-danger">Gagal Disimpan</div>';
    }
}
?>

<section class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form method="POST">

<div class="form-group">
<label>Kode Guru</label>
<input type="text" value="<?= $hasilkode ?>" class="form-control" readonly>
</div>

<div class="form-group">
<label>ID User</label>
<input type="number" name="id_user" class="form-control">
</div>

<div class="form-group">
<label>Nama Guru</label>
<input type="text" name="nm_guru" class="form-control">
</div>

<div class="form-group">
<label>Jenis Kelamin</label>
<select name="jenkel" class="form-control">
    <option value="">-- Pilih --</option>
    <option value="Laki-laki">Laki-laki</option>
    <option value="Perempuan">Perempuan</option>
</select>
</div>

<div class="form-group">
<label>Pendidikan Terakhir</label>
<input type="text" name="pend_terakhir" class="form-control">
</div>

<div class="form-group">
<label>HP</label>
<input type="text" name="hp" class="form-control">
</div>

<div class="form-group">
<label>Alamat</label>
<textarea name="alamat" class="form-control"></textarea>
</div>

<br>
<button type="submit" name="tambah" class="btn btn-primary">Simpan</button>

</form>

</div>
</div>
</div>
</div>
</section>