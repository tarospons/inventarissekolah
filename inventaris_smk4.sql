-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Nov 2026 pada 11.52
-- Versi server: 8.0.30
-- Versi PHP: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_smk4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guest',
  `action` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `role`, `action`, `description`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'MIGRATE_SEED', 'Database berhasil diinisialisasi dengan data autentik SMKN 4 Bojonegoro.', '127.0.0.1', 'Symfony', '2026-11-14 02:42:08', '2026-11-14 02:42:08'),
(2, 1, 'admin', 'LOGIN', 'Pengguna Pak Budi Santoso (admin) berhasil masuk ke sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:48:08', '2026-11-14 02:48:08'),
(3, 1, 'admin', 'VERIFIKASI_LAPORAN', 'Memverifikasi laporan LAP-2025-005 dengan status: Ditolak.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:53:02', '2026-11-14 02:53:02'),
(4, 1, 'admin', 'VERIFIKASI_LAPORAN', 'Memverifikasi laporan LAP-2025-005 dengan status: Ditolak.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:53:03', '2026-11-14 02:53:03'),
(5, 1, 'admin', 'MIGRATE_SEED', 'Database berhasil diinisialisasi.', '127.0.0.1', 'Symfony', '2026-11-14 02:56:02', '2026-11-14 02:56:02'),
(6, 1, 'admin', 'VERIFIKASI_LAPORAN', 'Memverifikasi laporan LAP-2025-004 dengan status: Ditolak.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:58:13', '2026-11-14 02:58:13'),
(7, 1, 'admin', 'VERIFIKASI_LAPORAN', 'Memverifikasi laporan LAP-2025-004 dengan status: Ditolak.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:58:15', '2026-11-14 02:58:15'),
(8, 1, 'admin', 'VERIFIKASI_LAPORAN', 'Memverifikasi laporan LAP-2025-004 dengan status: Ditolak.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:58:16', '2026-11-14 02:58:16'),
(9, 1, 'admin', 'VERIFIKASI_LAPORAN', 'Memverifikasi laporan LAP-2025-004 dengan status: Ditolak.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:58:17', '2026-11-14 02:58:17'),
(10, 1, 'admin', 'VERIFIKASI_LAPORAN', 'Memverifikasi laporan LAP-2025-004 dengan status: Ditolak.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:58:18', '2026-11-14 02:58:18'),
(11, 1, 'admin', 'VERIFIKASI_LAPORAN', 'Memverifikasi laporan LAP-2025-004 dengan status: Ditolak.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:58:19', '2026-11-14 02:58:19'),
(12, 1, 'admin', 'VERIFIKASI_LAPORAN', 'Memverifikasi laporan LAP-2025-004 dengan status: Ditolak.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-14 02:58:21', '2026-11-14 02:58:21'),
(13, 1, 'admin', 'LOGIN', 'Pengguna Admin (admin) berhasil masuk ke sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', '2026-11-14 03:03:20', '2026-11-14 03:03:20'),
(14, 1, 'admin', 'CREATE_PJ', 'Mendaftarkan Penanggung Jawab baru: Guru Penanggung Jawab Baru, S.T. (NIP. 19951230 202401 1 999).', '127.0.0.1', 'Symfony', '2026-11-14 03:19:44', '2026-11-14 03:19:44'),
(15, 1, 'admin', 'UPDATE_PJ', 'Memperbarui profil PJ: Guru Penanggung Jawab Baru (Updated), M.Kom..', '127.0.0.1', 'Symfony', '2026-11-14 03:19:45', '2026-11-14 03:19:45'),
(16, NULL, 'pj', 'UPDATE_PROFILE_PHOTO', 'Mengubah foto profil akun Guru Penanggung Jawab Baru (Updated), M.Kom..', '127.0.0.1', 'Symfony', '2026-11-14 03:19:45', '2026-11-14 03:19:45'),
(17, 1, 'admin', 'DELETE_PJ', 'Menghapus akun PJ: Guru Penanggung Jawab Baru (Updated), M.Kom..', '127.0.0.1', 'Symfony', '2026-11-14 03:19:45', '2026-11-14 03:19:45'),
(18, 1, 'admin', 'CREATE_PJ', 'Mendaftarkan Penanggung Jawab baru: Guru Penanggung Jawab Baru, S.T. (NIP. 19951230 202401 1 999).', '127.0.0.1', 'Symfony', '2026-11-14 03:20:25', '2026-11-14 03:20:25'),
(19, 1, 'admin', 'UPDATE_PJ', 'Memperbarui profil PJ: Guru Penanggung Jawab Baru (Updated), M.Kom..', '127.0.0.1', 'Symfony', '2026-11-14 03:20:25', '2026-11-14 03:20:25'),
(20, NULL, 'pj', 'UPDATE_PROFILE_PHOTO', 'Mengubah foto profil akun Guru Penanggung Jawab Baru (Updated), M.Kom..', '127.0.0.1', 'Symfony', '2026-11-14 03:20:25', '2026-11-14 03:20:25'),
(21, 1, 'admin', 'DELETE_PJ', 'Menghapus akun PJ: Guru Penanggung Jawab Baru (Updated), M.Kom..', '127.0.0.1', 'Symfony', '2026-11-14 03:20:25', '2026-11-14 03:20:25'),
(22, 1, 'admin', 'DELETE_BARANG', 'Menghapus barang: Kipas Angin Dinding KDK 16\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', '2026-11-14 04:14:49', '2026-11-14 04:14:49'),
(23, 1, 'admin', 'LOGIN', 'Pengguna Admin (admin) berhasil masuk ke sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:40:02', '2026-11-15 00:40:02'),
(24, 1, 'admin', 'UPDATE_BARANG', 'Memperbarui data barang: Meja & Kursi Siswa Standar Kemdikbud (BRG-KLS-001).', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:40:46', '2026-11-15 00:40:46'),
(25, 1, 'admin', 'DELETE_BARANG', 'Menghapus barang: Rak Buku Dua Sisi Besi 5 Tingkat.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:41:12', '2026-11-15 00:41:12'),
(26, 1, 'admin', 'DELETE_KATEGORI', 'Menghapus kategori: Elektronik & Media.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:44:51', '2026-11-15 00:44:51'),
(27, 1, 'admin', 'DELETE_KATEGORI', 'Menghapus kategori: Mesin & Bengkel.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:45:06', '2026-11-15 00:45:06'),
(28, 1, 'admin', 'LOGIN', 'Pengguna Admin (admin) berhasil masuk ke sistem.', '127.0.0.1', 'Symfony', '2026-11-15 00:46:12', '2026-11-15 00:46:12'),
(29, 2, 'kepsek', 'LOGIN', 'Pengguna Kepala Sekolah (kepsek) berhasil masuk ke sistem.', '127.0.0.1', 'Symfony', '2026-11-15 00:46:13', '2026-11-15 00:46:13'),
(30, 1, 'admin', 'UPDATE_PROFILE_PHOTO', 'Mengubah foto profil akun Admin.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:46:39', '2026-11-15 00:46:39'),
(31, 1, 'admin', 'UPDATE_PROFILE_PHOTO', 'Mengubah foto profil akun Admin.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:47:01', '2026-11-15 00:47:01'),
(32, 1, 'admin', 'LOGIN', 'Pengguna Admin (admin) berhasil masuk ke sistem.', '127.0.0.1', 'Symfony', '2026-11-15 00:47:22', '2026-11-15 00:47:22'),
(33, 2, 'kepsek', 'LOGIN', 'Pengguna Kepala Sekolah (kepsek) berhasil masuk ke sistem.', '127.0.0.1', 'Symfony', '2026-11-15 00:47:23', '2026-11-15 00:47:23'),
(34, 3, 'pj', 'LOGIN', 'Pengguna Ahmad Fauzi, S.Kom. (pj) berhasil masuk ke sistem.', '127.0.0.1', 'Symfony', '2026-11-15 00:47:23', '2026-11-15 00:47:23'),
(35, 3, 'pj', 'LOGIN', 'Pengguna Ahmad Fauzi, S.Kom. (pj) berhasil masuk ke sistem.', '127.0.0.1', 'Symfony', '2026-11-15 00:47:24', '2026-11-15 00:47:24'),
(36, 1, 'admin', 'LOGOUT', 'Pengguna Admin keluar dari sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:47:49', '2026-11-15 00:47:49'),
(37, 2, 'kepsek', 'LOGIN', 'Pengguna Kepala Sekolah (kepsek) berhasil masuk ke sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:48:40', '2026-11-15 00:48:40'),
(38, 2, 'kepsek', 'LOGOUT', 'Pengguna Kepala Sekolah keluar dari sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:49:38', '2026-11-15 00:49:38'),
(39, 1, 'admin', 'LOGIN', 'Pengguna Admin (admin) berhasil masuk ke sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:50:09', '2026-11-15 00:50:09'),
(40, 1, 'admin', 'UPDATE_PJ', 'Memperbarui profil PJ: Agus Salim, S.Pt..', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 00:50:42', '2026-11-15 00:50:42'),
(41, 1, 'admin', 'DELETE_BARANG', 'Menghapus barang: Meja & Kursi Siswa Standar Kemdikbud.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 01:13:23', '2026-11-15 01:13:23'),
(42, 1, 'admin', 'LOGOUT', 'Pengguna Admin keluar dari sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 01:13:49', '2026-11-15 01:13:49'),
(43, 2, 'kepsek', 'LOGIN', 'Pengguna Kepala Sekolah (kepsek) berhasil masuk ke sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 01:14:21', '2026-11-15 01:14:21'),
(44, 2, 'kepsek', 'UPDATE_PROFILE_PHOTO', 'Mengubah foto profil akun Kepala Sekolah.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 01:14:44', '2026-11-15 01:14:44'),
(45, 2, 'kepsek', 'LOGOUT', 'Pengguna Kepala Sekolah keluar dari sistem.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', '2026-11-15 01:16:04', '2026-11-15 01:16:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint UNSIGNED DEFAULT NULL,
  `ruangan_id` bigint UNSIGNED DEFAULT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `satuan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unit',
  `kondisi` enum('Baik','Rusak Ringan','Rusak Berat','Afkir') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Baik',
  `status_ketersediaan` enum('Tersedia','Dipinjam','Dalam Perbaikan','Afkir') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `nilai_perolehan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `tahun_pengadaan` year DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id`, `kode`, `nama`, `kategori_id`, `ruangan_id`, `jumlah`, `satuan`, `kondisi`, `status_ketersediaan`, `nilai_perolehan`, `tahun_pengadaan`, `foto`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'BRG-KOMP-001', 'PC All-in-One HP ProOne 440 G9', 1, 1, 36, 'Unit', 'Baik', 'Tersedia', 12500000.00, '2023', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:42:08'),
(2, 'BRG-FURN-004', 'Meja Workstation Dual Seat', 7, 1, 18, 'Unit', 'Baik', 'Tersedia', 1850000.00, '2022', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(3, 'BRG-FURN-007', 'Kursi Siswa Hidrolik Ergonomis', 7, 1, 36, 'Unit', 'Baik', 'Tersedia', 650000.00, '2022', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:42:08'),
(4, 'BRG-ELEK-002', 'Switch Gigabit Cisco 24-Port', 1, 1, 2, 'Unit', 'Baik', 'Tersedia', 7500000.00, '2023', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(5, 'BRG-ELEK-009', 'AC Split Daikin Inverter 2 PK', NULL, 1, 2, 'Unit', 'Rusak Ringan', 'Tersedia', 9200000.00, '2021', NULL, 'Hembusan kurang dingin, menunggu jadwal servis berkala.', '2026-11-14 02:42:08', '2026-11-14 02:42:08'),
(6, 'BRG-TP-001', 'Mesin Trafo Las Inverter SMAW 200A', NULL, 2, 16, 'Unit', 'Baik', 'Tersedia', 3800000.00, '2023', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(7, 'BRG-TP-002', 'Mesin Las TIG/Argon GTAW Miller', NULL, 2, 6, 'Unit', 'Baik', 'Tersedia', 18500000.00, '2023', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(8, 'BRG-TP-003', 'Mesin Gerinda Tangan 4\" Makita', NULL, 2, 12, 'Unit', 'Rusak Ringan', 'Tersedia', 850000.00, '2022', NULL, '1 unit konslet armature, dalam permohonan ganti unit ke admin.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(9, 'BRG-TP-004', 'Kedok Las Auto Darkening Helmet', NULL, 2, 24, 'Unit', 'Baik', 'Tersedia', 450000.00, '2023', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(10, 'BRG-GP-001', 'Kompas Geologi Brunton 5006LM', 3, 3, 14, 'Unit', 'Baik', 'Tersedia', 6200000.00, '2022', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:42:08'),
(11, 'BRG-GP-002', 'GPS Handheld Garmin Montana 700', 3, 3, 8, 'Unit', 'Baik', 'Tersedia', 11500000.00, '2023', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:42:08'),
(12, 'BRG-GP-003', 'Mikroskop Polarisasi Geologi Olympus', 3, 3, 6, 'Unit', 'Baik', 'Tersedia', 32000000.00, '2021', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(13, 'BRG-GP-004', 'Palu Geologi Estwing Pipih & Runcing', 3, 3, 20, 'Unit', 'Baik', 'Tersedia', 1450000.00, '2022', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:42:08'),
(14, 'BRG-KL-001', 'Kompor 4 Burner Range Heavy Duty Gas', 4, 4, 8, 'Unit', 'Baik', 'Tersedia', 16500000.00, '2022', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(15, 'BRG-KL-002', 'Oven Deck Gas Convection Sinmag', 4, 4, 3, 'Unit', 'Baik', 'Tersedia', 28000000.00, '2021', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(16, 'BRG-KL-003', 'Planetary Mixer 20L Bakery Spiral', 4, 4, 4, 'Unit', 'Baik', 'Tersedia', 12500000.00, '2023', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(17, 'BRG-KL-005', 'Blender Commercial Heavy Duty', 4, 4, 6, 'Unit', 'Rusak Ringan', 'Tersedia', 2200000.00, '2022', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(18, 'BRG-PH-001', 'Bed Set King Koil Deluxe Mockup Suite', 5, 5, 6, 'Unit', 'Baik', 'Tersedia', 14000000.00, '2022', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:42:08'),
(19, 'BRG-PH-002', 'Troli Housekeeping Linen & Amenities', 5, 5, 4, 'Unit', 'Baik', 'Tersedia', 6500000.00, '2023', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(20, 'BRG-ATR-001', 'Mesin Chopper Pencacah Rumput 8.5 HP', 6, 6, 3, 'Unit', 'Rusak Ringan', 'Tersedia', 9800000.00, '2021', NULL, 'V-Belt putus dan pisau perajang aus.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(21, 'BRG-ATR-002', 'Timbangan Sapi Digital Kapasitas 2 Ton', 6, 6, 1, 'Unit', 'Baik', 'Tersedia', 19500000.00, '2023', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(22, 'BRG-FURN-012', 'Meja Kerja Guru 1/2 Biro Modera', 7, 7, 45, 'Unit', 'Baik', 'Tersedia', 1250000.00, '2022', NULL, NULL, '2026-11-14 02:42:08', '2026-11-14 02:42:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'category',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `kode`, `nama`, `deskripsi`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'KAT-KOMP', 'Komputer & IT', 'PC All-in-One, Laptop, Server, Switch, Router', 'desktop_windows', '2026-11-14 02:42:08', '2026-11-14 02:54:37'),
(3, 'KAT-GEO', 'Instrumen Geologi', 'Kompas Geologi, GPS Garmin, Mikroskop Polarisasi', 'terrain', '2026-11-14 02:42:08', '2026-11-14 02:54:37'),
(4, 'KAT-BOGA', 'Peralatan Kuliner', 'Kompor Heavy Duty, Oven Convection, Mixer Spiral', 'skillet', '2026-11-14 02:42:08', '2026-11-14 02:54:37'),
(5, 'KAT-HOTEL', 'Fasilitas Edotel', 'Mockup Suite Bed, Troli Housekeeping, Linen', 'hotel', '2026-11-14 02:42:08', '2026-11-14 02:54:37'),
(6, 'KAT-TERNAK', 'Peralatan Peternakan', 'Mesin Chopper Pakan, Timbangan Hewan Digital', 'agriculture', '2026-11-14 02:42:08', '2026-11-14 02:54:37'),
(7, 'KAT-FURN', 'Furniture & Mebel', 'Meja Kursi Siswa, Lemari Arsip, Rak Buku', 'table_restaurant', '2026-11-14 02:42:08', '2026-11-14 02:42:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_laporan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ruangan_id` bigint UNSIGNED DEFAULT NULL,
  `barang_id` bigint UNSIGNED DEFAULT NULL,
  `jenis` enum('Ganti Barang Rusak','Kebutuhan Barang Baru','Barang Rusak','Barang Hilang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urgensi` enum('Biasa','Penting','Darurat') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Biasa',
  `status` enum('Menunggu Verifikasi','Sedang Diproses','Selesai Disetujui','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Verifikasi',
  `kondisi_barang` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `respon_admin` text COLLATE utf8mb4_unicode_ci,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `foto_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lapor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_selesai` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporans`
--

INSERT INTO `laporans` (`id`, `kode_laporan`, `user_id`, `ruangan_id`, `barang_id`, `jenis`, `nama_barang`, `deskripsi`, `urgensi`, `status`, `kondisi_barang`, `respon_admin`, `admin_id`, `foto_bukti`, `file_lampiran`, `tanggal_lapor`, `tanggal_selesai`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LAP-2025-001', 4, 2, 8, 'Ganti Barang Rusak', 'Mesin Gerinda Tangan 4\" Makita (BRG-TP-003)', 'Armature rotor terbakar konsleting saat praktik pengelasan kelas XI TP, minta penggantian unit baru.', 'Darurat', 'Sedang Diproses', 'Afkir / Diganti', 'Disetujui penggantian. Unit cadangan disiapkan dari gudang sarpras untuk Bengkel TP.', 1, NULL, NULL, '2026-11-13 02:56:02', NULL, '2026-11-14 02:42:08', '2026-11-15 01:04:39', NULL),
(2, 'LAP-2025-002', 3, 1, NULL, 'Kebutuhan Barang Baru', 'Crimping Tool & Kabel Tester RJ-45 (5 Set)', 'Pengajuan tambahan alat praktik instalasi LAN untuk uji kompetensi UKK siswa RPL.', 'Penting', 'Menunggu Verifikasi', 'Rencana Pengadaan Baru', 'Menunggu review anggaran pengadaan sarana praktik semester genap.', 1, NULL, NULL, '2026-11-10 02:56:02', NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02', NULL),
(3, 'LAP-2025-003', 6, 4, 17, 'Ganti Barang Rusak', 'Blender Commercial Heavy Duty', 'Gear penggerak aus dan motor overheat, minta penggantian unit operasional dapur.', 'Penting', 'Sedang Diproses', 'Rusak Berat', 'Alokasi penggantian disetujui, dalam verifikasi stok gudang tata boga.', 1, NULL, NULL, '2026-11-12 02:56:02', NULL, '2026-11-14 02:42:08', '2026-11-14 02:56:02', NULL),
(4, 'LAP-2025-004', 8, 6, 20, 'Barang Rusak', 'Mesin Chopper Pencacah Rumput 8.5 HP', 'V-Belt putus dan pisau perajang tumpul setelah pencacahan rumput gajah harian.', 'Penting', 'Ditolak', 'Rusak Ringan', 'Mekanik sarpras dijadwalkan memasang V-Belt baru dan pengasahan pisau chopper.', 1, NULL, NULL, '2026-11-10 02:56:02', NULL, '2026-11-14 02:42:08', '2026-11-14 02:58:13', NULL),
(5, 'LAP-2025-005', 5, 3, 11, 'Kebutuhan Barang Baru', 'GPS Handheld Garmin Montana 700 (2 Unit)', 'Tambahan perangkat GPS untuk pemetaan geologi lapangan kelas XI & XII di lapangan tambang.', 'Biasa', 'Ditolak', 'Rencana Pengadaan Baru', 'Proposal disetujui Kepala Sekolah melalui program revitalisasi SMK Pusat Keunggulan.', 1, NULL, NULL, '2026-11-09 02:42:08', NULL, '2026-11-14 02:42:08', '2026-11-14 02:53:02', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2026_11_14_000001_create_kategoris_table', 1),
(3, '2026_11_14_000002_create_ruangans_table', 1),
(4, '2026_11_14_000003_create_barangs_table', 1),
(5, '2026_11_14_000004_create_laporans_table', 1),
(6, '2026_11_14_000005_create_activity_logs_table', 1),
(7, '2026_11_14_000006_add_last_seen_at_to_users_table', 2),
(8, '2026_11_15_000001_add_soft_deletes_to_laporans_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'meeting_room',
  `gedung` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lantai` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pj_id` bigint UNSIGNED DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangans`
--

INSERT INTO `ruangans` (`id`, `kode`, `nama`, `sub`, `icon`, `gedung`, `lantai`, `pj_id`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'RNG-LAB-RPL', 'Laboratorium RPL', 'Lab Software Rekayasa Perangkat Lunak', 'desktop_windows', 'Gedung Praktik Kejuruan', 'Lantai 2', NULL, 'Ruangan terakreditasi BNSP untuk Tempat Uji Kompetensi (TUK) RPL, ber-AC dan fiber optic 100 Mbps.', '2026-11-14 02:42:08', '2026-11-14 03:20:25'),
(2, 'RNG-BKL-TP', 'Bengkel Pengelasan (TP)', 'Bengkel Fabrikasi Las SMAW/GMAW', 'precision_manufacturing', 'Gedung Bengkel TP', 'Lantai 1', 4, 'Bengkel praktik standar industri pengelasan SMAW, GMAW, GTAW berstandar K3.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(3, 'RNG-BKL-GP', 'Bengkel & Lab GP', 'Workshop Geologi Pertambangan', 'terrain', 'Gedung Bengkel GP', 'Lantai 1', 5, 'Pusat eksplorasi batuan dan mineral geologi, pemetaan topografi, dan preparasi batuan pertambangan.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(4, 'RNG-DPR-KL', 'Dapur Praktik Kuliner (KL)', 'Kitchen Lab & Bakery Tata Boga', 'skillet', 'Gedung Kuliner & Boga', 'Lantai 1', 6, 'Dapur komersial standar industri kuliner dengan workstation stainless steel dan cold storage.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(5, 'RNG-HTL-PH', 'Edotel & Praktik PH', 'Mockup Suite Hotel Training Center', 'hotel', 'Gedung Edotel SMKN 4', 'Lantai 1-2', 7, 'Unit usaha dan laboratorium edotel bintang 3 untuk simulasi front office dan housekeeping.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(6, 'RNG-KDG-ATR', 'Kandang Teaching Farm ATR', 'Instalasi Ternak Ruminansia', 'agriculture', 'Area Edu-Farm SMKN 4', 'Zona Lapangan', 8, 'Laboratorium peternakan ruminansia sapi dan kambing dengan mesin pengolah silase.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(7, 'RNG-GURU', 'Ruang Guru', 'Ruang Administrasi Pendidik', 'groups', 'Gedung Utama', 'Lantai 1', 9, 'Fasilitas kerja dan administrasi seluruh dewan guru SMKN 4 Bojonegoro.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(8, 'RNG-PERPUS', 'Perpustakaan Sekolah', 'Pusat Sumber Belajar & E-Library', 'local_library', 'Gedung Penunjang', 'Lantai 1', 10, 'Perpustakaan berbasis digital (e-library) dengan ribuan koleksi buku referensi kejuruan.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(9, 'RNG-TU', 'Ruang Tata Usaha', 'Layanan Administrasi Sekolah', 'badge', 'Gedung Utama', 'Lantai 1', 11, 'Pusat layanan administrasi kesiswaan, kepegawaian, dan persuratan sekolah.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(10, 'RNG-KLS-XRPL', 'Ruang Kelas X RPL', 'Ruang Teori X RPL', 'school', 'Gedung Teori', 'Lantai 2', 12, 'Ruang kelas teori reguler X RPL dengan fasilitas KBM lengkap.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(11, 'RNG-KLS-XTP', 'Ruang Kelas X TP', 'Ruang Teori X TP', 'school', 'Gedung Teori', 'Lantai 1', 13, 'Ruang kelas teori reguler X TP.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(12, 'RNG-KLS-XGP', 'Ruang Kelas X GP', 'Ruang Teori X GP', 'school', 'Gedung Teori', 'Lantai 1', 14, 'Ruang kelas teori reguler X GP.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(13, 'RNG-KLS-XKL', 'Ruang Kelas X KL', 'Ruang Teori X KL', 'school', 'Gedung Teori', 'Lantai 2', 15, 'Ruang kelas teori reguler X KL.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(14, 'RNG-KLS-XPH', 'Ruang Kelas X PH', 'Ruang Teori X PH', 'school', 'Gedung Teori', 'Lantai 2', 16, 'Ruang kelas teori reguler X PH.', '2026-11-14 02:42:08', '2026-11-14 02:56:02'),
(15, 'RNG-KLS-XATR', 'Ruang Kelas X ATR', 'Ruang Teori X ATR', 'school', 'Gedung Teori', 'Lantai 1', 17, 'Ruang kelas teori reguler X ATR.', '2026-11-14 02:42:08', '2026-11-15 00:50:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','kepsek','pj') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pj',
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_seen_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `nip`, `jabatan`, `jurusan`, `kontak`, `foto_profil`, `is_active`, `last_seen_at`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@adminsvc.com', '$2y$12$TcxwrjWfaVKt1sf7ezOa5.7opGdYmdkjH9NCkqTwdWZ/FOtz3GZci', 'admin', NULL, 'Administrator Sarpras', 'Sarpras Sekolah', '0812-3344-5566', 'profiles/S8DrqJWcbKSWf2HS1uvX13y3AC41nKTJwXivkzD0.png', 1, NULL, NULL, NULL, '2026-11-14 02:42:00', '2026-11-15 01:13:49'),
(2, 'Kepala Sekolah', 'kepalasekolah@kepseksvc.com', '$2y$12$fsuccjB.8o9J425xj2u8CuFk5AepEWkG5VCBS9fupFR5TvUsGiwwW', 'kepsek', NULL, 'Kepala SMKN 4 Bojonegoro', 'Manajemen Sekolah', '0811-2233-4455', 'profiles/vYgDcFi4sH3xVcH5mv0nf8wWVPppWPSC9R97cTmy.png', 1, NULL, NULL, NULL, '2026-11-14 02:42:01', '2026-11-15 01:16:04'),
(3, 'Ahmad Fauzi, S.Kom.', 'ahmad.fauzi@smkn4bojonegoro.sch.id', '$2y$12$vr2kqrKOqlU5NCLennVhXuF4EcmZ8fMiM/EXVfcztiwn71I49F30S', 'pj', '19840312 200902 1 004', 'Kepala Lab RPL', 'RPL', '0812-3456-7890', NULL, 1, '2026-11-15 00:47:24', NULL, NULL, '2026-11-14 02:42:01', '2026-11-15 00:47:24'),
(4, 'Joko Prasetyo, S.T.', 'joko.prasetyo@smkn4bojonegoro.sch.id', '$2y$12$IItur/20mFzKJdaGnrBSGeaqkiRjCr5Ioo6zGZW66lyTi1o2jP6.O', 'pj', '19820516 200801 1 007', 'Kepala Bengkel TP', 'TP', '0813-2345-6789', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:02', '2026-11-14 02:55:53'),
(5, 'Ir. Wahyu Hidayat, S.T.', 'wahyu.hidayat@smkn4bojonegoro.sch.id', '$2y$12$Ev1QPXvGevlCSFJ6wTH5HO3BOY77Y1u537f.hv45hQznmIVZrJi.y', 'pj', '19760921 200312 1 002', 'Kepala Bengkel GP', 'GP', '0812-9876-5432', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:02', '2026-11-14 02:55:54'),
(6, 'Chef Maya Anggraini, S.Pd.', 'maya.anggraini@smkn4bojonegoro.sch.id', '$2y$12$rThIj2SO5PomVFRrN8nBpetHBk2JWJywL1J.80XOvuj8FZ6foiMii', 'pj', '19880715 201204 2 006', 'Kepala Dapur Kuliner', 'KL', '0821-4567-8901', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:03', '2026-11-14 02:55:54'),
(7, 'Rina Kusuma, S.ST.Par.', 'rina.kusuma@smkn4bojonegoro.sch.id', '$2y$12$n7pAL54HR5J3ACqkU28dYOkTCvF4usHpfQBWWWTc1iV47L08K8TbG', 'pj', '19861025 201001 2 018', 'Kepala Edotel PH', 'PH', '0857-1234-5678', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:03', '2026-11-14 02:55:55'),
(8, 'Drh. Tri Wibowo, S.Pt.', 'tri.wibowo@smkn4bojonegoro.sch.id', '$2y$12$Uwb7.QVITQ3us267tZ/KMO34EU56OY2n2Nv0LZhI09riJGVSVd/r.', 'pj', '19810419 200604 1 012', 'Kepala Kandang ATR', 'ATR', '0812-7890-1234', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:04', '2026-11-14 02:55:56'),
(9, 'Siti Rahmawati, S.Pd.', 'siti.rahmawati@smkn4bojonegoro.sch.id', '$2y$12$gcmlaOqxUwHkZZJWn0wSKuVNwq3MPMt1jA.hh8AHK7Dl2SnCvxSFO', 'pj', '19790514 200501 2 008', 'PJ Ruang Guru', 'Umum', '0856-7890-2345', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:04', '2026-11-14 02:55:56'),
(10, 'Lestari Wahyuni, S.I.Pust.', 'lestari.wahyuni@smkn4bojonegoro.sch.id', '$2y$12$OUDMSh0dFv0.BQ/T957tKOxMY34NzzBU9BXOzrOGbx6y6pS7mE.ju', 'pj', '19851104 201101 2 011', 'PJ Perpustakaan', 'Umum', '0813-8901-2345', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:05', '2026-11-14 02:55:57'),
(11, 'Bambang Nugroho, S.AP.', 'bambang.nugroho@smkn4bojonegoro.sch.id', '$2y$12$HeNHst4AYXGVyvqWh7zYbOcAtupTT.24udsRuyoOBQW.Ss3Sm4p5q', 'pj', '19780622 200701 1 009', 'PJ Tata Usaha', 'Umum', '0822-9012-3456', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:05', '2026-11-14 02:55:58'),
(12, 'Hendra Wijaya, S.Kom.', 'hendra.wijaya@smkn4bojonegoro.sch.id', '$2y$12$vrAVQj8aMRhwtwXi5NAcb.MhVq4NrVpf6evV8IF95v/qAvywUP/pm', 'pj', '19850214 201001 1 015', 'Wali Kelas X RPL', 'RPL', '0812-1122-3344', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:05', '2026-11-14 02:55:58'),
(13, 'Budi Santoso, S.Pd.', 'budi.santoso.tp@smkn4bojonegoro.sch.id', '$2y$12$8Xkblm/1igNWrV87t8ZIJenGhpzSxPq64A5801bW9a.Us.qEeesGu', 'pj', '19830820 200901 1 011', 'Wali Kelas X TP', 'TP', '0813-4455-6677', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:06', '2026-11-14 02:55:59'),
(14, 'Dewi Lestari, S.T.', 'dewi.lestari@smkn4bojonegoro.sch.id', '$2y$12$hkoZ0eRzauhgVNmtpoRgsun64.0ar8/XvgzDRZDSPvaL2ZZ6TdqNK', 'pj', '19890412 201402 2 007', 'Wali Kelas X GP', 'GP', '0821-5566-7788', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:06', '2026-11-14 02:56:00'),
(15, 'Anisa Putri, S.Pd.', 'anisa.putri@smkn4bojonegoro.sch.id', '$2y$12$kVXxYEZR458phsu2v.lE0OeUhToxH7YUo3VCOS4Z75kBqg/mqjax.', 'pj', '19920115 201903 2 010', 'Wali Kelas X KL', 'KL', '0857-6677-8899', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:07', '2026-11-14 02:56:00'),
(16, 'Dimas Pratama, S.Pd.', 'dimas.pratama@smkn4bojonegoro.sch.id', '$2y$12$dQ.vXikNc.2qjff4Kvdywu66AxOkta0X2AuZlPKlSDljJEWP3Pr3O', 'pj', '19901103 201504 1 008', 'Wali Kelas X PH', 'PH', '0812-7788-9900', NULL, 1, NULL, NULL, NULL, '2026-11-14 02:42:07', '2026-11-14 02:56:01'),
(17, 'Agus Salim, S.Pt.', 'agus.salim@smkn4bojonegoro.sch.id', '$2y$12$oj7KRbkKEA5sopAsJ4W7p.NJwPCYMPC0NkYXIdyukzxf9Fd3RLxH2', 'pj', '19870529 201101 1 016', 'Wali Kelas X ATR', 'ATR', '0813-8899-0011', 'profiles/M0kKuZFDxKOlcYpND3h2SvHnU361mK1RUk5d6VGa.png', 1, NULL, NULL, NULL, '2026-11-14 02:42:08', '2026-11-15 00:50:42');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_kode_unique` (`kode`),
  ADD KEY `barangs_kategori_id_foreign` (`kategori_id`),
  ADD KEY `barangs_ruangan_id_foreign` (`ruangan_id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoris_kode_unique` (`kode`);

--
-- Indeks untuk tabel `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laporans_kode_laporan_unique` (`kode_laporan`),
  ADD KEY `laporans_user_id_foreign` (`user_id`),
  ADD KEY `laporans_ruangan_id_foreign` (`ruangan_id`),
  ADD KEY `laporans_barang_id_foreign` (`barang_id`),
  ADD KEY `laporans_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruangans_kode_unique` (`kode`),
  ADD KEY `ruangans_pj_id_foreign` (`pj_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `barangs_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laporans_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laporans_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laporans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  ADD CONSTRAINT `ruangans_pj_id_foreign` FOREIGN KEY (`pj_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
