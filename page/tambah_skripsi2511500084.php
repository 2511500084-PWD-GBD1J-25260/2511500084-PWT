<?php
require_once "config/koneksi.php";

/** @var mysqli $koneksi */
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
//kode otomatis
$carikode = mysqli_query($conn, "select max(Id_skripsi084 ) from skripsi_2511500084") or die (
    mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if($datakode[0] != NULL) {
    $nilaikode = substr($datakode[0], 3);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "M-".str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "M-001";
}
$_SESSION["KODE"] = $hasilkode;

if(isset($_POST['tambah'])){
    $Id_skripsi084 = $_POST['id_skripsi084'];
    $Judul_skripsi084 = $_POST['judul_skripsi084'];
    $Topik_084 = $_POST['topik_084'];
    $Semester084 = $_POST['semester084'];
    $Thn_ajaran084 = $_POST['thn_ajaran084'];

    $insert = mysqli_query($conn, "INSERT INTO skripsi_2511500084 VALUES ('$Id_skripsi084','$Judul_skripsi084','$Topik_084','$Semester084','$Thn_ajaran084')");
    
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
                            <label for="id_skripsi084">Id Skripsi</label>
                            <input type="text" name="id_skripsi084" id="id_skripsi084"
                                placeholder="Id skripsi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="judul_skripsi084">Judul Skripsi</label>
                            <input type="text" name="judul_skripsi084" id="judul_skripsi084"
                                placeholder="Judul skripsi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="topik_084">Topik</label>
                            <input type="text" name="topik_084" id="topik_084"
                                placeholder="Topik" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="semester084">Semester</label>
                            <select type="text" name="semester084" id="semester084"
                                placeholder="Semester" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="L">semester 2</option>
                                <option value="P">semester 4</option>
</select>
                        </div>
                        <div class="form-group">
                            <label for="thn_ajaran084">Tahun Ajaran</label>
                            <select type="text" name="thn_ajaran084" id="thn_ajaran084"
                                placeholder="Thn ajaran" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                            </select>
                        </div>
                        
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>