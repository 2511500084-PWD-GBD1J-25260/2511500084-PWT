<?php

if(!is_admin()){
    echo "Akses ditolak!";
    exit;
}
?>

<?php
require_once __DIR__ . "/../config/koneksi.php";

// VALIDASI ID
if (!isset($_GET['id']) || $_GET['id'] == "") {
    die("ID tidak ditemukan!");
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// AMBIL DATA
$data = mysqli_fetch_array(mysqli_query($conn, "
    SELECT * FROM detail_jadwal WHERE id_detail='$id'
"));

// CEK DATA ADA / TIDAK
if(!$data){
    die("Data tidak ditemukan!");
}
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Edit Detail Jadwal</h1>
  </div>
</div>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<?php
if(isset($_POST['update'])){

    $kd_mapel    = mysqli_real_escape_string($conn, $_POST['kd_mapel']);
    $kd_guru     = mysqli_real_escape_string($conn, $_POST['kd_guru']);
    $hari        = mysqli_real_escape_string($conn, $_POST['hari']);
    $jam_mulai   = mysqli_real_escape_string($conn, $_POST['jam_mulai']);
    $jam_selesai = mysqli_real_escape_string($conn, $_POST['jam_selesai']);
    $ruang       = mysqli_real_escape_string($conn, $_POST['ruang']);

    // VALIDASI JAM
    if($jam_selesai <= $jam_mulai){
        echo "<div class='alert alert-danger'>Jam selesai harus lebih besar dari jam mulai</div>";
    } else {

        $query = mysqli_query($conn, "UPDATE detail_jadwal SET
            kd_mapel='$kd_mapel',
            kd_guru='$kd_guru',
            hari='$hari',
            jam_mulai='$jam_mulai',
            jam_selesai='$jam_selesai',
            ruang='$ruang'
            WHERE id_detail='$id'
        ");

        if($query){
            echo '<div class="alert alert-success">Data berhasil diupdate</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=detail_jadwal">';
        } else {
            echo '<div class="alert alert-danger">Gagal update data</div>';
        }
    }
}
?>

<form method="POST">

<div class="form-group">
  <label>Mapel</label>
  <select name="kd_mapel" class="form-control" required>
    <option value="">-- Pilih Mapel --</option>
    <?php
    $mapel = mysqli_query($conn, "SELECT * FROM mapel");
    while($m = mysqli_fetch_array($mapel)){
        $selected = ($m['kd_mapel'] == $data['kd_mapel']) ? "selected" : "";
        echo "<option value='$m[kd_mapel]' $selected>$m[nm_mapel]</option>";
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
        $selected = ($g['kd_guru'] == $data['kd_guru']) ? "selected" : "";
        echo "<option value='$g[kd_guru]' $selected>$g[nm_guru]</option>";
    }
    ?>
  </select>
</div>

<br>

<div class="form-group">
  <label>Hari</label>
  <select name="hari" class="form-control" required>
    <?php
    $hari_list = ["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
    foreach($hari_list as $h){
        $selected = ($h == $data['hari']) ? "selected" : "";
        echo "<option value='$h' $selected>$h</option>";
    }
    ?>
  </select>
</div>

<br>

<div class="form-group">
  <label>Jam Mulai</label>
  <input type="time" name="jam_mulai" class="form-control" 
         value="<?= $data['jam_mulai']; ?>" required>
</div>

<br>

<div class="form-group">
  <label>Jam Selesai</label>
  <input type="time" name="jam_selesai" class="form-control" 
         value="<?= $data['jam_selesai']; ?>" required>
</div>

<br>

<div class="form-group">
  <label>Ruang</label>
  <input type="text" name="ruang" class="form-control" 
         value="<?= $data['ruang']; ?>" required>
</div>

<br>

<button type="submit" name="update" class="btn btn-primary">
  Update
</button>

<a href="index.php?page=detail_jadwal" class="btn btn-secondary">
  Kembali
</a>

</form>

</div>
</div>
</div>
</div>