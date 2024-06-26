<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'koneksi.php';

$id_peminjaman = $_GET['id'];

// Query untuk mendapatkan id_buku berdasarkan id_peminjaman
$query = "SELECT id_buku FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$id_buku = $row['id_buku'];

// Mengubah status buku menjadi 'ready'
$query_update_buku = "UPDATE buku SET status = 'ready' WHERE id_buku = '$id_buku'";
mysqli_query($conn, $query_update_buku);

// Mengubah status peminjaman menjadi 'dikembalikan'
$query_update_peminjaman = "UPDATE peminjaman SET status = 'dikembalikan' WHERE id_peminjaman = '$id_peminjaman'";
mysqli_query($conn, $query_update_peminjaman);

if ($result) {
    echo "<script> 
            alert('Buku succes dikembalikan!');
            document.location.href = 'index.php';
        </script>";
   
} else {
    echo "Gagal mengembalikan buku.";
}
?>
