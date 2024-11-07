<?php
require "../koneksi/koneksi.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi data sebelum memasukkan ke dalam database
    $nama_produk = trim($_POST['nama_produk']);
    $deskripsi = trim($_POST['deskripsi']);
    $harga_beli = trim($_POST['harga_beli']);
    $harga_jual = trim($_POST['harga_jual']);
    $gambar_produk = $_FILES['gambar_produk']['name'];

    // Cek apakah semua field diisi
    if (empty($nama_produk) || empty($deskripsi) || empty($harga_beli) || empty($harga_jual) || empty($gambar_produk)) {
        $_SESSION['message'] = "Semua field harus diisi!";
        header("Location: tambah.php");
        exit();
    }

    $target_dir = "../assets/";
    $target_file = $target_dir . basename($gambar_produk);
    
    // Upload gambar
    if (move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file)) {
        // Query untuk menambah produk
        $query = "INSERT INTO produk (nama_produk, deskripsi, harga_beli, harga_jual, gambar_produk) 
                  VALUES ('$nama_produk', '$deskripsi', '$harga_beli', '$harga_jual', '$gambar_produk')";
        
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['message'] = "Produk berhasil ditambahkan!";
            header("Location: ../index.php"); // Kembali ke halaman daftar produk
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        $_SESSION['message'] = "Gagal mengupload gambar!";
        header("Location: tambah.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/index.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
        #imgPreview {
            width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand fs-3 me-5" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-5">
        <a class="nav-link fs-4 text-lights ms-5" aria-current="page" href="../index.php">Home</a>
        <a class="nav-link fs-4 text-lights ms-5" href="">Features</a>
        <a class="nav-link fs-4 text-lights ms-5" href="#">Pricing</a>
        <a class="nav-link fs-4 text-lights ms-5" href="tambah.php" tabindex="-1" aria-disabled="true">Tambah Data</a>
      </div>
    </div>
  </div>
  <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary me-3" type="submit">Search</button>
      </form>
</nav>
    <!-- Navbar End -->
     <?php require "../digitalClock/index.php" ?>
    <!-- Content Start -->
    <div class="container">
        <div class="card p-4">
            <h1 class="text-center">Tambah Produk</h1>
            <form id="tambahForm" action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                </div>
                <div class="mb-3">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                </div>
                <div class="mb-3">
                    <label for="gambar_produk" class="form-label">Gambar Produk</label>
                    <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" accept="image/*" required onchange="previewImage(event)">
                    <img id="imgPreview" src="#" alt="Preview Gambar" style="display:none;">
                </div>
                <button type="button" class="btn btn-success" onclick="confirmTambah()">Tambah Produk</button>
                <a href="../index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
    <!-- Content End -->
    
    <!-- SweetAlert AND Preview Gambar -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script>
        function previewImage(event) {
            const imgPreview = document.getElementById('imgPreview');
            imgPreview.src = URL.createObjectURL(event.target.files[0]);
            imgPreview.style.display = 'block';
        }

        function confirmTambah() {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menambah produk ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tambahkan!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('tambahForm').submit();
                }
            });
        }
    </script>

    <?php 
      if (isset($_SESSION['message'])) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '" . $_SESSION['message'] . "',
                    confirmButtonText: 'OK'
                });
              </script>";
        unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
    }
    

    ?>

    <!-- Bootstrap Script -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
