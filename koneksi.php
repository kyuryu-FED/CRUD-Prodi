<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "db_akademik";

$koneksi = mysqli_connect($host, $user, $password, $db_name);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
