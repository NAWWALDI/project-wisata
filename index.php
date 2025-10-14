<?php
session_start();
$isLoggedIn = isset($_SESSION['role']) && $_SESSION['role'] === 'user';
$username = $isLoggedIn && isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';


?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jelajah Daerahku</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body>

<button class="toggle-btn me-3" onclick="toggleSidebar()">☰</button>
<!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <h4 class="text-center py-3"><?= $username ?></h4>
      <?php if (!$isLoggedIn): ?>
        <a href="index.php">Home</a>
        <a href="#daerah">Daerah</a>
        <a href="#about">About</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
      <?php else: ?>
        <a href="user/user_dashboard.php">Dashboard</a>
        <a href="wisata.php">Daftar Wisata</a>
        <a href="akses.php">Informasi Akses</a>
        <a href="peta.php"> Peta Lokasi</a>
        <a href="logout.php">Logout</a>
      <?php endif; ?>
      
     
    </div>

<div class="content" id="content">

    <header class="top-bar d-flex justify-content-between align-items-center px-4 py-3 bg-light shadow-sm">
      <div class="d-flex align-items-center">
        <button class="toggle-btn me-3" onclick="toggleSidebar()">☰</button>
        
      </div>
      <nav>
        <a href="index.php" class="mx-2">Home</a>
        <a href="#daerah" class="mx-2">Daerah</a>
        <a href="#about" class="mx-2">About</a>
      </nav>
        <div>
      <?php if ($isLoggedIn): ?>
        <span class="fw-bold">Halo, <?= htmlspecialchars($username) ?></span>
        <a href="logout.php" class="ms-3 text-danger">Logout</a>
      <?php else: ?>
        <a href="login.php" class="fw-bold">Login</a>
      <?php endif; ?>
    </div>

    </header>

  </header>

  

<section class="hero text-center text-white d-flex flex-column justify-content-center align-items-center">
  <div class="overlay"></div>
  <div class="hero-content">
    <h1 class="fw-bold">Jelajah Daerah</h1>
    <p>Eksplorasi wisata dan akses ke daerah terpencil dengan mudah.</p>
  </div>
</section>

<section id="daerah" class="container my-5">
  <h3 class="text-center mb-4">Pilih Provinsi</h3>

  <!-- Search bar utama -->
  <div class="row justify-content-center mb-4" id="searchSection">
    <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
      <div class="search-box position-relative d-flex align-items-center">
        <span class="search-icon">
          <i class="bi bi-search"></i>
        </span>
        <input 
          type="text" 
          id="searchProvinsi" 
          class="form-control search-input shadow-none" 
          placeholder="Tempat untuk dikunjungi, hal yang dapat dilakukan, hotel..."
        >
        <button id="btnCari" class="btn btn-primary cari-btn">Cari</button>
        <ul id="suggestions" class="list-group position-absolute w-100 shadow-sm rounded mt-1 suggestion-list"></ul>
      </div>
    </div>
  </div>

  <div id="daerahCards" class="row mt-4"></div>
</section>


<section class="container mt-5">
  <h3 class="text-center mb-4 ">Wisata Populer</h3>

  <div class="slideshow-container d-flex justify-content-center align-items-center gap-4 flex-wrap">
    <!-- Slideshow kiri -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500" data-bs-touch="true">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/img/daerah/Labuan%20Bajo.jpg" class="d-block w-100" alt="Labuan Bajo">
        </div>
        <div class="carousel-item">
          <img src="assets/img/daerah/Denpasar.jpg" class="d-block w-100" alt="Bali">
        </div>
        <div class="carousel-item">
          <img src="assets/img/daerah/Sumba%20Barat.jpg" class="d-block w-100" alt="Sumba Barat">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Sebelumnya</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Berikutnya</span>
      </button>
    </div>

    <!-- Deskripsi kanan -->
    <div class="desc-box" id="descBox">
      <h4 id="judulDestinasi">Labuan Bajo</h4>
      <p id="deskripsiDestinasi">
        Gerbang menuju Taman Nasional Komodo dan keindahan laut Flores yang menakjubkan.
      </p>
      <a id="linkDestinasi" href="#" class="btn btn-primary btn-sm">Lihat Wisata</a>
    </div>
  </div>
</section>

<!-- Fun Facts -->
<section id="funfacts" class="bg-light py-5">
  <div class="container">
    <h3 class="text-center mb-4">Fun Facts</h3>
    <div class="row text-center">

      <div class="col-md-4 mb-3">
        <div class="fact-card p-4 shadow-sm rounded">
          <h1>17,000+</h1>
          <p>Pulau di Indonesia, menjadikannya negara kepulauan terbesar di dunia.</p>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="fact-card p-4 shadow-sm rounded">
          <h1>300+</h1>
          <p>Suku bangsa dengan budaya unik tersebar di seluruh Indonesia.</p>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="fact-card p-4 shadow-sm rounded">
          <h1>700+</h1>
          <p>Bahasa daerah dituturkan masyarakat Indonesia.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<footer id="about" class="text-center bg-light py-3 mt-5">
  <p>© 2025 Jelajah Daerahku | Web Eksplorasi Wisata & Akses Daerah</p>
</footer>

