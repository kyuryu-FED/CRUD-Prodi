<?php
session_start();
require_once "../koneksi.php";

// Proteksi halaman
if (!isset($_SESSION['pengguna']) || $_SESSION['pengguna'] !== true) {
    header("Location: pengguna.php");
    exit;
}

$email_session = $_SESSION['email'];

// Ambil data user
$query = mysqli_query(
    $koneksi,
    "SELECT id, email, nama_lengkap FROM pengguna WHERE email='$email_session'"
);
$user = mysqli_fetch_assoc($query);

if (!$user) {
    echo "Data user tidak ditemukan";
    exit;
}

// Proses update profil
if (isset($_POST['update'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if (!empty($password)) {

        if ($password !== $confirm) {
            $error = "Konfirmasi password tidak cocok!";
        } else {

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query(
                $koneksi,
                "UPDATE pengguna 
                 SET nama_lengkap='$username', password='$password_hash'
                 WHERE id='{$user['id']}'"
            );

            $success = "Username & password berhasil diperbarui";
        }

    } 

    else {

        mysqli_query(
            $koneksi,
            "UPDATE pengguna 
             SET nama_lengkap='$username'
             WHERE id='{$user['id']}'"
        );

        $success = "Username berhasil diperbarui";
    }

    // Update session
    $_SESSION['nama'] = $username;
    $user['nama_lengkap'] = $username;
}

?>
<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4" data-bs-theme="dark">
    <div class="container-fluid">

        <a class="navbar-brand px-5" href="../selamat_datang.php">Akademik</a>

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
                        <li><a class="dropdown-item" href="../prodi/data_prodi.php">Daftar Prodi</a></li>
                        <li><a class="dropdown-item" href="../prodi/create_prodi.php">Tambah Prodi</a></li>
                    </ul>
                </div>

                <!-- pengguna / Profile -->
                <a class="nav-link active" href="sudah_login.php">Login</a>
                <a class="nav-link active" href="profile.php">Profile</a>
                <a class="nav-link text-danger" href="logout.php">Logout</a>

            </div>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="card shadow rounded-4 mx-auto" style="max-width: 500px;">
        <div class="card-body p-4 ">

        <h4 class="fw-bold mb-4 ">Profil Pengguna</h4>

<!-- DATA USER -->
    <table class="table table-borderless mb-4">
        <tr>
            <th width="200">Username</th>
            <td>: <?= htmlspecialchars($user['nama_lengkap']) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td>: <?= htmlspecialchars($user['email']) ?></td>
        </tr>
    </table>

<!-- TOMBOL -->
<div class="d-flex gap-2 mb-4">
    <button class="btn btn-warning"
            data-bs-toggle="collapse"
            data-bs-target="#editProfil">
         Edit Profil
    </button>

    <a href="logout.php" class="btn btn-danger">
         Logout
    </a>
</div>

<!-- FORM EDIT -->
<div class="collapse" id="editProfil">
    <hr>

        <h5 class="fw-bold mb-3">Edit Profil</h5>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (!empty($success)) : ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text"
               name="username"
               class="form-control"
               value="<?= htmlspecialchars($user['nama_lengkap']) ?>"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <input type="password"
               name="password"
               class="form-control"
               placeholder="Password baru"
               >
    </div>

    <div class="mb-3">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password"
               name="confirm"
               class="form-control"
               placeholder="Ulangi password"
               >
    </div>

    <div class="d-flex gap-2">
        <button type="submit" name="update" class="btn btn-primary">
            Simpan Perubahan
        </button>

        <button type="button"
                class="btn btn-secondary"
                data-bs-toggle="collapse"
                data-bs-target="#editProfil">
            Batal
        </button>
    </div>
</form>
</div>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
