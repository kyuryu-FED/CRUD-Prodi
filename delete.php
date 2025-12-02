<?php 
include("koneksi.php");

$id = $_GET['id'];

$sql = mysqli_query($db, "DELETE FROM mahasiswa WHERE id='$id'");

if ($sql){
    echo "<script>alert('Data berhasil dihapus!'); window.location='create.php';</script>";
} else {
    echo "Gagal menghapus data: " . mysqli_error($db);
}
?>
