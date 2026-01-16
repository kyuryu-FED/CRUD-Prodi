<?php
session_start();
include("../koneksi.php");

// Jika sudah pengguna → langsung ke profile
if (isset($_SESSION['pengguna']) && $_SESSION['pengguna'] === true) {
    header("Location: profile.php");
    exit;
}

if (isset($_POST['Login'])) {
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE email='$email'");
    $user  = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {

        // SESSION WAJIB
        $_SESSION['pengguna']   = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email']   = $user['email'];
        $_SESSION['nama']    = $user['nama_lengkap'];

        // LANGSUNG KE PROFILE
        header("Location: ../selamat_datang.php");
        exit;

    } else {
        $error = "Email atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height:100vh;">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">

<div class="card shadow-lg border-0 rounded-4">
  <div class="card-header bg-secondary text-white text-center rounded-top-4">
<h5 class="mb-0 fw-bold">Login</h5>
</div>

<div class="card-body">
<?php if (isset($error)) : ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button type="submit" name="Login" class="btn btn-secondary w-100">
    Login
</button>

</form>
</div>

<div class="card-footer text-center">
Belum punya akun? <a href="register.php" class="fw-semibold text-decoration-none">Register</a>
</div>
</div>

</div>
</div>
</div>
</body>
</html>
