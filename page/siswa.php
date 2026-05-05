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

    $kd = $_GET['kd'];
    $query = mysqli_query($conn, "DELETE FROM siswa WHERE nis='$kd'");

    if ($query) {
        echo "<div class='alert alert-warning'>Berhasil Di Hapus</div>";
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
    }
}
?>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<?php if(is_admin()){ ?>
<a href="index.php?page=tambah_siswa" class="btn btn-primary btn-sm mb-3">
    Tambah Siswa
</a>
<?php } ?>

<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>NO</th>
    <th>Nis</th>
    <th>Nama Siswa</th>
    <th>Jenis Kelamin</th>
    <th>No HP</th>
    <th>Id Kelas</th>
    <?php if(is_admin()){ ?>
    <th>Aksi</th>
    <?php } ?>
</tr>
</thead>

<tbody>
<?php
$no = 0;
$query = mysqli_query($conn, "SELECT * FROM siswa");
while ($result = mysqli_fetch_array($query)) {
    $no++;
?>
<tr>
    <td><?= $no; ?></td>
    <td><?= $result['nis']; ?></td>
    <td><?= $result['nm_siswa']; ?></td>
    <td><?= $result['jenkel']; ?></td>
    <td><?= $result['hp']; ?></td>
    <td><?= $result['id_kelas']; ?></td>

    <?php if(is_admin()){ ?>
    <td>
        <a href="index.php?page=siswa&action=hapus&kd=<?= $result['nis'] ?>"
        onclick="return confirm('Yakin ingin hapus?')">
        <span class="badge badge-danger">Hapus</span>
        </a>

        <a href="index.php?page=edit_siswa&kd=<?= $result['nis'] ?>">
            <span class="badge badge-warning">Edit</span>
        </a>
    </td>
    <?php } ?>
</tr>
<?php } ?>
</tbody>

</table>

</div>
</div>
</div>
</div>