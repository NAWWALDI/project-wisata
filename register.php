<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email sudah terdaftar.";
    } else {
        $sql = "INSERT INTO user (username, email, password) VALUES ('$nama', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Registrasi berhasil, silakan login.";
            header("Location: login.php");
            exit;
        } else {
            $error = "Terjadi kesalahan, coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      height: 100vh;
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      max-width: 850px;
      width: 100%;
    }
      .left-side {
      background: url('assets/img/daerah/Denpasar.jpg') center/cover no-repeat;
      min-height: 400px;
}
    .right-side {
      padding: 40px;
      background: #fff;
    }
    .btn-success {
      transition: 0.3s;
    }
    .btn-success:hover {
      background-color: #198754;
    }
  </style>
</head>
<body>

<div class="card">
  <div class="row g-0">
    <div class="col-md-6 left-side d-none d-md-block"></div>
    <div class="col-md-6 right-side">
      <h3 class="text-center mb-4 fw-bold">Register</h3>

      <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-flex gap-2 mb-3">
          <button type="submit" class="btn btn-success w-50">Daftar</button>
          <a href="login.php" class="btn btn-secondary w-50">Kembali</a>
        </div>

        <p class="text-center mb-0">
          Sudah punya akun? <a href="login.php" class="text-success fw-semibold">Login</a>
        </p>
      </form>
    </div>
  </div>
</div>

</body>
</html>
