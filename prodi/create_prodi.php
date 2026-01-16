<?php
include("../koneksi.php"); // sesuaikan path
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Prodi</title>
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
    <h3 class="mb-3 fw-bold">Tambah Prodi</h3>

    <!-- FORM -->
    <form method="POST">

      <div class="mb-3">
        <label class="form-label">Nama Prodi</label>
        <input type="text" name="nama_prodi" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Jenjang</label>
        <select name="jenjang" class="form-select" required>
          <option value="">-- Pilih Jenjang --</option>
          <option value="D2">D2</option>
          <option value="D3">D3</option>
          <option value="D4">D4</option>
          <option value="S1">S1</option>
          <option value="S2">S2</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="3"></textarea>
      </div>

      <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-secondary">Reset</button>

    </form>
  </div>
</div>

<?php
// PROSES SIMPAN
if (isset($_POST['simpan'])) {
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $keterangan = $_POST['keterangan'];

    $sql = mysqli_query($koneksi, "
        INSERT INTO prodi (nama_prodi, jenjang, keterangan)
        VALUES ('$nama_prodi', '$jenjang', '$keterangan')
    ");

    if ($sql) {
        echo "<script>
                alert('Data prodi berhasil disimpan');
                window.location='data_prodi.php';
              </script>";
    } else {
        echo "Gagal simpan: " . mysqli_error($koneksi);
    }
}
?>

</body>
</html>
