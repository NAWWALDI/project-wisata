<?php
session_start();

// cek apakah user login
$isLoggedIn = isset($_SESSION['role']) && $_SESSION['role'] === 'user';
$username   = $isLoggedIn ? $_SESSION['username'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sidebar User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 250px;
      height: 100vh;
      background: #111;
      color: #fff;
      padding-top: 20px;
      transition: all 0.3s;
    }
    .sidebar h4 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 18px;
    }
    .sidebar a {
      display: block;
      padding: 12px 20px;
      text-decoration: none;
      color: #fff;
      transition: background 0.2s;
    }
    .sidebar a:hover {
      background: #333;
    }
    .sidebar .bottom {
      position: absolute;
      bottom: 20px;
      width: 100%;
    }
    .content {
      margin-left: 250px;
      padding: 20px;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h4><?= $username ?></h4>

  <?php if (!$isLoggedIn): ?>
    <!-- Menu untuk sebelum login -->
    <a href="index.php">Home</a>
    <a href="daerah.php">Daerah</a>
    <a href="about.php">About</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
  <?php else: ?>
    <!-- Menu setelah login -->
    <a href="dashboard_user.php">Dashboard</a>
    <a href="wisata.php">Daftar Wisata</a>
    <a href="akses.php">Informasi Akses</a>
    <a href="peta.php">Peta Lokasi</a>
    <a href="logout.php">Logout</a>
  <?php endif; ?>

  <div class="bottom">
    <a href="#">🌙 Dark Mode (opsional)</a>
  </div>
</div>

<div class="content">
  <h2>Halaman Konten</h2>
  <p>Konten utama akan tampil di sini, sementara sidebar tetap di kiri.</p>
</div>

</body>
</html>
