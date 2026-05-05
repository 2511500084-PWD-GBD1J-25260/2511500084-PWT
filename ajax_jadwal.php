<?php
include "config/koneksi.php";

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
");

if(mysqli_num_rows($queryJadwal) > 0){
    while($row = mysqli_fetch_assoc($queryJadwal)){
        echo "<tr>
                <td><span class='badge bg-primary'>{$row['nm_kelas']}</span></td>
                <td>{$row['nm_mapel']}</td>
                <td>{$row['nm_guru']}</td>
                <td><b>{$row['jam_mulai']} - {$row['jam_selesai']}</b></td>
              </tr>";
    }
} else {
    echo "<tr>
            <td colspan='4' class='text-center text-muted py-4'>
            ⏰ Tidak ada jadwal sekarang
            </td>
          </tr>";
}