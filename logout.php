<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Menghancurkan sesi

// Menyimpan pesan sukses untuk ditampilkan
$_SESSION['logout_success'] = "Anda telah berhasil keluar!";


// Redirect kembali ke halaman login
header("Location: login.php");
exit();
?>