<script>
const dataDaerah = {
  "Nusa Tenggara Timur": [
    { nama: "Kupang", deskripsi: "Ibukota NTT, dikenal dengan Pantai Lasiana dan budaya Timor." },
    { nama: "Ende", deskripsi: "Terkenal dengan Danau Kelimutu tiga warna yang ikonik." },
    { nama: "Labuan Bajo", deskripsi: "Gerbang menuju Taman Nasional Komodo dan destinasi diving." },
    { nama: "Alor", deskripsi: "Pulau dengan kekayaan bawah laut kelas dunia." },
    { nama: "Belu", deskripsi: "Daerah perbatasan dengan Timor Leste, kaya akan budaya." },
    { nama: "Flores Timur", deskripsi: "Pusat tradisi Lamaholot dan panorama indah Larantuka." },
    { nama: "Lembata", deskripsi: "Pulau dengan budaya unik berburu paus tradisional." },
    { nama: "Malaka", deskripsi: "Daerah baru hasil pemekaran, terkenal dengan adat istiadatnya." },
    { nama: "Manggarai", deskripsi: "Wilayah pegunungan dengan adat kampung Wae Rebo." },
    { nama: "Manggarai Timur", deskripsi: "Destinasi wisata alam dan budaya di Flores bagian timur." },
    { nama: "Nagekeo", deskripsi: "Kawasan agraris dengan adat istiadat yang kental." },
    { nama: "Ngada", deskripsi: "Kaya budaya tradisional dengan rumah adat megalitik." },
    { nama: "Rote Ndao", deskripsi: "Pulau paling selatan Indonesia, terkenal dengan Sasando." },
    { nama: "Sabu Raijua", deskripsi: "Pulau kecil dengan pantai indah dan tradisi unik." },
    { nama: "Sikka", deskripsi: "Daerah di Flores yang dikenal dengan tenun ikat khas Maumere." },
    { nama: "Sumba Barat", deskripsi: "Dikenal dengan kuda Sumba dan pantai eksotis." },
    { nama: "Sumba Barat Daya", deskripsi: "Daerah wisata pantai dan tradisi Pasola." },
    { nama: "Sumba Tengah", deskripsi: "Wilayah pedalaman dengan budaya megalitik." },
    { nama: "Sumba Timur", deskripsi: "Daerah dengan padang savana luas dan budaya kuat." },
    { nama: "Timor Tengah Selatan", deskripsi: "Kaya tradisi Timor, dengan tenun ikat khas." },
    { nama: "Timor Tengah Utara", deskripsi: "Daerah perbatasan dengan budaya yang beragam." }
  ],
  "Nusa Tenggara Barat": [
    { nama: "Mataram", deskripsi: "Ibukota NTB, pusat budaya Sasak dan modernitas." },
    { nama: "Bima", deskripsi: "Kota dengan budaya khas Bima dan wisata pantai." },
    { nama: "Sumbawa", deskripsi: "Pulau besar dengan Gunung Tambora dan pantai indah." },
    { nama: "Dompu", deskripsi: "Terkenal dengan Savana Doro Ncanga dan surfing." },
    { nama: "Lombok Barat", deskripsi: "Pintu gerbang ke Gili Trawangan dan Senggigi." },
    { nama: "Lombok Tengah", deskripsi: "Tempat Mandalika dan budaya Sasak." },
    { nama: "Lombok Timur", deskripsi: "Wilayah kaki Gunung Rinjani dengan panorama indah." },
    { nama: "Lombok Utara", deskripsi: "Pusat wisata Gili Air, Gili Meno, dan Gili Trawangan." },
    { nama: "Sumbawa Barat", deskripsi: "Dikenal dengan pantai Maluk dan tambang Batu Hijau." },
    { nama: "Sumbawa", deskripsi: "Pulau besar dengan adat Sumbawa yang khas." }
  ],
  "Bali": [
    { nama: "Denpasar", deskripsi: "Ibukota Bali dengan budaya dan pusat bisnis." },
    { nama: "Ubud", deskripsi: "Kota seni, budaya, dan sawah terasering yang indah." },
    { nama: "Kuta", deskripsi: "Pantai populer dengan wisata surfing dan hiburan malam." },
    { nama: "Badung", deskripsi: "Wilayah resort mewah dan pantai selatan Bali." },
    { nama: "Bangli", deskripsi: "Kawasan pegunungan dengan Kintamani dan Gunung Batur." },
    { nama: "Buleleng", deskripsi: "Wilayah utara Bali dengan pantai Lovina." },
    { nama: "Gianyar", deskripsi: "Pusat budaya dan pura terkenal seperti Goa Gajah." },
    { nama: "Jembrana", deskripsi: "Wilayah barat Bali dengan tradisi Makepung." },
    { nama: "Karangasem", deskripsi: "Wilayah timur Bali dengan Pura Besakih." },
    { nama: "Klungkung", deskripsi: "Pusat sejarah kerajaan Bali." },
    { nama: "Tabanan", deskripsi: "Wilayah sawah Jatiluwih dan Tanah Lot." },
    { nama: "Denpasar", deskripsi: "Pusat aktivitas ekonomi dan budaya Bali." }
  ],
  "Jawa Timur": [
    { nama: "Surabaya", deskripsi: "Kota Pahlawan dan pusat ekonomi Jawa Timur." },
    { nama: "Malang", deskripsi: "Kota sejuk dengan wisata alam dan kuliner." },
    { nama: "Kediri", deskripsi: "Kota tahu dan Gunung Kelud." },
    { nama: "Banyuwangi", deskripsi: "Gerbang ke Kawah Ijen dan wisata pantai." },
    { nama: "Jember", deskripsi: "Terkenal dengan Jember Fashion Carnaval." },
    { nama: "Madiun", deskripsi: "Kota pecel dengan sejarah panjang." },
    { nama: "Blitar", deskripsi: "Kota makam Bung Karno dan candi-candi bersejarah." },
    { nama: "Probolinggo", deskripsi: "Gerbang menuju Gunung Bromo." },
    { nama: "Pasuruan", deskripsi: "Kota santri dan pusat pertanian." },
    { nama: "Batu", deskripsi: "Kota wisata pegunungan dengan banyak theme park." }
  ],
  "Sulawesi Utara" : [ 
    { nama: "Manado", deskripsi: "Ibukota provinsi, terkenal dengan Bunaken dan kuliner rica-rica." },
    { nama: "Bitung", deskripsi: "Kota pelabuhan dengan Taman Laut Lembeh." },
    { nama: "Tomohon", deskripsi: "Dikenal dengan Danau Linow dan Festival Bunga." },
    { nama: "Kotamobagu", deskripsi: "Kota di Bolaang Mongondow dengan budaya khas." },
    { nama: "Minahasa", deskripsi: "Wilayah pegunungan dengan Danau Tondano." },
    { nama: "Minahasa Utara", deskripsi: "Kawasan Likupang dengan pantai eksotis." },
    { nama: "Minahasa Selatan", deskripsi: "Dikenal dengan pantai-pantai indah di Amurang." },
    { nama: "Minahasa Tenggara", deskripsi: "Wilayah pertanian dan pegunungan di Minahasa." },
    { nama: "Bolaang Mongondow", deskripsi: "Wilayah luas dengan potensi tambang dan pertanian." },
    { nama: "Bolaang Mongondow Utara", deskripsi: "Kabupaten baru dengan wisata bahari." },
    { nama: "Bolaang Mongondow Timur", deskripsi: "Wilayah pemekaran dengan potensi kelautan." },
    { nama: "Bolaang Mongondow Selatan", deskripsi: "Kaya hasil laut dan tradisi lokal." },
    { nama: "Kepulauan Sangihe", deskripsi: "Kepulauan di utara dengan pantai tropis." },
    { nama: "Kepulauan Sitaro", deskripsi: "Pulau eksotis dengan panorama alam laut." },
    { nama: "Kepulauan Talaud", deskripsi: "Kepulauan terluar berbatasan dengan Filipina." }
  ],
  "Sulawesi Tengah": [
    { nama: "Palu", deskripsi: "Ibukota provinsi, dikelilingi pegunungan dan teluk." },
    { nama: "Donggala", deskripsi: "Kota pesisir dengan pantai Tanjung Karang." },
    { nama: "Parigi Moutong", deskripsi: "Wilayah dengan pantai panjang dan hasil laut." },
    { nama: "Poso", deskripsi: "Terkenal dengan Danau Poso dan budaya Pamona." },
    { nama: "Morowali", deskripsi: "Wilayah kaya tambang nikel dan pesisir." },
    { nama: "Morowali Utara", deskripsi: "Daerah pemekaran dengan potensi tambang." },
    { nama: "Tojo Una-Una", deskripsi: "Pusat wisata bawah laut Kepulauan Togean." },
    { nama: "Toli-Toli", deskripsi: "Kota pesisir dengan perkebunan cengkeh." },
    { nama: "Buol", deskripsi: "Wilayah agraris di bagian utara Sulawesi Tengah." },
    { nama: "Banggai", deskripsi: "Terkenal dengan Kepulauan Banggai yang indah." },
    { nama: "Banggai Kepulauan", deskripsi: "Pulau eksotis dengan laut biru jernih." },
    { nama: "Banggai Laut", deskripsi: "Daerah pesisir dengan keindahan bahari." },
    { nama: "Sigi", deskripsi: "Kawasan pertanian subur di dekat Palu." }
  ],
  "Sulawesi Barat": [
    { nama: "Mamuju", deskripsi: "Ibukota provinsi, kota pesisir dengan panorama Teluk Mamuju." },
    { nama: "Polewali Mandar", deskripsi: "Terkenal dengan tradisi Mandar dan kuliner ikan bakar." },
    { nama: "Mamasa", deskripsi: "Wilayah pegunungan dengan budaya mirip Toraja." },
    { nama: "Majene", deskripsi: "Kota pesisir dengan pantai-pantai cantik." },
    { nama: "Mamuju Tengah", deskripsi: "Kabupaten baru dengan potensi perkebunan." },
    { nama: "Pasangkayu", deskripsi: "Wilayah pertanian kelapa sawit di utara Sulbar." }
  ],
  "Sulawesi Selatan": [
    { nama: "Makassar", deskripsi: "Ibukota provinsi, kota besar dengan Pantai Losari." },
    { nama: "Parepare", deskripsi: "Kota kelahiran BJ Habibie di pesisir barat Sulsel." },
    { nama: "Palopo", deskripsi: "Kota di Luwu dengan sejarah kerajaan Luwu." },
    { nama: "Gowa", deskripsi: "Wilayah kerajaan Gowa Tallo, dekat Malino." },
    { nama: "Takalar", deskripsi: "Kota pesisir dengan wisata pantai." },
    { nama: "Jeneponto", deskripsi: "Dikenal dengan peternakan kuda dan sabung ayam." },
    { nama: "Bantaeng", deskripsi: "Kota kecil dengan udara sejuk di pegunungan." },
    { nama: "Bulukumba", deskripsi: "Pusat pembuatan kapal pinisi dan Pantai Bira." },
    { nama: "Sinjai", deskripsi: "Wilayah pesisir dengan kepulauan kecil." },
    { nama: "Bone", deskripsi: "Kerajaan Bone dengan sejarah Bugis." },
    { nama: "Soppeng", deskripsi: "Daerah dengan adat Bugis yang kental." },
    { nama: "Wajo", deskripsi: "Wilayah terkenal dengan budaya Bugis dan danau Tempe." },
    { nama: "Sidrap", deskripsi: "Pusat pembangkit listrik tenaga angin." },
    { nama: "Pinrang", deskripsi: "Daerah agraris dengan hasil pertanian." },
    { nama: "Enrekang", deskripsi: "Dikenal dengan Gunung Bambapuang." },
    { nama: "Toraja Utara", deskripsi: "Pusat budaya Toraja dengan rumah tongkonan." },
    { nama: "Tana Toraja", deskripsi: "Wisata budaya dan upacara adat Rambu Solo’." },
    { nama: "Luwu Timur", deskripsi: "Daerah industri pertambangan." },
    { nama: "Luwu Utara", deskripsi: "Kaya dengan perkebunan dan pertanian." },
    { nama: "Luwu", deskripsi: "Wilayah kerajaan tua di Sulsel." },
    { nama: "Maros", deskripsi: "Terkenal dengan gua karst dan Taman Nasional Bantimurung." },
    { nama: "Pangkep", deskripsi: "Wilayah kepulauan Spermonde dengan panorama laut." },
    { nama: "Barru", deskripsi: "Daerah pesisir dengan perikanan." },
    { nama: "Selayar", deskripsi: "Kepulauan Selayar dengan Taman Nasional Takabonerate." }
  ],
  "Sulawesi Tenggara": [
    { nama: "Kendari", deskripsi: "Ibukota provinsi dengan Teluk Kendari." },
    { nama: "Bau-Bau", deskripsi: "Kota di Pulau Buton dengan Benteng Keraton Buton." },
    { nama: "Kolaka", deskripsi: "Wilayah pesisir dengan tambang nikel." },
    { nama: "Kolaka Timur", deskripsi: "Daerah pemekaran dengan potensi perkebunan." },
    { nama: "Kolaka Utara", deskripsi: "Wilayah pegunungan dengan hasil perkebunan." },
    { nama: "Konawe", deskripsi: "Kabupaten tua dengan pertanian." },
    { nama: "Konawe Selatan", deskripsi: "Wilayah dengan wisata pantai Moramo." },
    { nama: "Konawe Kepulauan", deskripsi: "Kabupaten kepulauan dengan laut jernih." },
    { nama: "Konawe Utara", deskripsi: "Dikenal dengan pertambangan nikel." },
    { nama: "Muna", deskripsi: "Wilayah budaya khas Muna dan seni bela diri Kaghati." },
    { nama: "Muna Barat", deskripsi: "Daerah pemekaran dari Muna." },
    { nama: "Buton", deskripsi: "Pusat kerajaan Buton dan hasil aspal alam." },
    { nama: "Buton Selatan", deskripsi: "Daerah wisata bahari dan budaya." },
    { nama: "Buton Tengah", deskripsi: "Kabupaten kepulauan di Buton." },
    { nama: "Buton Utara", deskripsi: "Wilayah pesisir dengan tradisi khas Buton." },
    { nama: "Wakatobi", deskripsi: "Surga diving kelas dunia di Sulawesi Tenggara." },
    { nama: "Bombana", deskripsi: "Wilayah tambang emas dan pesisir." }
  ],
  "Maluku Utara": [
    { nama: "Ternate", deskripsi: "Kota sejarah rempah-rempah dan Gunung Gamalama." },
    { nama: "Tidore Kepulauan", deskripsi: "Pusat sejarah Kesultanan Tidore." },
    { nama: "Halmahera Barat", deskripsi: "Pulau besar dengan wisata bahari." },
    { nama: "Halmahera Tengah", deskripsi: "Wilayah pegunungan dan hutan tropis." },
    { nama: "Halmahera Selatan", deskripsi: "Pulau Obi dan keindahan lautnya." },
    { nama: "Halmahera Timur", deskripsi: "Daerah pesisir dengan keindahan bahari." },
    { nama: "Halmahera Utara", deskripsi: "Kaya hasil laut dan wisata pantai." },
    { nama: "Pulau Morotai", deskripsi: "Pulau bersejarah Perang Dunia II." },
    { nama: "Kepulauan Sula", deskripsi: "Gugusan pulau eksotis di Malut." }
  ],
  "Maluku": [
    { nama: "Ambon", deskripsi: "Ibukota provinsi, dikenal dengan Pantai Natsepa." },
    { nama: "Tual", deskripsi: "Kota pesisir di Kepulauan Kei." },
    { nama: "Maluku Tengah", deskripsi: "Pulau Seram dengan budaya dan hutan tropis." },
    { nama: "Maluku Tenggara", deskripsi: "Wilayah Kei dengan pantai pasir putih." },
    { nama: "Maluku Tenggara Barat", deskripsi: "Pulau Tanimbar dengan budaya lokal." },
    { nama: "Seram Bagian Barat", deskripsi: "Hutan tropis dan budaya unik Seram." },
    { nama: "Seram Bagian Timur", deskripsi: "Daerah timur Pulau Seram." },
    { nama: "Buru", deskripsi: "Pulau bersejarah dengan panorama alam." },
    { nama: "Kepulauan Aru", deskripsi: "Kepulauan dengan laut biru eksotis." }
  ],
  "Papua": [
    { nama: "Jayapura", deskripsi: "Ibukota provinsi, kota di tepi Teluk Yos Sudarso." },
    { nama: "Merauke", deskripsi: "Kota paling timur Indonesia, perbatasan Papua Nugini." },
    { nama: "Biak Numfor", deskripsi: "Pulau dengan sejarah PD II dan keindahan bawah laut." },
    { nama: "Nabire", deskripsi: "Gerbang menuju Teluk Cenderawasih." },
    { nama: "Yapen", deskripsi: "Pulau Yapen dengan budaya pesisir." },
    { nama: "Sarmi", deskripsi: "Wilayah pesisir dengan hasil laut." },
    { nama: "Kepulauan Yapen", deskripsi: "Gugusan pulau di Papua utara." },
    { nama: "Manokwari", deskripsi: "Kota sejarah injil di Papua Barat." },
    { nama: "Sorong", deskripsi: "Gerbang menuju Raja Ampat." },
    { nama: "Fakfak", deskripsi: "Kota tua dengan kerukunan antaragama." },
    { nama: "Kaimana", deskripsi: "Dikenal dengan sunset terindah di dunia." },
    { nama: "Wamena", deskripsi: "Ibukota Lembah Baliem dengan budaya suku Dani." },
    { nama: "Paniai", deskripsi: "Wilayah pegunungan Papua." },
    { nama: "Intan Jaya", deskripsi: "Kawasan pegunungan tengah." },
    { nama: "Mimika", deskripsi: "Lokasi tambang emas terbesar Freeport." },
    { nama: "Asmat", deskripsi: "Suku Asmat dengan seni ukir kayu mendunia." },
    { nama: "Pegunungan Bintang", deskripsi: "Daerah pegunungan terpencil." }
  ],
  "Aceh": [
  { nama: "Aceh Selatan", deskripsi: "Dikenal dengan pantai-pantai indah seperti Tapaktuan." },
  { nama: "Aceh Tenggara", deskripsi: "Wilayah pegunungan dengan potensi wisata alam Leuser." },
  { nama: "Aceh Timur", deskripsi: "Daerah pesisir timur dengan perkebunan sawit dan gas alam." },
  { nama: "Aceh Tengah", deskripsi: "Dataran tinggi Gayo, penghasil kopi terkenal." },
  { nama: "Aceh Barat", deskripsi: "Beribukota di Meulaboh, salah satu daerah pesisir barat Aceh." },
  { nama: "Aceh Besar", deskripsi: "Dekat dengan Banda Aceh, memiliki sejarah Kesultanan Aceh." },
  { nama: "Pidie", deskripsi: "Kawasan pertanian dan budaya kuat di Aceh bagian utara." },
  { nama: "Aceh Utara", deskripsi: "Wilayah kaya minyak dan gas, pusatnya di Lhokseumawe." },
  { nama: "Simeulue", deskripsi: "Pulau di barat Aceh dengan ombak surfing terkenal." },
  { nama: "Aceh Singkil", deskripsi: "Gerbang menuju Kepulauan Banyak, surga wisata bahari." },
  { nama: "Bireuen", deskripsi: "Kota perdagangan dan pendidikan di tengah pantai utara Aceh." },
  { nama: "Aceh Barat Daya", deskripsi: "Wilayah kecil dengan pesona alam dan budaya pesisir." },
  { nama: "Gayo Lues", deskripsi: "Pegunungan sejuk penghasil kopi dan madu hutan." },
  { nama: "Aceh Jaya", deskripsi: "Daerah pesisir dengan potensi perikanan dan wisata alam." },
  { nama: "Nagan Raya", deskripsi: "Wilayah agraris dengan PLTU besar di Suak Puntong." },
  { nama: "Aceh Tamiang", deskripsi: "Berbatasan dengan Sumatera Utara, kaya sumber daya alam." },
  { nama: "Bener Meriah", deskripsi: "Wilayah dataran tinggi penghasil kopi Gayo berkualitas." },
  { nama: "Pidie Jaya", deskripsi: "Pemekaran dari Pidie, dikenal dengan sektor pertaniannya." },
  { nama: "Kota Banda Aceh", deskripsi: "Ibukota provinsi, pusat sejarah dan budaya Islam di Aceh." },
  { nama: "Kota Sabang", deskripsi: "Pulau Weh, titik nol kilometer Indonesia dengan wisata bahari." },
  { nama: "Kota Lhokseumawe", deskripsi: "Kota industri dan perdagangan di pesisir utara." },
  { nama: "Kota Langsa", deskripsi: "Kota pelabuhan dan perdagangan di pantai timur Aceh." },
  { nama: "Kota Subulussalam", deskripsi: "Kota di barat daya Aceh yang dikelilingi hutan dan perbukitan." }
],
  "Sumatera Utara": [
  { nama: "Tapanuli Tengah", deskripsi: "Wilayah pesisir barat dengan pelabuhan Sibolga dan wisata bahari." },
  { nama: "Tapanuli Utara", deskripsi: "Dataran tinggi sejuk, pusat budaya Batak Toba." },
  { nama: "Tapanuli Selatan", deskripsi: "Daerah pegunungan dengan budaya Mandailing yang kuat." },
  { nama: "Nias", deskripsi: "Pulau terkenal dengan budaya megalitik dan ombak surfing dunia." },
  { nama: "Langkat", deskripsi: "Wilayah utara yang berbatasan dengan Taman Nasional Gunung Leuser." },
  { nama: "Karo", deskripsi: "Dataran tinggi penghasil sayuran, terkenal dengan wisata Berastagi." },
  { nama: "Deli Serdang", deskripsi: "Wilayah metropolitan yang mengelilingi Kota Medan." },
  { nama: "Simalungun", deskripsi: "Daerah Danau Toba bagian timur dengan perkebunan luas." },
  { nama: "Asahan", deskripsi: "Wilayah pesisir timur dengan kota utama Kisaran." },
  { nama: "Labuhanbatu", deskripsi: "Daerah perkebunan kelapa sawit dan karet di selatan Sumut." },
  { nama: "Dairi", deskripsi: "Wilayah pegunungan penghasil kopi dan hasil bumi." },
  { nama: "Toba Samosir", deskripsi: "Sekitar Danau Toba, pusat pariwisata utama Sumatera Utara." },
  { nama: "Mandailing Natal", deskripsi: "Dikenal dengan budaya Mandailing dan keindahan alam." },
  { nama: "Nias Selatan", deskripsi: "Wilayah dengan pantai indah dan atraksi lompat batu tradisional." },
  { nama: "Pakpak Bharat", deskripsi: "Daerah pegunungan tenang di barat Sumatera Utara." },
  { nama: "Humbang Hasundutan", deskripsi: "Wilayah dataran tinggi penghasil sayur dan kopi." },
  { nama: "Samosir", deskripsi: "Pulau di tengah Danau Toba, pusat budaya Batak Toba." },
  { nama: "Serdang Bedagai", deskripsi: "Daerah pertanian dan wisata pantai di timur Sumut." },
  { nama: "Batu Bara", deskripsi: "Wilayah pesisir dengan aktivitas pelabuhan dan industri." },
  { nama: "Padang Lawas Utara", deskripsi: "Wilayah agraris dengan peninggalan candi bersejarah." },
  { nama: "Padang Lawas", deskripsi: "Kawasan pedalaman dengan situs arkeologi kuno." },
  { nama: "Labuhanbatu Selatan", deskripsi: "Daerah perkebunan baru hasil pemekaran dari Labuhanbatu." },
  { nama: "Labuhanbatu Utara", deskripsi: "Wilayah pesisir dan perkebunan di utara Labuhanbatu." },
  { nama: "Nias Utara", deskripsi: "Pulau dengan pesisir alami dan budaya lokal yang kuat." },
  { nama: "Nias Barat", deskripsi: "Wilayah pesisir barat Pulau Nias dengan potensi wisata alam." },
  { nama: "Kota Medan", deskripsi: "Ibukota provinsi dan kota terbesar di Sumatera, pusat ekonomi." },
  { nama: "Kota Pematangsiantar", deskripsi: "Kota sejuk di jalur menuju Danau Toba." },
  { nama: "Kota Sibolga", deskripsi: "Kota pelabuhan di pantai barat Sumatera Utara." },
  { nama: "Kota Tanjung Balai", deskripsi: "Kota pesisir dengan pelabuhan ekspor impor." },
  { nama: "Kota Binjai", deskripsi: "Kota penyangga Medan dengan aktivitas perdagangan." },
  { nama: "Kota Tebing Tinggi", deskripsi: "Kota transit strategis di jalur lintas Sumatera." },
  { nama: "Kota Padang Sidempuan", deskripsi: "Kota di selatan Sumut dengan budaya Mandailing." },
  { nama: "Kota Gunungsitoli", deskripsi: "Kota utama di Pulau Nias, pusat pemerintahan dan ekonomi." }
],
  "Sumatera Selatan": [
  { nama: "Ogan Komering Ulu", deskripsi: "Salah satu kabupaten tertua di Sumsel, beribukota di Baturaja." },
  { nama: "Ogan Komering Ilir", deskripsi: "Wilayah timur dengan banyak sungai dan lahan rawa, ibukotanya Kayuagung." },
  { nama: "Muara Enim", deskripsi: "Kawasan industri dan pertambangan batu bara." },
  { nama: "Lahat", deskripsi: "Dikenal dengan air terjun dan situs megalitikum." },
  { nama: "Musi Rawas", deskripsi: "Wilayah pertanian dan perkebunan di barat Sumatera Selatan." },
  { nama: "Musi Banyuasin", deskripsi: "Kaya minyak bumi dan gas, pusat industrinya di Sekayu." },
  { nama: "Banyuasin", deskripsi: "Daerah pesisir dekat Palembang dengan aktivitas perikanan dan pelabuhan." },
  { nama: "Ogan Komering Ulu Timur", deskripsi: "Wilayah agraris dengan sentra pertanian dan perkebunan." },
  { nama: "Ogan Komering Ulu Selatan", deskripsi: "Dataran tinggi sejuk dengan panorama alam dan wisata air terjun." },
  { nama: "Ogan Ilir", deskripsi: "Dekat Palembang, dikenal dengan kawasan pendidikan dan pesantren." },
  { nama: "Empat Lawang", deskripsi: "Wilayah pegunungan hasil pemekaran Lahat, terkenal dengan duriannya." },
  { nama: "Penukal Abab Lematang Ilir", deskripsi: "Kabupaten baru dengan potensi pertambangan dan perkebunan." },
  { nama: "Musi Rawas Utara", deskripsi: "Wilayah pemekaran dengan sumber daya alam melimpah." },
  { nama: "Kota Palembang", deskripsi: "Ibukota provinsi, kota tertua di Indonesia dengan ikon Jembatan Ampera." },
  { nama: "Kota Pagar Alam", deskripsi: "Kota pegunungan sejuk di kaki Gunung Dempo, terkenal dengan teh dan kopi." },
  { nama: "Kota Lubuk Linggau", deskripsi: "Kota transit penting di jalur barat Sumatera Selatan." },
  { nama: "Kota Prabumulih", deskripsi: "Kota penghasil minyak dan gas dengan perkembangan pesat." }
],
  "Sumatera Barat": [
  { nama: "Pesisir Selatan", deskripsi: "Wilayah pesisir barat Sumatera dengan pantai indah seperti Carocok Painan." },
  { nama: "Solok", deskripsi: "Dikenal sebagai penghasil beras terbaik di Sumatera Barat." },
  { nama: "Sijunjung", deskripsi: "Wilayah yang kaya akan budaya Minangkabau dan alam pedesaan." },
  { nama: "Tanah Datar", deskripsi: "Pusat sejarah Kerajaan Minangkabau, beribukota di Batusangkar." },
  { nama: "Padang Pariaman", deskripsi: "Wilayah dekat pesisir dengan tradisi Tabuik yang terkenal." },
  { nama: "Agam", deskripsi: "Kabupaten berhawa sejuk dengan wisata seperti Danau Maninjau." },
  { nama: "Lima Puluh Kota", deskripsi: "Wilayah perbukitan subur di jalur lintas Sumatera, ibukotanya Sarilamak." },
  { nama: "Pasaman", deskripsi: "Kabupaten di utara Sumbar dengan pegunungan dan hutan lebat." },
  { nama: "Kepulauan Mentawai", deskripsi: "Gugusan pulau di barat Sumatera, surga surfing dunia." },
  { nama: "Dharmasraya", deskripsi: "Wilayah selatan dengan sejarah kerajaan Melayu Kuno." },
  { nama: "Solok Selatan", deskripsi: "Daerah pegunungan dengan air terjun dan wisata alam menawan." },
  { nama: "Pasaman Barat", deskripsi: "Wilayah pesisir barat dengan sektor pertanian dan perikanan." },
  { nama: "Kota Padang", deskripsi: "Ibukota provinsi, kota pesisir dengan ikon Pantai Padang dan Jembatan Siti Nurbaya." },
  { nama: "Kota Solok", deskripsi: "Kota kecil berhawa sejuk di lembah Bukit Barisan." },
  { nama: "Kota Sawahlunto", deskripsi: "Bekas kota tambang batubara yang kini jadi kota wisata sejarah." },
  { nama: "Kota Padang Panjang", deskripsi: "Kota pendidikan dan budaya di dataran tinggi Minangkabau." },
  { nama: "Kota Bukittinggi", deskripsi: "Kota wisata populer dengan Jam Gadang dan panorama alamnya." },
  { nama: "Kota Payakumbuh", deskripsi: "Kota kuliner dan industri kecil di lembah hijau Sumatera Barat." },
  { nama: "Kota Pariaman", deskripsi: "Kota pesisir dengan tradisi Tabuik dan pantai-pantai indah." }
],
  "Bengkulu": [
  { nama: "Bengkulu Selatan", deskripsi: "Wilayah pesisir dengan pantai panjang dan hasil laut melimpah." },
  { nama: "Rejang Lebong", deskripsi: "Dataran tinggi berhawa sejuk, terkenal dengan perkebunan teh dan sayuran." },
  { nama: "Bengkulu Utara", deskripsi: "Kawasan luas di utara provinsi dengan potensi pertanian dan perkebunan." },
  { nama: "Kaur", deskripsi: "Kabupaten di selatan Bengkulu dengan pantai alami dan wisata bahari." },
  { nama: "Seluma", deskripsi: "Wilayah pesisir yang terus berkembang dengan potensi kelautan dan agraris." },
  { nama: "Muko Muko", deskripsi: "Daerah paling utara, berbatasan dengan Sumatera Barat, kaya hasil bumi." },
  { nama: "Lebong", deskripsi: "Wilayah pegunungan dengan sumber daya tambang dan keindahan alam." },
  { nama: "Kepahiang", deskripsi: "Kawasan sejuk dengan kebun kopi dan teh di dataran tinggi Bukit Barisan." },
  { nama: "Bengkulu Tengah", deskripsi: "Kabupaten muda dekat ibu kota provinsi dengan pertanian berkembang." },
  { nama: "Kota Bengkulu", deskripsi: "Ibukota provinsi di tepi pantai, tempat bersejarah Benteng Marlborough." }
],
  "Riau": [
  { nama: "Kampar", deskripsi: "Wilayah bersejarah di tepi Sungai Kampar, terkenal dengan Bendungan Koto Panjang." },
  { nama: "Indragiri Hulu", deskripsi: "Daerah pedalaman dengan perkebunan sawit dan hutan tropis." },
  { nama: "Bengkalis", deskripsi: "Kabupaten kepulauan di pesisir timur, kaya hasil laut dan minyak bumi." },
  { nama: "Indragiri Hilir", deskripsi: "Wilayah pesisir selatan Riau dengan kebun kelapa terluas di Indonesia." },
  { nama: "Pelalawan", deskripsi: "Kawasan industri dan hutan konservasi Taman Nasional Tesso Nilo." },
  { nama: "Rokan Hulu", deskripsi: "Dikenal dengan wisata alam dan situs sejarah Kerajaan Rokan." },
  { nama: "Rokan Hilir", deskripsi: "Wilayah pesisir dengan pelabuhan dan sektor perikanan berkembang." },
  { nama: "Siak", deskripsi: "Bekas pusat Kesultanan Siak Sri Indrapura, kaya nilai sejarah Melayu." },
  { nama: "Kuantan Singingi", deskripsi: "Daerah budaya Pacu Jalur di Sungai Kuantan yang terkenal." },
  { nama: "Kepulauan Meranti", deskripsi: "Gugusan pulau di timur Riau, dikenal dengan sagu dan budaya pesisir." },
  { nama: "Kota Pekanbaru", deskripsi: "Ibukota provinsi, pusat perdagangan dan bisnis di Sumatera Tengah." },
  { nama: "Kota Dumai", deskripsi: "Kota pelabuhan dan industri minyak di pesisir Selat Malaka." }
],
  "Kepulauan Riau": [
  { nama: "Bintan", deskripsi: "Pulau utama dengan kawasan wisata internasional Lagoi dan pantai eksotis." },
  { nama: "Karimun", deskripsi: "Pulau strategis dekat Singapura, pusat perdagangan dan pelabuhan." },
  { nama: "Natuna", deskripsi: "Gugusan pulau di Laut Natuna Utara, kaya sumber daya alam dan gas." },
  { nama: "Lingga", deskripsi: "Wilayah dengan sejarah Kesultanan Lingga dan pesona pulau tropis." },
  { nama: "Kepulauan Anambas", deskripsi: "Kepulauan terpencil dengan laut jernih, salah satu destinasi diving terbaik." },
  { nama: "Kota Batam", deskripsi: "Kota industri dan ekonomi utama, pintu gerbang internasional ke Singapura." },
  { nama: "Kota Tanjung Pinang", deskripsi: "Ibukota provinsi, kota budaya Melayu dengan sejarah panjang." }
],
  "Jambi": [
  { nama: "Kerinci", deskripsi: "Wilayah pegunungan di kaki Gunung Kerinci, terkenal dengan Danau Kerinci dan teh Kayu Aro." },
  { nama: "Merangin", deskripsi: "Daerah dengan situs fosil purba dan wisata alam Geopark Merangin." },
  { nama: "Sarolangun", deskripsi: "Wilayah hutan dan tambang, kaya sumber daya alam." },
  { nama: "Batanghari", deskripsi: "Kabupaten tertua di Jambi dengan sejarah Melayu kuno." },
  { nama: "Muaro Jambi", deskripsi: "Lokasi kompleks Candi Muaro Jambi, peninggalan kerajaan Sriwijaya." },
  { nama: "Tanjung Jabung Barat", deskripsi: "Wilayah pesisir barat dengan pelabuhan dan hutan mangrove." },
  { nama: "Tanjung Jabung Timur", deskripsi: "Daerah pesisir timur dengan kawasan konservasi hutan bakau." },
  { nama: "Bungo", deskripsi: "Wilayah perbukitan dengan potensi perkebunan dan tambang emas." },
  { nama: "Tebo", deskripsi: "Kawasan agraris dengan potensi kehutanan dan sungai besar." },
  { nama: "Kota Jambi", deskripsi: "Ibukota provinsi di tepi Sungai Batanghari, pusat pemerintahan dan ekonomi." },
  { nama: "Kota Sungai Penuh", deskripsi: "Kota di lembah Kerinci dengan udara sejuk dan alam pegunungan." }
],
  "Lampung": [
  { nama: "Lampung Selatan", deskripsi: "Gerbang utama Pulau Sumatra, dikenal dengan Pelabuhan Bakauheni dan pantai-pantai indahnya." },
  { nama: "Lampung Tengah", deskripsi: "Wilayah agraris di jantung Lampung dengan lahan subur dan perkebunan luas." },
  { nama: "Lampung Utara", deskripsi: "Daerah dengan potensi pertanian dan kehutanan, serta jalur penghubung antarprovinsi." },
  { nama: "Lampung Barat", deskripsi: "Kawasan pegunungan Bukit Barisan, dikenal dengan Danau Ranau dan keindahan alamnya." },
  { nama: "Tulang Bawang", deskripsi: "Wilayah dataran rendah dengan potensi pertanian, sungai besar, dan budaya masyarakat adat." },
  { nama: "Tanggamus", deskripsi: "Dikenal dengan Teluk Kiluan, habitat lumba-lumba dan panorama pantai yang menawan." },
  { nama: "Lampung Timur", deskripsi: "Daerah dengan Taman Nasional Way Kambas, tempat konservasi gajah Sumatra." },
  { nama: "Way Kanan", deskripsi: "Wilayah dengan hutan tropis dan potensi energi air dari sungai besar." },
  { nama: "Pesawaran", deskripsi: "Destinasi wisata bahari dengan gugusan pulau dan pantai eksotis seperti Pulau Pahawang." },
  { nama: "Pringsewu", deskripsi: "Daerah berkembang dengan keindahan alam perbukitan dan masyarakat yang ramah." },
  { nama: "Mesuji", deskripsi: "Kabupaten muda dengan lahan pertanian luas di perbatasan Sumatra Selatan." },
  { nama: "Tulang Bawang Barat", deskripsi: "Kawasan baru dengan sentuhan modern dan budaya lokal khas Lampung." },
  { nama: "Pesisir Barat", deskripsi: "Surga surfing dengan pantai-pantai seperti Krui yang mendunia." },
  { nama: "Kota Bandar Lampung", deskripsi: "Ibukota provinsi, pusat pemerintahan, ekonomi, dan pendidikan di selatan Lampung." },
  { nama: "Kota Metro", deskripsi: "Kota pendidikan yang rapi dan nyaman, terkenal dengan lingkungan bersih dan tertib." }
],
  "Kepulauan Bangka Belitung": [
  { nama: "Bangka", deskripsi: "Pulau utama dengan tambang timah, pantai pasir putih, dan kuliner khas seperti lempah kuning." },
  { nama: "Belitung", deskripsi: "Pulau wisata terkenal dengan pantai granit besar dan laut biru jernih seperti di Tanjung Tinggi." },
  { nama: "Bangka Selatan", deskripsi: "Wilayah pesisir dengan potensi wisata bahari dan tambang rakyat." },
  { nama: "Bangka Tengah", deskripsi: "Terletak di jantung Pulau Bangka, berkembang di sektor pertanian dan perikanan." },
  { nama: "Bangka Barat", deskripsi: "Daerah dengan sejarah timah dan peninggalan kolonial di Muntok." },
  { nama: "Belitung Timur", deskripsi: "Kampung halaman tokoh Laskar Pelangi, dengan pesona alam dan budaya khas." },
  { nama: "Kota Pangkal Pinang", deskripsi: "Ibukota provinsi, pusat ekonomi dan pemerintahan, terkenal dengan pantai Pasir Padi." }
],
  "Kalimantan Timur": [
  { nama: "Paser", deskripsi: "Wilayah di selatan Kaltim dengan potensi tambang batubara dan perkebunan kelapa sawit." },
  { nama: "Kutai Kartanegara", deskripsi: "Kabupaten besar dengan sejarah Kesultanan Kutai dan kawasan industri sekitar Tenggarong." },
  { nama: "Berau", deskripsi: "Daerah wisata bahari terkenal dengan Kepulauan Derawan dan taman lautnya." },
  { nama: "Kutai Barat", deskripsi: "Wilayah pedalaman dengan kekayaan alam dan budaya Dayak yang masih kuat." },
  { nama: "Kutai Timur", deskripsi: "Pusat industri pertambangan dan kehutanan, dengan ibu kota Sangatta." },
  { nama: "Penajam Paser Utara", deskripsi: "Lokasi calon ibu kota negara (IKN) Nusantara, dengan pembangunan pesat." },
  { nama: "Mahakam Ulu", deskripsi: "Wilayah baru di hulu Sungai Mahakam dengan potensi hutan tropis dan ekowisata." },
  { nama: "Kota Balikpapan", deskripsi: "Kota pelabuhan dan industri minyak terbesar di Kaltim, gerbang menuju IKN." },
  { nama: "Kota Samarinda", deskripsi: "Ibukota provinsi dan pusat ekonomi di tepi Sungai Mahakam." },
  { nama: "Kota Bontang", deskripsi: "Kota industri dan energi, terkenal dengan pabrik pupuk dan gas alam." }
],









};

