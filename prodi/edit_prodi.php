<?php
include("../koneksi.php");

// ambil id dari URL
$id = $_GET['id'];

// ambil data lama
$query = mysqli_query($koneksi, "SELECT * FROM prodi WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan');window.location='data_prodi.php';</script>";
    exit;
}

// proses update
if (isset($_POST['update'])) {
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang    = $_POST['jenjang'];
    $keterangan = $_POST['keterangan'];

    $update = mysqli_query($koneksi, "
        UPDATE prodi SET
            nama_prodi='$nama_prodi',
            jenjang='$jenjang',
            keterangan='$keterangan'
        WHERE id='$id'
    ");

    if ($update) {
        echo "<script>
                alert('Data prodi berhasil diperbarui');
                window.location='data_prodi.php';
              </script>";
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Edit Prodi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

                <a class="nav-link active" href="../prodi/index_data_mahasiswa.php">Home</a>

                <!-- Dropdown Mahasiswa -->
                <div class="nav-item dropdown" data-bs-theme="dark">
                    <button class="btn btn-secondary dropdown-toggle px-4"
                            type="button"
                            data-bs-toggle="dropdown">
                        Mahasiswa
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="../create.php">Daftar Mahasiswa</a></li>
                        <li><a class="dropdown-item" href="../index.php">Tambah Mahasiswa</a></li>
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
                <a class="nav-link active" href="../login/sudah_login.php">Login</a>
                <a class="nav-link active" href="../login/profile.php">Profile</a>
                <a class="nav-link text-danger" href="../login/logout.php">Logout</a>

            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
  <div class="bg-white p-4 rounded shadow-sm">

    <h3 class="mb-4 fw-bold">Edit Prodi</h3>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Nama Prodi</label>
        <input type="text" name="nama_prodi" class="form-control"
               value="<?= $data['nama_prodi']; ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Jenjang</label>
        <select name="jenjang" class="form-select" required>
          <option value="D2" <?= $data['jenjang']=='D2'?'selected':'' ?>>D2</option>
          <option value="D3" <?= $data['jenjang']=='D3'?'selected':'' ?>>D3</option>
          <option value="D4" <?= $data['jenjang']=='D4'?'selected':'' ?>>D4</option>
          <option value="S1" <?= $data['jenjang']=='S1'?'selected':'' ?>>S1</option>
          <option value="S2" <?= $data['jenjang']=='S2'?'selected':'' ?>>S2</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="3"><?= $data['keterangan']; ?></textarea>
      </div>

      <button type="submit" name="update" class="btn btn-primary">Update</button>
      <a href="data_prodi.php" class="btn btn-secondary">Batal</a>

    </form>

  </div>
</div>

</body>
</html>
