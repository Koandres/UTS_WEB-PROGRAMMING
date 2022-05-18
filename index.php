<!-- Panggil file koneksi, karena kita membutuhkan nya -->
<?php
include "koneksi.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->

    <title>Stok Barang</title>
</head>

<body>
    <!-- Modal Tambah -->
    <div class="modal fade" id="modaltambahdata" tabindex="-1" aria-labelledby="modaltambahdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltambahdataLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="tambah.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="tambahKategori" class="form-label">Kategori Barang</label>
                            <input type="text" class="form-control" id="tambahKategori" name="kategori" placeholder="Kategori Barang">
                        </div>
                        <div class="mb-3">
                            <label for="tambahNama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="tambahNama" name="nama" placeholder="Nama Barang">
                        </div>
                        <div class="mb-3">
                            <label for="tambahJumlah" class="form-label">Jumlah Barang</label>
                            <input type="text" class="form-control" id="tambahJumlah" name="jumlah" placeholder="Jumlah Barang">
                        </div>
                        <input name="rekam" type="submit" class="btn btn-primary" value="Tambah">
                        <a href="index.php" type="button" class="btn btn-info text-white">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ubah -->
    <div class="modal fade" id="modalubahdata" tabindex="-1" aria-labelledby="modalubahdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltambahdataLabel">Ubah Barang</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="tambah.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="tambahKategori" class="form-label">Kategori Barang</label>
                            <input type="text" class="form-control" id="tambahKategori" name="kategori" placeholder="Kategori Barang">
                        </div>
                        <div class="mb-3">
                            <label for="tambahNama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="tambahNama" name="nama" placeholder="Nama Barang">
                        </div>
                        <div class="mb-3">
                            <label for="tambahJumlah" class="form-label">Jumlah Barang</label>
                            <input type="text" class="form-control" id="tambahJumlah" name="jumlah" placeholder="Jumlah Barang">
                        </div>
                        <input name="rekam" type="submit" class="btn btn-primary" value="Tambah">
                        <a href="index.php" type="button" class="btn btn-info text-white">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                <h3 class="text-center fw-bold text-uppercase">DATA STOK BARANG</h3>
                <hr>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaltambahdata">
                    Tambah Data
                </button>
                <div class="row my-3">
                    <div class="col-md">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Karegori Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah Barang</th>
                                    <th scope="col">Ubah | Hapus</th>
                            </thead>
                    </div>
                </div>
                <?php
                // variable no digunakan untuk meng-increments field no pada table. Karena nanti kita akan melooping data hasil query select kita. 
                $no = 1;
                // Simpan query kita kedalam variable agar lebih rapi, dan bisa reusable.
                // Arti dari query di bawah adalah pilih semua data dari table tb_siswa.
                $query = "SELECT * FROM barang";
                // Eksekusi Query
                // Simpan hasil eksekusi query kita ke dalam variable. Di sini variable nya saya kasih nama result.
                $result = mysqli_query($koneksi, $query);
                // Done. Waktunya Looping
                ?>
                <tbody>
                    <?php
                    foreach ($result as $data) {
                        echo "
                <tr>
                  <td>" . $data["kategori"] . "</td>
                  <td>" . $data["nama"] . "</td>
                  <td>" . $data["jumlah"] . "</td>
                  <td> 

                    <a href='ubah.php?id=" . $data["id"] . "' type='button' class='btn btn-success' data-bs-toogle='modal' data-bs-target='modalubahdata'>Ubah</a>
                    <a href='hapus.php?id=" . $data["id"] . "' type='button' class='btn btn-danger' onlick='return confirm('Yakin ingin menghapus data?')'>Hapus</a>
                    
                    
                  </td>
                </tr>  
              ";
                    }
                    ?>
                </tbody>
                </table>
            </div>


            <!-- Footer -->
            <footer class="col-12">
                <div class="text-center">Copyright &copy; Koandres 2022</div>
            </footer>
            <!-- Close Footer -->
            <!-- Bootstrap -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>