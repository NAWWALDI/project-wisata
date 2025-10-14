<?php
session_start();
include "../koneksi.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM wisata WHERE id_wisata='$id'");
header("Location: wisata.php");
exit;

