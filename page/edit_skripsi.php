<?php
require_once "config/koneksi.php";

/** @var mysqli $conn */
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Skripsi</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM skripsi_2511500084 WHERE id_skripsi084='$kd' "));

if(isset($_POST['tambah'])){
    $id_skripsi = $_POST['id_skripsi'];
    $judul_skripsi = $_POST['judul_skripsi'];
    $topik = $_POST['topik_skripsi084'];
    $semester = $_POST['semester084'];
    $thn_ajaran = $_POST['thn_ajaran084'];

    $insert = mysqli_query($conn, "UPDATE skripsi_2511500084 SET 
        judul_skripsi084='$judul_skripsi',
        topik_skripsi084='$topik',
        semester084='$semester',
        thn_ajaran084='$thn_ajaran'
        WHERE id_skripsi084='$id_skripsi' ");
    
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi_2511500084">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Gagal Disimpan</h4></div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>ID Skripsi</label>
                            <input type="text" name="id_skripsi" value="<?= $edit['id_skripsi084']; ?>" 
                                class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Judul Skripsi</label>
                            <input type="text" name="judul_skripsi" value="<?= $edit['judul_skripsi084']; ?>" 
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Topik</label>
                            <input type="text" name="topik_skripsi084" value="<?= $edit['topik_skripsi084']; ?>" 
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Semester</label>
                            <input type="text" name="semester084" value="<?= $edit['semester084']; ?>" 
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="text" name="thn_ajaran084" value="<?= $edit['thn_ajaran084']; ?>" 
                                class="form-control">
                        </div>
                        
                        <div class="card-foote                                                                      r">
                            <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>