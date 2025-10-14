<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // cek di tabel admin
    $sql_admin = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
    $res_admin = mysqli_query($conn, $sql_admin);

    if (mysqli_num_rows($res_admin) > 0) {
        $row = mysqli_fetch_assoc($res_admin);
        if (password_verify($password, $row['password'])) {
            $_SESSION['role'] = 'admin';
            $_SESSION['admin_id'] = $row['id'];
            header("Location: admin/dashboard.php");
            exit;
        }
    }

    // cek di tabel user
    $sql_user = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $res_user = mysqli_query($conn, $sql_user);

    if (mysqli_num_rows($res_user) > 0) {
        $row = mysqli_fetch_assoc($res_user);
        if ($password === $row['password']) {
            $_SESSION['role'] = 'user';
            $_SESSION['user_id'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit;
        }
    }

    $error = "Email atau password salah.";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
      background: url('assets/img/daerah/Labuan Bajo.jpg') center/cover no-repeat;
      min-height: 400px;
}

    .right-side {
      padding: 40px;
      background: #fff;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      transition: 0.3s;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    a {
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="card">
  <div class="row g-0">
    <div class="col-md-6 left-side d-none d-md-block"></div>
    <div class="col-md-6 right-side">
      <h3 class="text-center mb-4 fw-bold">Login</h3>

      <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-flex gap-2 mb-3">
          <button type="submit" class="btn btn-primary w-50">Login</button>
          <a href="index.php" class="btn btn-secondary w-50">Batal</a>
        </div>

        <p class="text-center mb-0">
          Belum punya akun? <a href="register.php" class="text-primary fw-semibold">Daftar</a>
        </p>
      </form>
    </div>
  </div>
</div>

</body>
</html>
