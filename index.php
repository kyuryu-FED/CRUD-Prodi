<?php include("koneksi.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Input Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="p-3 mb-2 bg-light text-dark: container mt-5 ">
<form action="" method="post">
    <h2>Form Input Mahasiswa</h2>

    <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" style="width: 200px;" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="create.php" class="btn btn-secondary">Daftar Mahasiswa</a>
</form>

<?php
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $sql = mysqli_query($db, 
        "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat)
         VALUES ('$nim', '$nama', '$tgl_lahir', '$alamat')");

    if ($sql) {
        echo "<script>alert('Data berhasil disimpan!'); window.location='create.php';</script>";
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
    </div>
</div>
</body>
</html>
