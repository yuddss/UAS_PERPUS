<?php
$host       = "localhost";
$user       = "root";
$pass       = "yudapratama010104";
$db         = "app-perpus";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { // cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
?>
