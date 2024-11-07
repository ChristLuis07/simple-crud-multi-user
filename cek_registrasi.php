<?php
session_start();
require "koneksi/koneksi.php";

// Cek apakah data form telah di-submit
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['level'])) {
    // Ambil data dari form
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $level = mysqli_real_escape_string($koneksi, $_POST['level']);

    // Cek apakah username atau email sudah ada di database
    $query_check = "SELECT * FROM tuser WHERE username = '$username' OR email = '$email'";
    $result_check = mysqli_query($koneksi, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Jika username atau email sudah ada
        $_SESSION['register_error'] = "Username atau Email sudah terdaftar!";
        header("Location: registrasi.php");
        exit();
    } else {
        // Masukkan data pengguna baru ke dalam tabel
        $query_insert = "INSERT INTO tuser (username, email, password, level) VALUES ('$username', '$email', '$password', '$level')";
        $result_insert = mysqli_query($koneksi, $query_insert);

        if ($result_insert) {
            $_SESSION['register_success'] = "Registrasi Berhasil! Anda dapat login sekarang.";
            header("Location: registrasi.php");
            exit();
        } else {
            $_SESSION['register_error'] = "Terjadi kesalahan saat menyimpan data!";
            header("Location: registrasi.php");
            exit();
        }
    }
}
?>
