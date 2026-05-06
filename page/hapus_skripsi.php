<?php
$conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");

mysqli_query($conn, "DELETE FROM skripsi_084 WHERE id_skripsi084='$_GET[id]'");

header("location:skripsi_2511500084.php");
?>