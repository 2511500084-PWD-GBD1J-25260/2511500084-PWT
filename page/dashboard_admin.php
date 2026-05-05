<?php
include "config/koneksi.php";
require_once __DIR__ . "/../config/auth.php";
cek_login();

if(!isset($_SESSION['role'])){
    echo "Session tidak valid!";
    exit;
}

// ================= TAMBAHAN FILTER =================
if($_SESSION['role'] == 'admin'){
    $filterKelas = "";
} else {
    $id_kelas = isset($_SESSION['id_kelas']) ? $_SESSION['id_kelas'] : '';
    $filterKelas = "AND jk.id_kelas='$id_kelas'";
}

$jml_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa"))['total'];
$jml_kelas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kelas"))['total'];

$hari = date("l");
$hariIndo = [
    "Monday"=>"Senin","Tuesday"=>"Selasa","Wednesday"=>"Rabu",
    "Thursday"=>"Kamis","Friday"=>"Jumat","Saturday"=>"Sabtu","Sunday"=>"Minggu"
];
$hariSekarang = $hariIndo[$hari];

$jam = date("H:i:s");

$queryJadwal = mysqli_query($conn, "
SELECT 
    dk.*,
    k.nm_kelas,
    m.nm_mapel,
    g.nm_guru
FROM detail_jadwal dk
JOIN jadwal_kelas jk ON dk.id_jadwal = jk.id_jadwal
JOIN kelas k ON jk.id_kelas = k.id_kelas
JOIN mapel m ON dk.kd_mapel = m.kd_mapel
JOIN guru g ON dk.kd_guru = g.kd_guru
WHERE dk.hari='$hariSekarang'
AND '$jam' BETWEEN dk.jam_mulai AND dk.jam_selesai
$filterKelas
");
?>

<!-- ===== STYLE TAMBAHAN ===== -->
<style>
.main-sidebar {
    background: linear-gradient(180deg, #1f2937, #111827);
}

.nav-sidebar .nav-link.active {
    background: #3b82f6 !important;
    border-radius: 8px;
}

.nav-sidebar .nav-link {
    margin: 5px 10px;
    border-radius: 8px;
}

.card-modern {
    border-radius: 15px;
}

.shadow-soft {
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}
</style>

<!-- ===== CONTENT ===== -->
<div class="row mb-4">

    <!-- CARD SISWA -->
    <div class="col-md-4">
        <div class="card shadow-soft border-0 card-modern">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Jumlah Siswa</h6>
                    <h2><?= $jml_siswa; ?></h2>
                </div>
                <div class="bg-primary text-white p-3 rounded-circle">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- CARD KELAS -->
    <div class="col-md-4">
        <div class="card shadow-soft border-0 card-modern">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Jumlah Kelas</h6>
                    <h2><?= $jml_kelas; ?></h2>
                </div>
                <div class="bg-success text-white p-3 rounded-circle">
                    <i class="fas fa-school"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <!-- JADWAL -->
    <div class="col-lg-6">
        <div class="card shadow-soft border-0 card-modern">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">📅 Jadwal Saat Ini</h5>
                <small class="text-muted"><?= $hariSekarang ?> • <?= $jam ?></small>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Kelas</th>
                                <th>Mapel</th>
                                <th>Guru</th>
                                <th>Jam</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php if(mysqli_num_rows($queryJadwal) > 0){ ?>
                        <?php while($row = mysqli_fetch_assoc($queryJadwal)){ ?>
                            <tr>
                                <td><span class="badge bg-primary"><?= $row['nm_kelas']; ?></span></td>
                                <td><?= $row['nm_mapel']; ?></td>
                                <td><?= $row['nm_guru']; ?></td>
                                <td><b><?= $row['jam_mulai']; ?> - <?= $row['jam_selesai']; ?></b></td>
                            </tr>
                        <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    ⏰ Tidak ada jadwal sekarang
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- PROFILE -->
<div class="row mt-4">
    <div class="col-lg-6">
        <div class="card shadow-soft border-0 card-modern">
            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                         style="width:60px;height:60px;font-size:20px;">
                        <?= strtoupper(substr(isset($_SESSION['username']) ? $_SESSION['username'] : 'U',0,1)); ?>
                    </div>

                    <div class="ml-3">
                        <h5 class="mb-0"><?= isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?></h5>
                        <small class="text-muted">
                        <?= ($_SESSION['role'] == 'admin') ? 'Administrator' : 'Siswa'; ?>
                        </small>
                    </div>

                </div>

                <hr>

                <p><b>Login Time:</b><br><?= date("d-m-Y H:i:s"); ?></p>

            </div>
        </div>
    </div>
</div>