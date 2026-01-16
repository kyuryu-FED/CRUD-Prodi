<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form Input Mahasiswa</title>
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
    <h3 class="mb-3 fw-bold">Form Input Mahasiswa</h3>

    <!-- FORM WAJIB -->
    <form method="POST">

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
        <input type="date" name="tgl_lahir" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="3" required></textarea>
      </div>

      <!-- DROPDOWN PRODI -->
      <div class="mb-3">
        <label class="form-label">Prodi</label>
        <select name="prodi_id" class="form-select" required>
          <option value="">-- Pilih Prodi --</option>
          <?php
          $prodi = mysqli_query($koneksi, "SELECT * FROM prodi");
          while ($p = mysqli_fetch_assoc($prodi)) {
              echo "<option value='{$p['id']}'>{$p['nama_prodi']}</option>";
          }
          ?>
        </select>
      </div>

      <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      <a href="create.php" class="btn btn-secondary">Daftar Mahasiswa</a>

    </form>

    <?php
    // PROSES SIMPAN
    if (isset($_POST['simpan'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $prodi_id = $_POST['prodi_id'];

        $sql = mysqli_query($koneksi, "
            INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat, prodi_id)
            VALUES ('$nim', '$nama', '$tgl_lahir', '$alamat', '$prodi_id')
        ");

        if ($sql) {
            echo "<script>
                alert('Data mahasiswa berhasil disimpan');
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
