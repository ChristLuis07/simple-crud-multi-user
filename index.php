<?php
require "koneksi/koneksi.php";
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Cek level pengguna
$is_admin = $_SESSION['level'] === 'Administrator';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD DAFTAR</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    <!-- SweetAlert CSS  -->
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <div class="container-fluid">
        <a class="navbar-brand fs-3 me-5" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" 
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-5">
            <a class="nav-link fs-4 text-lights ms-5" aria-current="page" href="index.php">Home</a>
            <a class="nav-link fs-4 text-lights ms-5" href="">Features</a>
            <a class="nav-link fs-4 text-lights ms-5" href="#">Pricing</a>
            <?php if ($is_admin) { ?>
            <a class="nav-link fs-4 text-lights ms-5" href="tambah/tambah.php" tabindex="-1">Tambah Data</a>
            <?php } ?>
          </div>
        </div>
         <a href="#" class="btn btn-danger ms-3" onclick="confirmLogout()">Logout</a> <!-- Tombol Logout -->
      </div>
      <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary me-3" type="submit">Search</button>
      </form>
    </nav>
    <!-- Navbar End -->

    <?php require "digitalClock/index.php" ?>
    
    <!-- Content Start -->
    <h1 class="text-center pt-5 pb-0">DAFTAR PRODUK</h1>
    <p class="text-center">
        <?php if ($is_admin) { ?>
        <button class="btn btn-success mt-1 mb-5">
            <a href="tambah/tambah.php" class="text-center text-decoration-none text-white">Tambah Produk</a>
        </button>
        <?php } ?>
    </p>
    <div class="container">
        <div class="row">
            <?php
            // Query untuk menampilkan data
            $query = "SELECT * FROM produk ORDER BY id ASC";
            $result = mysqli_query($koneksi, $query);

            // Cek apakah query berhasil
            if (!$result) {
                die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

            // Looping data produk
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-12 col-md-4 mb-4">
                <div class="card">
                    <img src="assets/<?php echo htmlspecialchars($row['gambar_produk']); ?>" alt="Gambar Produk" class="card-img-top img-fluid">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['nama_produk']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars(substr($row['deskripsi'], 0, 100)); ?>...</p>
                        <p class="card-text">Harga Beli: Rp <?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></p>
                        <p class="card-text">Harga Jual: Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></p>
                        <?php if ($is_admin) { ?>
                        <div class="aksi">
                            <button type="button" class="btn btn-primary">
                                <a href="edit/edit.php?id=<?php echo $row['id']; ?>" class="text-white text-decoration-none">EDIT</a>
                            </button>
                            <button class="btn btn-danger">
                                <a href="javascript:void(0);" class="text-white text-decoration-none" onclick="confirmDelete(<?php echo $row['id']; ?>)">Hapus</a>
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- Content End -->

    <!-- SweetAlert AND My JS -->
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="js/sweetAlertHapus.js"></script>

    <!-- Tampilkan pesan SweetAlert jika ada -->

          
    <script>
      function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, keluar!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'logout.php'; // Arahkan ke logout.php jika konfirmasi
            }
        });
    }
</script>  

    <?php
    if (isset($_SESSION['message'])) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '" . $_SESSION['message'] . "',
                    confirmButtonText: 'OK'
                });
              </script>";
        unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
    }
    ?>




    <!-- Bootstrap Script -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
