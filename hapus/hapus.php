<?php
session_start(); // Memulai session
require "../koneksi/koneksi.php"; // Pastikan ini sesuai dengan struktur folder Anda

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $query = "DELETE FROM produk WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Menyimpan pesan sukses di session
        $_SESSION['message'] = 'Data berhasil dihapus';
        header("Location: ../index.php?status=success");
    } else {
        // Menyimpan pesan error di session
        $_SESSION['message'] = 'Gagal menghapus data';
        header("Location: ../index.php?status=error");
    }
} else {
    // Menyimpan pesan error di session
    $_SESSION['message'] = 'ID tidak ditemukan';
    header("Location: ../index.php?status=error");
}
?>
