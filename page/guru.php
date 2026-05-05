<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Guru</h1>
            </div>
        </div>
    </div>
</div>

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
    $query = mysqli_query($conn, "DELETE FROM guru WHERE kd_guru='$kd'");

    if ($query) {
        echo "<div class='alert alert-warning'>Berhasil Di Hapus</div>";
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
    }
}
?>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<?php if(is_admin()){ ?>
<a href="index.php?page=tambah_guru" class="btn btn-primary btn-sm mb-3">
    Tambah Guru
</a>
<?php } ?>

<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>NO</th>
    <th>Kd Guru</th>
    <th>Id User</th>
    <th>Nama Guru</th>
    <th>Jenis Kelamin</th>
    <th>Pendidikan Terakhir</th>
    <th>No HP</th>
    <th>Alamat</th>
    <?php if(is_admin()){ ?>
    <th>Aksi</th>
    <?php } ?>
</tr>
</thead>

<tbody>
<?php
$no = 0;
$query = mysqli_query($conn, "SELECT * FROM guru");
while ($result = mysqli_fetch_array($query)) {
    $no++;
?>
<tr>
    <td><?= $no; ?></td>
    <td><?= $result['kd_guru']; ?></td>
    <td><?= $result['id_user']; ?></td>
    <td><?= $result['nm_guru']; ?></td>
    <td><?= $result['jenkel']; ?></td>
    <td><?= $result['pend_terakhir']; ?></td>
    <td><?= $result['hp']; ?></td>
    <td><?= $result['alamat']; ?></td>

    <?php if(is_admin()){ ?>
    <td>
        <a href="index.php?page=guru&action=hapus&kd=<?= $result['kd_guru'] ?>"
        onclick="return confirm('Yakin ingin hapus?')">
        <span class="badge badge-danger">Hapus</span>
        </a>

        <a href="index.php?page=edit_guru&kd=<?= $result['kd_guru'] ?>">
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