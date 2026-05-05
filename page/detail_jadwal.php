<?php
include "config/koneksi.php";
require_once "config/auth.php";
cek_login();

// PROTEKSI HAPUS
if (isset($_GET['action']) && $_GET['action'] == "hapus") {

    if(!is_admin()){
    echo "Akses ditolak!";
    exit;
    }

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $query = mysqli_query($conn, "DELETE FROM detail_jadwal WHERE id_detail='$id'");

    if ($query) {
        echo '<div class="alert alert-warning">Berhasil Dihapus</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=detail_jadwal">';
    }
}
?>

<div class="content">   
<div class="container-fluid">
<div class="card">
<div class="card-body">

<?php if(is_admin()){ ?>
<a href="index.php?page=tambah_detail" class="btn btn-primary btn-sm">
  Tambah Detail Jadwal
</a>
<?php } ?>

<br><br>

<table class="table table-bordered table-striped">
<thead>
<tr>
  <th>No</th>
  <th>ID Jadwal</th>
  <th>Mapel</th>
  <th>Guru</th>
  <th>Hari</th>
  <th>Jam</th>
  <th>Ruang</th>
  <?php if(is_admin()){ ?>
  <th>Aksi</th>
  <?php } ?>
</tr>
</thead>

<tbody>
<?php
$no = 1;

$query = mysqli_query($conn, "
    SELECT dj.*, m.nm_mapel, g.nm_guru
    FROM detail_jadwal dj
    LEFT JOIN mapel m ON dj.kd_mapel = m.kd_mapel
    LEFT JOIN guru g ON dj.kd_guru = g.kd_guru
");

while ($result = mysqli_fetch_array($query)) {
?>
<tr>
  <td><?= $no++; ?></td>
  <td><?= $result['id_jadwal']; ?></td>
  <td><?= $result['nm_mapel']; ?></td>
  <td><?= $result['nm_guru']; ?></td>
  <td><?= $result['hari']; ?></td>
  <td><?= $result['jam_mulai']; ?> - <?= $result['jam_selesai']; ?></td>
  <td><?= $result['ruang']; ?></td>

  <?php if(is_admin()){ ?>
  <td>
    <a href="index.php?page=detail_jadwal&action=hapus&id=<?= $result['id_detail']; ?>"
       onclick="return confirm('Yakin ingin hapus?')">
      <span class="badge badge-danger">Hapus</span>
    </a>

    <a href="index.php?page=edit_detail&id=<?= $result['id_detail']; ?>">
      <span class="badge badge-warning">Edit</span>
    </a>
  </td>
  <?php } ?>

</tr>
<?php
}
?>
</tbody>

</table>

</div>
</div>
</div>
</div>