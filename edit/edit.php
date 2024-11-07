<?php
require "../koneksi/koneksi.php";
session_start(); // Memastikan session aktif

// Cek apakah ID produk ada
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data produk berdasarkan ID
    $query = "SELECT * FROM produk WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil
    if (!$result) {
        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }

    // Ambil data produk
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: ../index.php"); // Jika tidak ada ID, redirect ke daftar produk
    exit;
}

// Proses edit jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    // Proses upload gambar jika ada
    $gambar_produk = $_FILES['gambar_produk']['name'];
    if ($gambar_produk) {
        $target_dir = "../assets/";
        $target_file = $target_dir . basename($gambar_produk);
        move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file);
        // Update query dengan gambar baru
        $query = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga_beli='$harga_beli', harga_jual='$harga_jual', gambar_produk='$gambar_produk' WHERE id='$id'";
    } else {
        // Update query tanpa mengubah gambar
        $query = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE id='$id'";
    }

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['message'] = "Produk berhasil diperbarui!";
        header("Location: ../index.php"); // Redirect setelah sukses
        exit;
    } else {
        $_SESSION['message'] = "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Produk</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
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
        <a class="nav-link fs-4 text-lights ms-5" aria-current="page" href="index.php">Home</a>
        <a class="nav-link fs-4 text-lights ms-5" href="">Features</a>
        <a class="nav-link fs-4 text-lights ms-5" href="#">Pricing</a>
        <a class="nav-link fs-4 text-lights ms-5" href="../tambah/tambah.php" tabindex="-1" aria-disabled="true">Tambah Data</a>
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

    <div class="container mt-5">
        <h2>Edit Produk</h2>
        <form id="editForm" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $row['nama_produk']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="harga_beli" class="form-label">Harga Beli</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo $row['harga_beli']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_jual" class="form-label">Harga Jual</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?php echo $row['harga_jual']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="gambar_produk" class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" id="gambar_produk" name="gambar_produk">
                <small>Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>
            <button type="button" class="btn btn-success" onclick="confirmEdit()">Simpan Perubahan</button>
            <a href="../index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <!-- SweetAlert AND My JS -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script>
    function confirmEdit() {
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Anda yakin ingin menyimpan perubahan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editForm').submit(); // Kirim formulir jika dikonfirmasi
            }
        });
    }
    </script>

    <!-- Bootstrap Script -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
