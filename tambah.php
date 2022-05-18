<?php
include "koneksi.php";
?>

<?php

// Buat kondisi jika tombol data di klik
if (isset($_POST['rekam'])) {
    // Membuat variable setiap field inputan agar kodingan lebih rapi.
    $kategori = $_POST['kategori'];
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];

    // Membuat Query
    $query = "INSERT INTO barang (kategori, nama, jumlah) VALUES('" . $kategori . "', '" . $nama . "', '" . $jumlah . "')";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("location: index.php");
    } else {
        echo "<script>alert('Data Gagal di tambahkan!')</script>";
    }
}

?>
