<?php
session_start();
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];

    // === Upload Foto Utama ===
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];

    $fotoBaru = time() . "_" . $foto; 
    move_uploaded_file($tmp, "../assets/img/wisata/" . $fotoBaru);

    // Simpan ke tabel wisata
    $sql = "INSERT INTO wisata (nama_tempat, jenis_wisata, lokasi, deskripsi, foto) 
            VALUES ('$nama', '$jenis', '$lokasi', '$deskripsi', '$fotoBaru')";
    mysqli_query($conn, $sql);

    // Ambil ID wisata terakhir
    $id_wisata = mysqli_insert_id($conn);

    // === Upload Foto Galeri Tambahan ===
    if (!empty($_FILES['galeri']['name'][0])) {
        foreach ($_FILES['galeri']['name'] as $key => $namaGaleri) {
            $tmpGaleri = $_FILES['galeri']['tmp_name'][$key];
            $namaFile  = time() . "_" . $namaGaleri;

            move_uploaded_file($tmpGaleri, "../assets/img/detail_wisata/" . $namaFile);

            $sqlGaleri = "INSERT INTO galeri (id_wisata, foto, keterangan, tanggal) 
                          VALUES ('$id_wisata', '$namaFile', '', NOW())";
            mysqli_query($conn, $sqlGaleri);
        }
    }

    header("Location: wisata.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Wisata</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-header bg-success text-white">
        <h4 class="mb-0">Tambah Wisata</h4>
      </div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Nama Tempat</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama tempat" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Jenis Wisata</label>
            <input type="text" name="jenis" class="form-control" placeholder="Contoh: Pantai, Kuliner, Budaya" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" placeholder="Masukkan lokasi wisata" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tulis deskripsi singkat wisata" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Foto Utama</label>
            <input type="file" name="foto" class="form-control" accept="image/*" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Foto Galeri (opsional, bisa pilih banyak)</label>
            <input type="file" name="galeri[]" class="form-control" accept="image/*" multiple>
          </div>
          <div class="d-flex justify-content-between">
            <a href="wisata.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
