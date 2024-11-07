<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register User</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <style>
        /* CSS Anda disini */
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/dist/css/floating-labels.css" rel="stylesheet">
</head>
<body>
<form class="form-signin" method="POST" action="cek_registrasi.php">
    <div class="text-center mb-4">
        <img class="mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Form Registrasi</h1>
        <p>Silahkan isi data untuk registrasi akun baru.</p>
    </div>

    <div class="form-label-group">
        <input type="text" name="username" class="form-control" placeholder="Masukkan Username Anda" required autofocus>
        <label>Masukkan Username Anda</label>
    </div>

    <div class="form-label-group">
        <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
        <label>Masukkan Email Anda</label>
    </div>

    <div class="form-label-group">
        <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda" required>
        <label>Masukkan Password Anda</label>
    </div>

    <div class="form-label-group">
        <select class="form-control" name="level" required>
            <option value="" disabled selected>Pilih Level</option>
            <option value="User">User</option>
            <option value="Administrator">Administrator</option>
        </select>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; ChristianLuis 2024-<?= date('Y') ?></p>
</form>

<!-- SweetAlert JS -->
<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>

<!-- Tampilkan pesan SweetAlert jika ada -->
<?php
if (isset($_SESSION['register_error'])) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Registrasi Gagal',
                text: '" . $_SESSION['register_error'] . "',
                confirmButtonText: 'Coba Lagi'
            });
          </script>";
    unset($_SESSION['register_error']);
}

if (isset($_SESSION['register_success'])) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: '" . $_SESSION['register_success'] . "',
                confirmButtonText: 'Login Sekarang'
            }).then(function() {
                window.location = 'login.php';
            });
          </script>";
    unset($_SESSION['register_success']);
}
?>

</body>
</html>
