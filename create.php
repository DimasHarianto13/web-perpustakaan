<?php

session_start();
if(!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'koneksi.php';

    if(isset($_POST["submit"])) {

        if(tambah ($_POST) > 0) {
            echo "
                <script> 
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'index_admin.php';
                </script>
            ";            
        } else {
            echo "
                <script> 
                    alert('data gagal ditambahkan!');
                    document.location.href = 'index_admin.php';
                </script> 
            ";
    }
}
      
?>


<!DOCTYPE html>
<html>
<head>
    <title>Form penambahan buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container"> 
    <h2>Input Data</h2>


    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Buku:</label>
            <input type="text" name="nama_buku" class="form-control" placeholder="Masukan nama buku" required />
        </div>
        <div class="form-group">
            <label>Kategori:</label>
            <input type="text" name="kategori" class="form-control" placeholder="Masukan nama kategori" required/>
        </div>
       <div class="form-group">
            <label>Pengarang :</label>
            <input type="text" name="pengarang" class="form-control" placeholder="Masukan nama pengarang" required/>
        </div>
        <div class="form-group">
            <label>Penerbit:</label>
            <input type="text" name="penerbit" class="form-control" placeholder="Masukan nama penerbit" required/>
        </div>
        <div class="form-group">
            <label>Tahun Terbit:</label>
            <input type="text" name="thn_terbit" class="form-control" placeholder="Masukan tahun terbit" required/>
        </div>  
        <div class="form-group">
            <label for="gambar">Gambar</label><br>
            <img src="img/<?= $buku["gambar"]; ?>" width="40"><br>
            <input type="file" name="gambar" id="gambar">
        </div>     

        <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
    </form>
</div>
</body>
</html>