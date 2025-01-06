-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jan 2025 pada 15.31
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
-- Database: `helios_tracker`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `kode_perangkat` varchar(255) DEFAULT NULL,
  `status_servo` varchar(50) DEFAULT NULL,
  `status_esp32` varchar(50) DEFAULT NULL,
  `cuaca` varchar(50) DEFAULT NULL,
  `suhu` varchar(50) DEFAULT NULL,
  `lokasi_perangkat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`id_alat`, `id_user`, `kode_perangkat`, `status_servo`, `status_esp32`, `cuaca`, `suhu`, `lokasi_perangkat`) VALUES
(6, 2, '12345', 'Hidup', 'Hidup', 'Sebagian Berawan', '18.2', '{\"Latitude\":-6.991865,\"Longitude\":107.5576583}'),
(10, 1, '3434343413', NULL, NULL, 'Partly Cloudy', '21.3', '{\"Latitude\": -6.936199031805925, \"Longitude\": 107.72469741177119}'),
(21, 2, '12345678', NULL, NULL, 'Tidak Diketahui', '23.5', '{\"Latitude\":-6.991865,\"Longitude\":107.5576583}'),
(22, 2, '87654321', NULL, NULL, 'Sebagian Berawan', '19.8', '{\"Latitude\":-6.991865,\"Longitude\":107.5576583}'),
(23, 2, '3432323', NULL, NULL, 'Sebagian Berawan', '19.8', '{\"Latitude\":-6.991865,\"Longitude\":107.5576583}'),
(24, 2, '643545', NULL, NULL, 'Sebagian Berawan', '19.8', '{\"Latitude\":-6.991865,\"Longitude\":107.5576583}'),
(25, 2, '3452342353', NULL, NULL, NULL, NULL, '{\"Latitude\":-6.991865,\"Longitude\":107.5576583}'),
(26, 2, '532435234', NULL, NULL, 'Sebagian Berawan', '19.8', '{\"Latitude\":-6.991865,\"Longitude\":107.5576583}'),
(27, 7, '12323', 'hidup', 'hidupsdfsd', 'koson', '20', '{\"Latitude\":-6.991865,\"Longitude\":107.5576583}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `kode_perangkat` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `devices`
--

INSERT INTO `devices` (`id`, `kode_perangkat`, `status`) VALUES
(1, '1', 'active'),
(2, '3297', 'inactive'),
(3, '4763', 'Tidak Aktif'),
(4, '7048', 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `monitoring_energi`
--

CREATE TABLE `monitoring_energi` (
  `id_energi` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `ampere` varchar(50) DEFAULT '0',
  `volt` varchar(50) DEFAULT '0',
  `battery` varchar(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `monitoring_energi`
--

INSERT INTO `monitoring_energi` (`id_energi`, `id_alat`, `ampere`, `volt`, `battery`) VALUES
(3, 6, '0.30', '3.76', '84'),
(15, 21, '1', '1', '1'),
(16, 22, '0', '0', '0'),
(17, 23, NULL, NULL, NULL),
(18, 24, NULL, NULL, NULL),
(19, 25, NULL, NULL, NULL),
(20, 26, '0', '0', '0'),
(21, 27, '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `monitor_solar`
--

CREATE TABLE `monitor_solar` (
  `id_monitoring` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `posisi_x` varchar(50) DEFAULT '0',
  `posisi_y` varchar(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `monitor_solar`
--

INSERT INTO `monitor_solar` (`id_monitoring`, `id_alat`, `posisi_x`, `posisi_y`) VALUES
(1, 6, '12', '15'),
(11, 21, '1', '1'),
(12, 22, '0', '0'),
(13, 23, NULL, NULL),
(14, 24, NULL, NULL),
(15, 25, NULL, NULL),
(16, 26, '0', '0'),
(17, 27, '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `foto_profil` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `no_hp`, `password`, `role`, `foto_profil`, `token`, `otp_expiry`, `create_at`) VALUES
(1, 'sdsdsdsd', 'johndoe@example.com', '08123456789012', '$2y$10$Wb0thr2uur0LD0xj9IM2fujw7a1tBzDVuX/oDBzrxL33vilyEW2oW', 'admin', '/image/foto_profile/default_profile.png', NULL, NULL, '2024-12-26 06:15:31'),
(2, 'fahmi', 'fahminursafaat@gmail.com', '085162608048', '$2y$10$JRy9uvNKYQG.BQ.3AMEfDODMamsUhG9eGOJtE.WTyms/oRLkU4YNm', 'admin', '/image/foto_profile/default_profile.png', '892749', '2024-12-29 20:34:57', '2024-12-26 07:22:44'),
(6, 'admin', 'admin@gmail.com', '213123123123123', '$2y$10$0EZxgsR7UxxUfEb8pbewXO5ueGuiQsgN/6AbdxGo4Z4giy1zHi6tK', 'admin', '/image/foto_profile/default_profile.png', NULL, NULL, '2025-01-05 11:20:51'),
(7, 'jane8', 'jane@example.com', '1', '$2y$10$mHmDLUxj15upQK7AnRC3CeaahQG.9C2KRECK/Kex5ctVyCfLDjZ6C', 'user', '/image/foto_profile/1736097594_Logo Helios Tracker (1).png', NULL, NULL, '2025-01-05 11:46:59'),
(8, 'sdfsdsdfsdf', 'jane2@example.com', '3424234', '$2y$10$JNfCzxtiU48o62QOdvCiquY1tJvproyjO3vKmbTO384TVfKeCiIRy', 'user', '/image/foto_profile/default_profile.png', NULL, NULL, '2025-01-05 12:42:41'),
(9, 'makanan', 'jane2@examp1le.com', '2112344234', '$2y$10$sBh5252shTUHCU0Zh2D6wu4ramhoZCOBhc6KpD9gu/rYThKy7z60a', 'user', '/image/foto_profile/default_profile.png', NULL, NULL, '2025-01-05 16:51:36'),
(10, 'makanan', 'makanan@gmail.com', '23223232323', '$2y$10$iTo1hneYLBPr8Ds8j42rauo4U0DPaYHsm2On0bLf6JZhxIQESS9Qy', 'user', '/image/foto_profile/default_profile.png', NULL, NULL, '2025-01-05 18:26:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`),
  ADD UNIQUE KEY `unique_kode_perangkat` (`kode_perangkat`),
  ADD KEY `fk_alat_user` (`id_user`);

--
-- Indeks untuk tabel `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `monitoring_energi`
--
ALTER TABLE `monitoring_energi`
  ADD PRIMARY KEY (`id_energi`),
  ADD KEY `fk_monitoring_energi_alat` (`id_alat`);

--
-- Indeks untuk tabel `monitor_solar`
--
ALTER TABLE `monitor_solar`
  ADD PRIMARY KEY (`id_monitoring`),
  ADD KEY `fk_monitor_solar_alat` (`id_alat`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `no_hp` (`no_hp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `monitoring_energi`
--
ALTER TABLE `monitoring_energi`
  MODIFY `id_energi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `monitor_solar`
--
ALTER TABLE `monitor_solar`
  MODIFY `id_monitoring` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `fk_alat_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `monitoring_energi`
--
ALTER TABLE `monitoring_energi`
  ADD CONSTRAINT `fk_monitoring_energi_alat` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `monitor_solar`
--
ALTER TABLE `monitor_solar`
  ADD CONSTRAINT `fk_monitor_solar_alat` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
