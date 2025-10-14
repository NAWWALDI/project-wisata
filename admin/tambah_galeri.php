<?php
session_start();
include "../koneksi.php";

// Ambil daftar wisata untuk pilihan
$wisata = mysqli_query($conn, "SELECT id_wisata, nama_tempat FROM wisata");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_wisata = $_POST['id_wisata'];
    $keterangan = $_POST['keterangan'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if ($foto) {
        $path = "../assets/img/detail_wisata/" . $foto;
        move_uploaded_file($tmp, $path);

        $tanggal = date("Y-m-d H:i:s");

        $sql = "INSERT INTO galeri (id_wisata, foto, keterangan, tanggal) 
                VALUES ('$id_wisata', '$foto', '$keterangan', '$tanggal')";
        mysqli_query($conn, $sql);

        header("Location: galeri.php?success=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Galeri Wisata</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Tambah Foto Galeri Wisata</h4>
      </div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Pilih Wisata</label>
            <select name="id_wisata" class="form-control" required>
              <option value="">-- Pilih Wisata --</option>
              <?php while ($w = mysqli_fetch_assoc($wisata)) { ?>
                <option value="<?= $w['id_wisata']; ?>"><?= $w['nama_tempat']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
          </div>
          <div class="d-flex justify-content-between">
            <a href="galeri.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
