<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "db_akademik";

$db = mysqli_connect($host, $user, $password, $db_name);

if (!$db) {
    echo "Koneksi error: " . mysqli_connect_error();
    exit;
}
?>
