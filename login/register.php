<?php
include("../koneksi.php");

if (isset($_POST['register'])) {
    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($koneksi, "SELECT id FROM pengguna WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        mysqli_query($koneksi, "
            INSERT INTO pengguna (nama_lengkap, email, password)
            VALUES ('$nama', '$email', '$pass')
        ");
        header("Location: ../selamat_datang.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
      <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

<body class="bg-light d-flex align-items-center" style="min-height:100vh;">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">

<div class="card shadow-lg border-0 rounded-4">
  <div class="card-header bg-success text-white text-center rounded-top-4">
    <h5 class="mb-0 fw-bold">Register</h5>
</div>

<div class="card-body p-4">

<?php if (isset($error)) : ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <input type="text"
           name="nama_lengkap"
           class="form-control mb-3"
           placeholder="Nama Lengkap"
           required>

    <input type="email"
           name="email"
           class="form-control mb-3"
           placeholder="Email"
           required>

    <input type="password"
           name="password"
           class="form-control mb-4"
           placeholder="Password"
           required>

    <button name="register" class="btn btn-success w-100 fw-semibold">
        Register
    </button>
</form>

</div>

<div class="card-footer text-center">
    Sudah punya akun?
    <a href="login.php" class="fw-semibold text-decoration-none">
        Login
    </a>
</div>

</div>

</div>
</div>
</div>

</body>
</html>
