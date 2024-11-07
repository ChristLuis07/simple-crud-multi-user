-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Okt 2024 pada 19.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_daftar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `gambar_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `harga_beli`, `harga_jual`, `gambar_produk`) VALUES
(9, 'kecap', 'dsafsdfa', 12341, 12314, '862-969-kecap.jpg'),
(12, 'kecap', 'asdfasdfa', 7000, 8000, 'kecap.jpg'),
(13, 'saos', 'asdfasdf', 123151, 1243152, 'kecap.jpg'),
(14, 'saos', 'asdfasdf', 1234134, 12531, 'kecap.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tuser`
--

CREATE TABLE `tuser` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('User','Administrator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tuser`
--

INSERT INTO `tuser` (`id`, `username`, `email`, `password`, `level`) VALUES
(1, 'admin', 'admin123@gmail.com', '$2y$10$7RzWFi3f47T05eKt7e/YW.yP2jP72xiPqrXj3cmkIBliwIpUeUbZ2', 'Administrator'),
(2, 'user', 'user123@gmail.com', '$2y$10$3xTdm4sgVTj9eKChlUQ91.7vaLWxRIMwQ9Scj6wR5qrpS7tYRlS9O', 'User'),
(3, 'user123', '123@gmail.com', '$2y$10$1Fjk2N06ST9FGFTUVU356u.T6XTUmCOupR0lpSkplSV2xhyHL/jVe', 'User'),
(4, 'asd', 'asdfa@gmail.com', '$2y$10$IZVxasDUIRCwycsxM/tRDOehxGM40dhmjh6ufhHy1WyO3PPR45bmu', 'User'),
(5, 'admin2', 'christianluisginting@Gmail.com', '$2y$10$Nzzh7YO9bwSSPwI/VHefEeu/E5LwD5xHqX.me5SUQcdaLVBs1gYXC', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
