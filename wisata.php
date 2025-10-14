<?php
include "koneksi.php";
$daerah = $_GET['daerah'] ?? '';
$query = mysqli_query($conn, "SELECT * FROM wisata WHERE lokasi LIKE '%$daerah%'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Wisata - <?php echo $daerah; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f7f9fc;
    }
    .card {
      border-radius: 15px;
      transition: 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .card-title {
      font-weight: bold;
      color: #007bff;
    }
    .badge-custom {
      background: #16badb;
      color: white;
      font-size: 0.8rem;
      border-radius: 12px;
      padding: 5px 10px;
    }
  </style>
</head>
<body class="container my-4">

  <nav class="navbar navbar-light bg-white shadow-sm rounded mb-4">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h5">Wisata Daerah</span>
      <a href="javascript:history.back()" class="btn btn-outline-primary btn-sm">← Kembali</a>

    </div>
  </nav>
  <h2 class="text-center mb-4">Daftar Wisata di <span class="text-primary"><?php echo $daerah; ?></span></h2>
  <div class="row">
    <?php if (mysqli_num_rows($query) > 0): ?>
      <?php while($row = mysqli_fetch_assoc($query)): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="assets/img/wisata/<?php echo $row['foto']; ?>" 
                 class="card-img-top" style="height:200px; object-fit:cover; border-radius: 15px 15px 0 0;">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nama_tempat']; ?></h5>
              <p><span class="badge badge-custom"><?php echo $row['jenis_wisata']; ?></span></p>
              <p class="card-text text-muted small">
                <i class="bi bi-geo-alt-fill"></i> <?php echo $row['lokasi']; ?>
              </p>
              <a href="detail_wisata.php?id=<?php echo $row['id_wisata']; ?>" 
                 class="btn btn-primary w-100">Lihat Detail</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-muted">Tidak ada data wisata di daerah ini.</p>
    <?php endif; ?>
  </div>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