const provinsiList = Object.keys(dataDaerah);

const searchInput = document.getElementById("searchProvinsi");
const suggestionBox = document.getElementById("suggestions");
const container = document.getElementById("daerahCards");
const btnCari = document.getElementById("btnCari");

function tampilkanSuggestions(query) {
  suggestionBox.innerHTML = "";
  container.innerHTML = "";

  if (!query) return;

  const filteredProvinsi = provinsiList.filter(p => 
    p.toLowerCase().includes(query.toLowerCase())
  );

  if (filteredProvinsi.length > 0) {
    filteredProvinsi.forEach(prov => {
      const li = document.createElement("li");
      li.className = "list-group-item list-group-item-action";
      li.textContent = prov;
      li.addEventListener("click", function() {
        searchInput.value = prov;
        suggestionBox.innerHTML = "";
        tampilkanDaerah(prov);
      });
      suggestionBox.appendChild(li);
    });
  } else {
    const li = document.createElement("li");
    li.className = "list-group-item text-muted text-center";
    li.textContent = "❌ Tidak ditemukan";
    suggestionBox.appendChild(li);
  }

  // Langsung tampilkan card meski baru ketik 1 huruf
  filteredProvinsi.forEach(p => tampilkanDaerah(p));
}
searchInput.addEventListener("input", function() {
  const query = this.value.trim();
  tampilkanSuggestions(query);
});
// Tombol "Cari" manual
btnCari.addEventListener("click", function() {
  tampilkanSuggestions(searchInput.value.trim());
});
// Tutup daftar saran saat klik di luar
document.addEventListener("click", (e) => {
  if (!e.target.closest(".search-box")) suggestionBox.innerHTML = "";
});


