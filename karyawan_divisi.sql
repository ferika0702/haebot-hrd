-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Mar 2023 pada 03.00
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haebot`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_divisi`
--

CREATE TABLE `karyawan_divisi` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_divisi` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `id_karyawan` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan_divisi`
--

INSERT INTO `karyawan_divisi` (`id`, `id_divisi`, `id_karyawan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 5, 14, NULL, NULL, NULL),
(8, 6, 5, NULL, NULL, NULL),
(15, 6, 13, NULL, NULL, NULL),
(17, 5, 13, NULL, NULL, NULL),
(18, 5, 5, NULL, NULL, NULL),
(23, 2, 2, NULL, NULL, NULL),
(28, 7, 13, NULL, NULL, NULL),
(29, 7, 16, NULL, NULL, NULL),
(30, 7, 14, NULL, NULL, NULL),
(31, 1, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `karyawan_divisi`
--
ALTER TABLE `karyawan_divisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_divisi` (`id_divisi`) USING BTREE,
  ADD KEY `id_karyawan` (`id_karyawan`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `karyawan_divisi`
--
ALTER TABLE `karyawan_divisi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `karyawan_divisi`
--
ALTER TABLE `karyawan_divisi`
  ADD CONSTRAINT `fk_divisi` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
