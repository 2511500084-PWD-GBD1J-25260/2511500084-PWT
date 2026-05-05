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
    $query = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas='$kd'");

    if ($query) {
        echo "<div class='alert alert-warning'>Berhasil Di Hapus</div>";
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
    }
}
?>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<?php if(is_admin()){ ?>
<a href="index.php?page=tambah_kelas" class="btn btn-primary btn-sm mb-3">
    Tambah Kelas
</a>
<?php } ?>

<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>NO</th>
    <th>Id kelas</th>
    <th>Nama kelas</th>
    <?php if(is_admin()){ ?>
    <th>Aksi</th>
    <?php } ?>
</tr>
</thead>

<tbody>
<?php
$no = 0;
$query = mysqli_query($conn, "SELECT * FROM kelas");
while ($result = mysqli_fetch_array($query)) {
    $no++;
?>
<tr>
    <td><?= $no; ?></td>
    <td><?= $result['id_kelas']; ?></td>
    <td><?= $result['nm_kelas']; ?></td>

    <?php if(is_admin()){ ?>
    <td>
        <a href="index.php?page=kelas&action=hapus&kd=<?= $result['id_kelas'] ?>"
        onclick="return confirm('Yakin ingin hapus?')">
        <span class="badge badge-danger">Hapus</span>
        </a>

        <a href="index.php?page=edit_kelas&kd=<?= $result['id_kelas'] ?>">
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