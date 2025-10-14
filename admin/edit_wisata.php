<?php
session_start();
include "../koneksi.php";

$id = $_GET['id'] ?? 0;

// Ambil data wisata
$query = mysqli_query($conn, "SELECT * FROM wisata WHERE id_wisata=$id");
$wisata = mysqli_fetch_assoc($query);

// Ambil galeri wisata
$galeri = mysqli_query($conn, "SELECT * FROM galeri WHERE id_wisata=$id");

// === Update Data Wisata ===
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];

    // Update foto utama kalau ada upload baru
    if (!empty($_FILES['foto']['name'])) {
        $foto = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/wisata/" . $foto);

        mysqli_query($conn, "UPDATE wisata SET nama_tempat='$nama', jenis_wisata='$jenis', 
                             lokasi='$lokasi', deskripsi='$deskripsi', foto='$foto' 
                             WHERE id_wisata=$id");
    } else {
        mysqli_query($conn, "UPDATE wisata SET nama_tempat='$nama', jenis_wisata='$jenis', 
                             lokasi='$lokasi', deskripsi='$deskripsi' 
                             WHERE id_wisata=$id");
    }

    // Upload foto galeri tambahan
    if (!empty($_FILES['galeri']['name'][0])) {
        foreach ($_FILES['galeri']['name'] as $key => $namaGaleri) {
            if (!empty($namaGaleri)) {
                $fileName = time() . "_" . $namaGaleri;
                move_uploaded_file($_FILES['galeri']['tmp_name'][$key], "../assets/img/detail_wisata/" . $fileName);

                mysqli_query($conn, "INSERT INTO galeri (id_wisata, foto, keterangan, tanggal) 
                                     VALUES ($id, '$fileName', '', NOW())");
            }
        }
    }

    header("Location: edit_wisata.php?id=$id&success=1");
    exit;
}

// === Hapus Foto Galeri ===
if (isset($_GET['hapus_galeri'])) {
    $id_galeri = $_GET['hapus_galeri'];
    mysqli_query($conn, "DELETE FROM galeri WHERE id_galeri=$id_galeri");
    header("Location: edit_wisata.php?id=$id&deleted=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Wisata</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit Wisata</h4>
      </div>
      <div class="card-body">

        <?php if (isset($_GET['success'])): ?>
          <div class="alert alert-success">Data berhasil diperbarui!</div>
        <?php elseif (isset($_GET['deleted'])): ?>
          <div class="alert alert-warning">Foto galeri berhasil dihapus!</div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Nama Tempat</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $wisata['nama_tempat']; ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Jenis Wisata</label>
            <input type="text" name="jenis" class="form-control" value="<?php echo $wisata['jenis_wisata']; ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="<?php echo $wisata['lokasi']; ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required><?php echo $wisata['deskripsi']; ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Foto Utama (Kosongkan jika tidak diganti)</label><br>
            <img src="../assets/img/wisata/<?php echo $wisata['foto']; ?>" width="200" class="mb-2 rounded">
            <input type="file" name="foto" class="form-control" accept="image/*">
          </div>
          <div class="mb-3">
            <label class="form-label">Tambah Foto Galeri</label>
            <input type="file" name="galeri[]" class="form-control" accept="image/*" multiple>
          </div>
          <div class="d-flex justify-content-between">
            <a href="wisata.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>

    <div class="card shadow-lg mt-4">
      <div class="card-header bg-info text-white">
        <h5 class="mb-0">Galeri Foto</h5>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <?php while ($g = mysqli_fetch_assoc($galeri)): ?>
            <div class="col-md-3 text-center">
              <img src="../assets/img/detail_wisata/<?php echo $g['foto']; ?>" class="img-fluid rounded shadow-sm mb-2" style="height:150px;object-fit:cover;">
              <br>
              <a href="edit_wisata.php?id=<?php echo $id; ?>&hapus_galeri=<?php echo $g['id_galeri']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus foto ini?')">Hapus</a>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>

  </div>
</body>
</html>
