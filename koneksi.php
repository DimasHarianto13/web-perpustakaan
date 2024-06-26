<?php

$conn = mysqli_connect("localhost", "root", "", "perpustakaan_db");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;

    $nama_buku = htmlspecialchars($data["nama_buku"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $thn_terbit = htmlspecialchars($data["thn_terbit"]);
    $status = htmlspecialchars($data["status"]);
    
    $gambar = upload();
    if(!$gambar){
        return false;
    }

    $query = "INSERT INTO buku VALUES ('', '$nama_buku', '$kategori', '$pengarang', '$penerbit','$thn_terbit', '$gambar','$status')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function registrasi($data) {
    global $conn;

    $first_name = strtolower(stripslashes($data["first_name"]));
    $last_name = strtolower(stripslashes($data["last_name"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
              </script>";
        return 0;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user ke database
    $query = "INSERT INTO user (first_name, last_name, email, password) VALUES('$first_name', '$last_name', '$email', '$password')";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id_buku) {
    global $conn;
    mysqli_query($conn, "DELETE FROM buku WHERE id_buku = $id_buku");

    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $id_buku = $data['id_buku'];
    $nama_buku = htmlspecialchars($data["nama_buku"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $thn_terbit = htmlspecialchars($data["thn_terbit"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE buku SET
                nama_buku = '$nama_buku',
                kategori = '$kategori',
                pengarang = '$pengarang',
                penerbit = '$penerbit',
                thn_terbit = '$thn_terbit',
                gambar = '$gambar'
              WHERE id_buku = $id_buku";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
              </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!!!');
              </script>";
        return false;
    }

    if ($ukuranFile > 10000000) {
        echo "<script>
                alert('Gambar anda terlalu besar!!');
              </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}
?>

              