<?php 

session_start();
if(!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'koneksi.php';

$id = $_GET["id_buku"];

if(hapus($id) > 0) {

    echo "
        <script> 
        alert('data berhasil dihapus!');
        document.location.href = 'index_admin.php';
        </script>
        ";

} else {
    echo"
        <script> 
        alert('data gagal dihapus!');
        document.location.href = 'index_admin.php';
        </script>
        ";
}

?>