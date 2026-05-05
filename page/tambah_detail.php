<?php

require_once "config/auth.php";
hanya_admin();
?>

<?php
require_once __DIR__ . "/../config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Tambah Detail Jadwal</h1>
  </div>
</div>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<?php
if(isset($_POST['tambah'])){

    // AMANKAN INPUT
    $id_jadwal   = mysqli_real_escape_string($conn, $_POST['id_jadwal'] ?? '');
    $kd_mapel    = mysqli_real_escape_string($conn, $_POST['kd_mapel'] ?? '');
    $kd_guru     = mysqli_real_escape_string($conn, $_POST['kd_guru'] ?? '');
    $hari        = mysqli_real_escape_string($conn, $_POST['hari'] ?? '');
    $jam_mulai   = $_POST['jam_mulai'] ?? '';
    $jam_selesai = $_POST['jam_selesai'] ?? '';
    $ruang       = mysqli_real_escape_string($conn, $_POST['ruang'] ?? '');

    if($id_jadwal=='' || $kd_mapel=='' || $kd_guru=='' || $hari=='' || $jam_mulai=='' || $jam_selesai=='' || $ruang==''){
        echo '<div class="alert alert-danger">Semua data wajib diisi</div>';
    } 
    // VALIDASI JAM
    elseif($jam_selesai <= $jam_mulai){
        echo '<div class="alert alert-danger">Jam selesai harus lebih besar dari jam mulai</div>';
    } 
    else {

        $query = mysqli_query($conn, "INSERT INTO detail_jadwal 
        (id_jadwal, kd_mapel, kd_guru, hari, jam_mulai, jam_selesai, ruang)
        VALUES 
        ('$id_jadwal','$kd_mapel','$kd_guru','$hari','$jam_mulai','$jam_selesai','$ruang')");

        if($query){
            echo '<div class="alert alert-success">Data berhasil ditambahkan</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=detail_jadwal">';
        } else {
            echo '<div class="alert alert-danger">Gagal menambahkan data</div>';
        }
    }
}
?>

<form method="POST">

<div class="form-group">
  <label>Jadwal Kelas</label>
  <select name="id_jadwal" class="form-control" required>
    <option value="">-- Pilih Jadwal --</option>
    <?php
    $jadwal = mysqli_query($conn, "SELECT * FROM jadwal_kelas");
    while($j = mysqli_fetch_array($jadwal)){
        echo "<option value='$j[id_jadwal]'>ID Jadwal: $j[id_jadwal]</option>";
    }
    ?>
  </select>
</div>

<br>

<div class="form-group">
  <label>Mapel</label>
  <select name="kd_mapel" class="form-control" required>
    <option value="">-- Pilih Mapel --</option>
    <?php
    $mapel = mysqli_query($conn, "SELECT * FROM mapel");
    while($m = mysqli_fetch_array($mapel)){
        echo "<option value='$m[kd_mapel]'>$m[nm_mapel]</option>";
    }
    ?>
  </select>
</div>

<br>

<div class="form-group">
  <label>Guru</label>
  <select name="kd_guru" class="form-control" required>
    <option value="">-- Pilih Guru --</option>
    <?php
    $guru = mysqli_query($conn, "SELECT * FROM guru");
    while($g = mysqli_fetch_array($guru)){
        echo "<option value='$g[kd_guru]'>$g[nm_guru]</option>";
    }
    ?>
  </select>
</div>

<br>

<div class="form-group">
  <label>Hari</label>
  <select name="hari" class="form-control" required>
    <option value="">-- Pilih Hari --</option>
    <option>Senin</option>
    <option>Selasa</option>
    <option>Rabu</option>
    <option>Kamis</option>
    <option>Jumat</option>
    <option>Sabtu</option>
  </select>
</div>

<br>

<div class="form-group">
  <label>Jam Mulai</label>
  <input type="time" name="jam_mulai" class="form-control" required>
</div>

<br>

<div class="form-group">
  <label>Jam Selesai</label>
  <input type="time" name="jam_selesai" class="form-control" required>
</div>

<br>

<div class="form-group">
  <label>Ruang</label>
  <input type="text" name="ruang" class="form-control" required>
</div>

<br>

<button type="submit" name="tambah" class="btn btn-primary">
  Simpan
</button>

<a href="index.php?page=detail_jadwal" class="btn btn-secondary">
  Kembali
</a>

</form>

</div>
</div>
</div>
</div>