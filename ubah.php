<?php
include "koneksi.php";
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>PEREKAMAN DATA KENDARAAN| CRUD</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">STOK BARANG</a>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container" style="background-color: #e3f2fd;">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase"><i class="bi bi-pencil-square"></i>&nbsp;Ubah Data </h3>
            </div>
            <hr>
        </div>

        <body>

            <?php

            // Ambil data dari patameter url browser
            $id = $_GET['id'];

            // Query ambil data dari param jika ada.
            $query = "SELECT * FROM barang WHERE id = $id";
            // Hasil Query
            $result = mysqli_query($koneksi, $query);
            foreach ($result as $data) {
            ?>

                <section class="row">
                    <div class="col-md-6 offset-md-3 align-self-center">
                        <h1 class="text-center mt-4">Perbarui Data</h1><br>
                        <form method="POST">
                            <!-- Inputan tersembunyi untuk menyimpan data id yang digunakan untuk mengupdate data, lebih aman di banding menggunakan id dari params -->
                            <input type="hidden" value="<?= $data['id'] ?>" name="id">
                            <div class="mb-3">
                                <label for="tambahKategori" class="form-label">Kategori Barang</label>
                                <input type="text" class="form-control" id="tambahKategori" value="<?= $data['kategori'] ?>" name="kategori" placeholder="Kategori Barang">
                            </div>
                            <div class="mb-3">
                                <label for="tambahBarang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="tambahBarang" value="<?= $data['nama'] ?>" name="nama" placeholder="Nama Barang">
                            </div>
                            <div class="mb-3">
                                <label for="tambahBarang" class="form-label">Jumlah Barang</label>
                                <input type="text" class="form-control" id="tambahBarang" value="<?= $data['jumlah'] ?>" name="jumlah" placeholder="Jumlah Barang">
                            </div>
                            <input name="rekam" type="submit" class="btn btn-primary" value="Ubah">
                            <a href="index.php" type="button" class="btn btn-info text-white">Batal</a>
                        </form>
                    </div>
                </section>

            <?php } ?>

            <?php

            // Buat kondisi jika tombol data di klik
            if (isset($_POST['rekam'])) {
                // Membuat variable setiap field inputan agar kodingan lebih rapi.
                $id = $_POST['id'];
                $kategori = $_POST['kategori'];
                $nama = $_POST['nama'];
                $jumlah = $_POST['jumlah'];

                // Membuat Query
                $query = "UPDATE barang SET kategori = '$kategori', nama = '$nama', jumlah = '$jumlah' WHERE id = '$id'";

                $result = mysqli_query($koneksi, $query);

                if ($result) {
                    header("location: index.php");
                } else {
                    echo "<script>alert('Data Gagal di update!')</script>";
                }
            }

            ?>
            <!-- Footer -->
            <footer class="col-12">
                <div class="text-center">Copyright &copy; Koandres 2022</div>
            </footer>
            <!-- Close Footer -->
            <!-- Bootstrap -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


        </body>

        </html>