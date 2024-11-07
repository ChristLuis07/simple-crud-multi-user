<?php
session_start();
require "koneksi/koneksi.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['level'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Prepared statement
    $stmt = $koneksi->prepare("SELECT * FROM tuser WHERE username = ? AND level = ?");
    $stmt->bind_param("ss", $username, $level);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {
        // Jika login sukses, simpan username dan level di session
        $_SESSION['username'] = $user['username'];
        $_SESSION['level'] = $user['level'];
        header("Location: index.php");
        exit;
    } else {
        // Jika login gagal, kirim kembali ke halaman login dengan pesan error
        $_SESSION['login_error'] = "Username, password, atau level salah!";
        header("Location: login.php");
        exit;
    }
} else {
    // Jika akses langsung ke cek_login.php
    header("Location: login.php");
    exit;
}
?>
