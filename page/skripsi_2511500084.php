<?php
require_once "config/koneksi.php";

/** @var mysqli $conn */
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Skripsi</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
  if($_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    $query = mysqli_query($conn, "DELETE FROM skripsi_2511500084 where id_skripsi084 = '$kd' ");
    if ($query){
      echo '
      <div class="alert alert-warning alert-dismissible">
      Berhasil Di Hapus</div>';
      echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi_2511500084">';
    }
  }
}
?>

<div class="content">
    <div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <a href="index.php?page=tambah_skripsi2511500084" class="btn btn-primary btn-sm">
            Tambah Skripsi</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Skripsi</th>
                        <th>Judul Skripsi</th>
                        <th>Topik Skripsi</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <?php
                $no = 0;
                $query = mysqli_query($conn, "SELECT * FROM skripsi_2511500084"); while ($result = mysqli_fetch_array($query)) {
                    $no++;
                ?>

                <tbody>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $result['id_skripsi084']; ?></td>
                        <td><?= $result['judul_skripsi084']; ?></td>
                        <td><?= $result['topik_skripsi084']; ?></td>
                        <td><?= $result['semester084']; ?></td>
                        <td><?= $result['thn_ajaran084']; ?></td>
                        <td>
                            <a href="index.php?page=skripsi_2511500084&action=hapus&kd=<?= $result['id_skripsi084'] ?>">
                                <span class="badge badge-danger">Hapus</span></a>

                            <a href="index.php?page=edit_skripsi&kd=<?= $result['id_skripsi084'] ?>">
                                <span class="badge badge-warning">edit</span></a>
                        </td>
                    </tr>
                </tbody>

                <?php } ?>
            </table>
        </div>
    </div>
</div>
</div>