function tampilkanDaerah(provinsi) {
  container.innerHTML = "";
  if (provinsi && dataDaerah[provinsi]) {
    dataDaerah[provinsi].forEach(daerah => {
      const imgName = daerah.nama.replace(/\s+/g, '%20');
      container.innerHTML += `
        <div class="col-md-4 mb-3">
          <div class="card shadow-sm h-100">
            <img src="assets/img/daerah/${imgName}.jpg" class="card-img-top" alt="${daerah.nama}" style="height:200px;object-fit:cover;">
            <div class="card-body">
              <h5 class="card-title text-center">${daerah.nama}</h5>
              <p class="card-text text-muted" style="font-size: 0.9rem;">${daerah.deskripsi}</p>
              <div class="text-center">
                <a href="wisata.php?daerah=${daerah.nama}" class="btn btn-primary btn-sm">Lihat Wisata</a>
              </div>
            </div>
          </div>
        </div>
      `;
    });
  }
}


function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("active");
  document.getElementById("content").classList.toggle("shift");
}

document.addEventListener("DOMContentLoaded", function () {
    if (window.location.hash === "#daerah") {
        const provinsiSelect = document.getElementById("provinsiSelect");
        if (provinsiSelect) {
            provinsiSelect.focus();   // fokus ke dropdown
            provinsiSelect.click();   // buka dropdown (di Chrome/Edge biasanya kebuka)
        }
    }
});

document.getElementById("provinsiSelect").addEventListener("change", function() {
  let provinsi = this.value;
  let container = document.getElementById("daerahCards");
  container.innerHTML = "";

  if (provinsi && dataDaerah[provinsi]) {
    dataDaerah[provinsi].forEach(daerah => {  
      let imgName = daerah.nama.replace(/\s+/g, '%20');
      container.innerHTML += `
        <div class="col-md-4 mb-3">
          <div class="card shadow-sm h-100">
            <img src="assets/img/daerah/${imgName}.jpg" class="card-img-top" alt="${daerah.nama}" style="height:200px;object-fit:cover;">
            <div class="card-body">
              <h5 class="card-title text-center">${daerah.nama}</h5>
              <p class="card-text text-muted" style="font-size: 0.9rem;">${daerah.deskripsi}</p>
              <div class="text-center">
                <a href="wisata.php?daerah=${daerah.nama}" class="btn btn-primary btn-sm">Lihat Wisata</a>
              </div>
            </div>
          </div>
        </div>
      `;
    });
  }
});
</script>
</body>
</html>
