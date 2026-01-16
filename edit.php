<?php
include("koneksi.php");

$id = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$data = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Edit Data Mahasiswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4" data-bs-theme="dark">
    <div class="container-fluid">

        <a class="navbar-brand px-5" href="selamat_datang.php">Akademik</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto px-5 d-flex gap-3 align-items-center">

                <a class="nav-link active" href="prodi/index_data_mahasiswa.php">Home</a>

                <!-- Dropdown Mahasiswa -->
                <div class="nav-item dropdown" data-bs-theme="dark">
                    <button class="btn btn-secondary dropdown-toggle px-4"
                            type="button"
                            data-bs-toggle="dropdown">
                        Mahasiswa
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="create.php">Daftar Mahasiswa</a></li>
                        <li><a class="dropdown-item" href="index.php">Tambah Mahasiswa</a></li>
                    </ul>
                </div>

                <!-- Dropdown Prodi -->
                <div class="nav-item dropdown" data-bs-theme="dark">
                    <button class="btn btn-secondary dropdown-toggle px-4"
                            type="button"
                            data-bs-toggle="dropdown">
                        Prodi
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="prodi/data_prodi.php">Daftar Prodi</a></li>
                        <li><a class="dropdown-item" href="prodi/create_prodi.php">Tambah Prodi</a></li>
                    </ul>
                </div>

                <!-- Login / Profile -->
                <a class="nav-link active" href="login/sudah_login.php">Login</a>
                <a class="nav-link active" href="login/profile.php">Profile</a>
                <a class="nav-link text-danger" href="login/logout.php">Logout</a>

            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
<div class="bg-white p-4 rounded shadow-sm">

<h3 class="mb-4 fw-bold">Edit Mahasiswa</h3>

<form method="POST">

<input type="hidden" name="id" value="<?= $data['id'] ?>">

<div class="mb-3">
    <label class="form-label">NIM</label>
    <input type="text" name="nim" class="form-control" value="<?= $data['nim'] ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="<?= $data['nama_mhs'] ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Tanggal Lahir</label>
    <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir'] ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="alamat" class="form-control" rows="4" required><?= $data['alamat'] ?></textarea>
</div>

<button type="submit" name="update" class="btn btn-primary">Simpan</button>
<a href="create.php" class="btn btn-secondary">Kembali</a>

</form>

<?php
if (isset($_POST['update'])) {

    $id     = $_POST['id'];
    $nim    = $_POST['nim'];
    $nama   = $_POST['nama'];
    $tgl    = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($koneksi, "UPDATE mahasiswa SET
        nim='$nim',
        nama_mhs='$nama',
        tgl_lahir='$tgl',
        alamat='$alamat'
        WHERE id='$id'
    ");

    if ($update) {
        echo "<script>
            alert('Data berhasil diupdate!');
            window.location='create.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

</div>
</div>

</body>
</html>
