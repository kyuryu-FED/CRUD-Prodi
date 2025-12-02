<?php include("koneksi.php"); 

$id = $_GET['id'];
$sql = mysqli_query($db, "SELECT * FROM mahasiswa WHERE id='$id'");
$data = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="p-3 mb-2 bg-light text-dark: container mt-5 ">
<form action="" method="post">
    <h2>Form Input Mahasiswa</h2>
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" value="<?= $data['nim'] ?>" >
    </div>

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control"  value="<?= $data['nama_mhs'] ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" style="width: 200px;" class="form-control" value="<?= $data['tgl_lahir'] ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="4" ><?= $data['alamat'] ?></textarea>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Simpan</button>
    <a href="create.php" class="btn btn-secondary">Kembali</a>
</form>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tgl = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($db, "UPDATE mahasiswa SET 
                nim='$nim',
                nama_mhs='$nama',
                tgl_lahir='$tgl',
                alamat='$alamat'
                WHERE id='$id'");

    if ($update) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='create.php';</script>";
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>

</body>
</html>
