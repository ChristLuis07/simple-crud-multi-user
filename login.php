<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login MultiUser</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/dist/css/bootstrap.min.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="assets/dist/css/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" method="POST" action="cek_login.php">
      <div class="text-center mb-4">
        <img class="mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Login Form</h1>
        <p>Masukkan Username dan Password Anda dengan benar!</p>
      </div>

      <div class="form-label-group">
        <input type="text" name="username" class="form-control" placeholder="Masukkan Username Anda!" required autofocus>
        <label>Masukkan Username Anda!</label>
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

      <div class="checkbox mb-3">
        <label class="me-5">
          <input type="checkbox"  name="remember-me" value="1"> Remember me |
        </label>
        <label>
          <p class="ms-5">Belum punya akun? <a href="registrasi.php">Daftar di sini</a></p>
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; ChristianLuis 2024-<?= date('Y')?></p>
    </form>

    <!-- SweetAlert JS -->
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tampilkan pesan SweetAlert jika login gagal -->
    <?php
    if (isset($_SESSION['login_error'])) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: '" . $_SESSION['login_error'] . "',
                    confirmButtonText: 'Coba Lagi'
                });
              </script>";
        unset($_SESSION['login_error']);
    }
    ?>

    <!-- Tampilkan pesan SweetAlert jika ada -->
<?php
if (isset($_SESSION['logout_success'])) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '" . $_SESSION['logout_success'] . "',
                confirmButtonText: 'OK'
            });
          </script>";
    unset($_SESSION['logout_success']); // Hapus pesan setelah ditampilkan
}
?>

  </body>
</html>
