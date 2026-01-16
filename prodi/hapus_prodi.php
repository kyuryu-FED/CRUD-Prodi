<?php
include("../koneksi.php");

// ambil id dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>
            alert('ID tidak valid');
            window.location='data_prodi.php';
          </script>";
    exit;
}

$cek = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total 
    FROM mahasiswa 
    WHERE prodi_id = '$id'
");
$row = mysqli_fetch_assoc($cek);

if ($row['total'] > 0) {
    echo "<script>
            alert('Prodi tidak bisa dihapus karena masih digunakan oleh mahasiswa');
            window.location='data_prodi.php';
          </script>";
    exit;
}

// hapus data prodi
$hapus = mysqli_query($koneksi, "DELETE FROM prodi WHERE id='$id'");

if ($hapus) {
    echo "<script>
            alert('Data prodi berhasil dihapus');
            window.location='data_prodi.php';
          </script>";
} else {
    echo "Gagal hapus: " . mysqli_error($koneksi);
}
?>
