<?php
// PASTIKAN SESSION AKTIF
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// CEK LOGIN
function cek_login() {
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit;
    }
}

// CEK ROLE ADMIN
function is_admin(){
    return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
}

// KHUSUS HALAMAN ADMIN
function hanya_admin() {
    if(!is_admin()){
        echo "Akses ditolak!";
        exit;
    }
}

// KHUSUS HALAMAN SISWA
function hanya_siswa() {
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'siswa'){
        echo "Akses ditolak!";
        exit;
    }
}