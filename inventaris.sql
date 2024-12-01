-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2024 pada 08.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `id` int(5) NOT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `kode_aset` varchar(100) NOT NULL,
  `nama_aset` varchar(250) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `tanggal_perolehan` date DEFAULT NULL,
  `nilai_ekonomis` int(10) DEFAULT NULL,
  `nilai_residu` int(10) DEFAULT NULL,
  `umur_ekonomis` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`id`, `gambar`, `kode_aset`, `nama_aset`, `stok`, `id_kategori`, `tanggal_perolehan`, `nilai_ekonomis`, `nilai_residu`, `umur_ekonomis`) VALUES
(38, 'gambar_20241130_204041.png', 'INV-123', 'Kursi Gaming', 21, 2, '2024-11-05', 8000000, 1000000, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Furniture', '2024-11-17 16:37:23', '2024-11-24 15:38:59'),
(2, 'Elektronik', '2024-11-17 19:42:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rfid`
--

CREATE TABLE `rfid` (
  `no_aset` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rfid`
--

INSERT INTO `rfid` (`no_aset`) VALUES
('');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pengadaan`
--

CREATE TABLE `riwayat_pengadaan` (
  `id_riwayat_pengadaan` int(5) NOT NULL,
  `kode_aset` varchar(100) NOT NULL,
  `stok` int(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `role`, `username`, `password`) VALUES
(7, 'Ahmad Sanosi', 'Pimpinan', 'sanosi', '123'),
(8, 'Afwa Fitrasya Muaja', 'Admin', 'afwa', '123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id`,`kode_aset`),
  ADD UNIQUE KEY `kode_aset_unique` (`kode_aset`),
  ADD KEY `aset_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `riwayat_pengadaan`
--
ALTER TABLE `riwayat_pengadaan`
  ADD PRIMARY KEY (`id_riwayat_pengadaan`),
  ADD KEY `fk_riwayat_pengadaan_kode_aset` (`kode_aset`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aset`
--
ALTER TABLE `aset`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pengadaan`
--
ALTER TABLE `riwayat_pengadaan`
  MODIFY `id_riwayat_pengadaan` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD CONSTRAINT `aset_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_pengadaan`
--
ALTER TABLE `riwayat_pengadaan`
  ADD CONSTRAINT `fk_riwayat_pengadaan_kode_aset` FOREIGN KEY (`kode_aset`) REFERENCES `aset` (`kode_aset`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
