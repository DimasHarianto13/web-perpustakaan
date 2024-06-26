<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'koneksi.php';

$id = $_GET["id_buku"];
$buku = query("SELECT * FROM buku WHERE id_buku = $id")[0];

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index_admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'index_admin.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Pengupdatean Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2>Update Data</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">
        <input type="hidden" name="gambarLama" value="<?= $buku['gambar']; ?>">
        <div class="form-group">
            <label>Nama Buku:</label>
            <input type="text" name="nama_buku" class="form-control" placeholder="Masukan nama buku" required value="<?= $buku["nama_buku"]; ?>">
        </div>
        <div class="form-group">
            <label>Kategori:</label>
            <input type="text" name="kategori" class="form-control" placeholder="Masukan nama kategori" required value="<?= $buku["kategori"]; ?>">
        </div>
        <div class="form-group">
            <label>Pengarang:</label>
            <input type="text" name="pengarang" class="form-control" placeholder="Masukan nama pengarang" required value="<?= $buku["pengarang"]; ?>">
        </div>
        <div class="form-group">
            <label>Penerbit:</label>
            <input type="text" name="penerbit" class="form-control" placeholder="Masukan nama penerbit" required value="<?= $buku["penerbit"]; ?>">
        </div>
        <div class="form-group">
            <label>Tahun Terbit:</label>
            <input type="text" name="thn_terbit" class="form-control" placeholder="Masukan tahun terbit" required value="<?= $buku["thn_terbit"]; ?>">
        </div>
        <div class="form-group">
            <label for="gambar">Gambar</label><br>
            <img src="img/<?= $buku["gambar"]; ?>" width="40"><br>
            <input type="file" name="gambar" id="gambar">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
