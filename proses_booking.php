<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION["id_user"])) {
    echo "ID User tidak ditemukan di session.";
    exit;
}

$id_user = $_SESSION["id_user"];
$id_buku = isset($_POST['id_buku']) ? $_POST['id_buku'] : null;

if (!$id_buku) {
    echo "ID Buku tidak ditemukan.";
    exit;
}

// Debugging: Periksa nilai session
echo "ID User: $id_user<br>";
echo "ID Buku: $id_buku<br>";

$tanggal_pinjam = date("Y-m-d");
$tanggal_kembali = date("Y-m-d", strtotime("+7 days"));
$status_dipinjam = 'Dipinjam';
$status_ready = 'Ready';

// Memastikan id_user valid
$user_check_query = "SELECT * FROM user WHERE id_user = '$id_user' LIMIT 1";
$result = mysqli_query($conn, $user_check_query);

if (!$result) {
    echo "Error dalam menjalankan kueri: " . mysqli_error($conn);
    exit;
}

$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "ID User tidak valid.";
    exit;
}

// Periksa status buku
$buku_check_query = "SELECT * FROM buku WHERE id_buku = '$id_buku' LIMIT 1";
$buku_result = mysqli_query($conn, $buku_check_query);

if (!$buku_result) {
    echo "Error dalam menjalankan kueri: " . mysqli_error($conn);
    exit;
}

$buku = mysqli_fetch_assoc($buku_result);

if (!$buku) {
    echo "ID Buku tidak valid.";
    exit;
}

if ($buku['status'] == $status_ready) {
    // Insert data peminjaman dan update status buku
    $query = "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam, tanggal_kembali, status) 
              VALUES ('$id_user', '$id_buku', '$tanggal_pinjam', '$tanggal_kembali', '$status_dipinjam')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update status buku menjadi Dipinjam
        $update_query = "UPDATE buku SET status = '$status_dipinjam' WHERE id_buku = '$id_buku'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            echo "<script> 
                    alert('Buku berhasil dipinjam');
                    document.location.href = 'index.php';
                </script>";
        } else {
            echo "Gagal memperbarui status buku.";
            echo mysqli_error($conn); // Tambahkan untuk debug
        }
    } else {
        echo "Gagal meminjam buku.";
        echo mysqli_error($conn); // Tambahkan untuk debug
    }
} else {
    echo "Buku sedang dipinjam.";
}
?>
