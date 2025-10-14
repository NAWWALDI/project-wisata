<?php
session_start();
include '../koneksi.php';

// cek login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$id = $_SESSION['user_id'];

// ambil data user
$result = mysqli_query($conn, "SELECT * FROM user WHERE id_user=$id");
$user = mysqli_fetch_assoc($result);

// update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = !empty($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : $user['password'];

    $sql = "UPDATE user SET username='$username', email='$email', password='$password' WHERE id_user=$id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['username'] = $username; // update session
        header("Location: user_dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h3>Edit Akun</h3>
  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label>Username</label>
      <input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password (kosongkan jika tidak ingin diubah)</label>
      <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="user_dashboard.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

</body>
</html>
