<?php
$provinsi = [
  "Nusa Tenggara Timur",
  "Nusa Tenggara Barat",
  "Bali",
  "Sulawesi Utara",
  "Sulawesi Tengah",
  "Sulawesi Barat",
  "Sulawesi Selatan",
  "Sulawesi Tenggara",
  "Maluku Utara",
  "Maluku",
  "Papua",
  "Jawa Timur"
];

$q = strtolower($_GET['q'] ?? '');
$result = '';

if ($q !== '') {
  foreach ($provinsi as $p) {
    if (strpos(strtolower($p), $q) !== false) {
      $result .= "<a href='#' class='list-group-item list-group-item-action suggest-item'>$p</a>";
    }
  }
}

echo $result ?: "<div class='list-group-item disabled text-muted'>Tidak ditemukan</div>";
?>
