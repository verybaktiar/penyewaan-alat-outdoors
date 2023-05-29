-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2023 pada 10.50
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-sewa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id_admin` varchar(7) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_Telp` varchar(13) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id_admin`, `id_user`, `nama_admin`, `alamat`, `no_Telp`, `created_at`, `updated_at`) VALUES
('ADM1', 'USR1', 'Dinda Nisa', 'Surabaya', '085749252096', '2023-04-23 21:26:02', '2023-04-23 21:26:02'),
('ADM2', 'USR2', 'Rengganis', 'Surabaya', '085607703475', '2023-04-23 21:26:02', '2023-04-23 21:26:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alatoutdoors`
--

CREATE TABLE `alatoutdoors` (
  `id_alatoutdoor` varchar(8) NOT NULL,
  `nama_alat` varchar(40) NOT NULL,
  `id_kategori` varchar(8) NOT NULL,
  `spesifikasi` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `stok` varchar(10) NOT NULL,
  `harga_sewa` varchar(20) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alatoutdoors`
--

INSERT INTO `alatoutdoors` (`id_alatoutdoor`, `nama_alat`, `id_kategori`, `spesifikasi`, `deskripsi`, `stok`, `harga_sewa`, `merk`, `image`, `created_at`, `updated_at`) VALUES
('KD1', 'Sepatu Gunung', 'KT3', 'Everest Catcher', 'Sepatu 123', '100', '15000', 'Vans', '1684442675.sepatu.jpg', '2023-05-18 13:44:35', '2023-05-18 13:44:35'),
('KD2', 'Tas Carrier', 'KT2', 'Carrier of life', 'Menampung seperti kantong doraemonn', '2000', '20000', 'Paris Hilton', '1684442784.carrier.jpg', '2023-05-18 13:46:24', '2023-05-18 13:46:24'),
('KD3', 'Sleeping Bag', 'KT1', 'Sleeping like a cocoon', 'Kehangantan seperti pelukan doi :(', '3000', '30000', 'Vindland Sleeping bag', '1684442920.sleepingbag.jpeg', '2023-05-18 13:48:40', '2023-05-18 13:48:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id_kategori` varchar(8) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
('01', 'Matras', '2023-04-23 21:39:18', '2023-04-23 21:39:33'),
('KT1', 'Sleeping Bag', '2023-04-24 07:15:17', '2023-04-24 07:15:17'),
('KT2', 'Tas Carrier', '2023-04-24 07:15:27', '2023-04-24 07:15:27'),
('KT3', 'Sepatu', '2023-04-24 07:15:37', '2023-04-24 07:15:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id_keranjang` varchar(7) NOT NULL,
  `id_pelanggan` varchar(6) NOT NULL,
  `id_alatoutdoor` varchar(8) NOT NULL,
  `mulai_sewa` date NOT NULL,
  `akhir_sewa` date NOT NULL,
  `total_sewa` varchar(10) NOT NULL,
  `status_checkout` enum('Y','N') NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keranjangs`
--

INSERT INTO `keranjangs` (`id_keranjang`, `id_pelanggan`, `id_alatoutdoor`, `mulai_sewa`, `akhir_sewa`, `total_sewa`, `status_checkout`, `created_at`, `updated_at`) VALUES
('KRJ1', 'PLG14', 'KD2', '2023-05-29', '2023-06-02', '1', 'N', '2023-05-28 20:05:12', '2023-05-28 22:58:29'),
('KRJ2', 'PLG14', 'KD1', '2023-05-30', '2023-05-31', '1', 'N', '2023-05-28 22:41:12', '2023-05-28 22:58:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_13_050826_create_admins_table', 1),
(6, '2023_02_13_052316_create_pelanggans_table', 1),
(7, '2023_02_13_052425_create_opentrips_table', 1),
(8, '2023_02_13_052550_create_kategoris_table', 1),
(9, '2023_02_13_052813_create_alatoutdoors_table', 1),
(10, '2023_02_13_053802_create_keranjangs_table', 1),
(11, '2023_02_13_054531_create_penyewaans_table', 1),
(12, '2023_02_13_055538_create_rekaps_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `opentrips`
--

CREATE TABLE `opentrips` (
  `id_opentrip` varchar(5) NOT NULL,
  `nm_opentrip` varchar(25) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `fasilitas` varchar(100) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `opentrips`
--

INSERT INTO `opentrips` (`id_opentrip`, `nm_opentrip`, `deskripsi`, `fasilitas`, `harga`, `image`, `created_at`, `updated_at`) VALUES
('OP001', 'Gunung Bromo', 'Gunung Bromo adalah salah satu gunung api yang masih aktif di Indonesia. Gunung yang memiliki ketinggian 2.392 meter di atas permukaan laut ini merupakan destinasi andalan Jawa Timur.', '- Tiket Simaksi - Jodoh Bila Beruntung', 'Rp 300.000', 'oUujwPjWNlpjbCOweqbUrjjv9c8cv2kvANHK3IRw.png', '2023-04-24 06:51:00', '2023-04-24 06:51:00'),
('OP1', 'Gunung Prau', 'Gunung Prau berada di kawasan Dataran Tinggi Dieng, Jawa Tengah dan merupakan tapal batas antara empat kabupaten.', '- Tiket Simaksi - Jodoh Bila Beruntung', 'Rp 300.000', 'yqQkOsjloZuEJZ5P9g9k2LZBa98QYuP5FeCJrDLu.jpg', '2023-04-24 06:29:47', '2023-04-24 06:29:47'),
('OP2', 'Gunung Lawu', 'Gunung lawu adalah adalah sebuah gunung berapi non-aktif yang terletak di Pulau Jawa, tepatnya di perbatasan Jawa Tengah dan Jawa Timur, Indonesia. Gunung Lawu memiliki ketinggian sekitar 3.265 mdpl.', '-Tiket simaksi -Porter', 'Rp 250.000', 'W7MIXAzfioHIeS4uTpLWyL8ctYUWVIgV1X9hBgrQ.jpg', '2023-04-24 06:27:30', '2023-04-24 06:27:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id_pelanggan` varchar(6) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(13) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggans`
--

INSERT INTO `pelanggans` (`id_pelanggan`, `id_user`, `nama_pelanggan`, `alamat`, `no_telepon`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('PLG1', 'USR3', 'rida', NULL, '085749252096', 'perempuan', '2023-04-23 21:26:02', '2023-04-23 21:26:02'),
('PLG11', 'USR4', 'Sulis', NULL, NULL, NULL, '2023-04-23 21:28:44', '2023-04-23 21:28:44'),
('PLG12', 'USR5', 'deka', NULL, NULL, NULL, '2023-04-24 07:16:29', '2023-04-24 07:16:29'),
('PLG13', 'USR6', 'Firman', NULL, NULL, NULL, '2023-04-24 07:17:10', '2023-04-24 07:17:10'),
('PLG14', 'USR7', 'ucup', NULL, NULL, NULL, '2023-05-18 12:42:33', '2023-05-18 12:42:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaans`
--

CREATE TABLE `penyewaans` (
  `id_sewa` varchar(7) NOT NULL,
  `id_pelanggan` varchar(6) NOT NULL,
  `id_keranjang` varchar(7) NOT NULL,
  `tgl_ambil` date DEFAULT NULL,
  `jaminan` enum('KTP','SIM') NOT NULL,
  `foto_jaminan` varchar(50) NOT NULL,
  `total_bayar` varchar(10) NOT NULL,
  `bukti_bayar` varchar(50) NOT NULL,
  `status_bayar` enum('Belum','Sudah') NOT NULL DEFAULT 'Belum',
  `status_sewa` enum('Belum','Berjalan','Berakhir') NOT NULL DEFAULT 'Belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekaps`
--

CREATE TABLE `rekaps` (
  `id_rekap` varchar(8) NOT NULL,
  `id_pelanggan` varchar(6) NOT NULL,
  `id_alatoutdoor` varchar(8) NOT NULL,
  `masa_sewa` varchar(3) NOT NULL,
  `tgl_penyewaan` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status_kembali` varchar(15) NOT NULL,
  `denda` varchar(10) NOT NULL,
  `id_admin` varchar(7) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` varchar(8) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pelanggan') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
('USR1', 'admin1', 'admin1@gmail.com', NULL, '$2y$10$Mi.62YpeDBUXXrZ0zfdLFObLfvtOHoVW319wIMYlyDnVnwC.6UYWu', 'admin', NULL, '2023-04-23 21:26:02', '2023-04-23 21:26:02'),
('USR2', 'admin2', 'admin2@gmail.com', NULL, '$2y$10$oj9JozR1SA7v83TH9dn93uw1PyNE7Y65rsYSIYXEcxfqziMcawb7C', 'admin', NULL, '2023-04-23 21:26:02', '2023-04-23 21:26:02'),
('USR3', 'rida', 'ridaa@gmail.com', NULL, '$2y$10$MPQZxPJxF2QTZl0XLP8A8OmF7wTbaxBhkhNw5uR.asKGcQ7fdoc..', 'pelanggan', NULL, '2023-04-23 21:26:02', '2023-04-23 21:26:02'),
('USR4', 'sulisrhyu', 'sulisrahayu@gmail.com', NULL, '$2y$10$Nw5Sgu/3Mjhao0NQ0NUn..557q7s7FsXamTflAD1cfS9T8WVU7gMq', 'pelanggan', NULL, '2023-04-23 21:28:44', '2023-04-23 21:28:44'),
('USR5', 'dekapramesta', 'dekapramesta@gmail.com', NULL, '$2y$10$BE0LPI7tzxh4LpSZQaipsutDCcjqc83iuGDu.VWjBLDywAUTVYYP2', 'pelanggan', NULL, '2023-04-24 07:16:29', '2023-04-24 07:16:29'),
('USR6', 'firmanadi', 'firmanadi@gmail.com', NULL, '$2y$10$G2Mfnc/m8QAPzBTWBw7/yewSkDlVTm8ql9IZF8swGVRrk3k5z1t2C', 'pelanggan', NULL, '2023-04-24 07:17:10', '2023-04-24 07:17:10'),
('USR7', 'ucup99', 'ucup@email.com', NULL, '$2y$10$fMaN1x9GmWX6UjocdeUhx.yIqAT0j9Gl2.nJxUOwLb5TzrvVPMz8.', 'pelanggan', NULL, '2023-05-18 12:42:33', '2023-05-18 12:42:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `admins_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `alatoutdoors`
--
ALTER TABLE `alatoutdoors`
  ADD PRIMARY KEY (`id_alatoutdoor`),
  ADD KEY `alatoutdoors_id_kategori_foreign` (`id_kategori`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `keranjangs_id_pelanggan_foreign` (`id_pelanggan`),
  ADD KEY `keranjangs_id_alatoutdoor_foreign` (`id_alatoutdoor`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `opentrips`
--
ALTER TABLE `opentrips`
  ADD PRIMARY KEY (`id_opentrip`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `pelanggans_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `penyewaans`
--
ALTER TABLE `penyewaans`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `penyewaans_id_pelanggan_foreign` (`id_pelanggan`),
  ADD KEY `penyewaans_id_keranjang_foreign` (`id_keranjang`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `rekaps`
--
ALTER TABLE `rekaps`
  ADD PRIMARY KEY (`id_rekap`),
  ADD KEY `rekaps_id_pelanggan_foreign` (`id_pelanggan`),
  ADD KEY `rekaps_id_alatoutdoor_foreign` (`id_alatoutdoor`),
  ADD KEY `rekaps_id_admin_foreign` (`id_admin`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `alatoutdoors`
--
ALTER TABLE `alatoutdoors`
  ADD CONSTRAINT `alatoutdoors_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategoris` (`id_kategori`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD CONSTRAINT `keranjangs_id_alatoutdoor_foreign` FOREIGN KEY (`id_alatoutdoor`) REFERENCES `alatoutdoors` (`id_alatoutdoor`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjangs_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggans` (`id_pelanggan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD CONSTRAINT `pelanggans_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penyewaans`
--
ALTER TABLE `penyewaans`
  ADD CONSTRAINT `penyewaans_id_keranjang_foreign` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjangs` (`id_keranjang`) ON DELETE CASCADE,
  ADD CONSTRAINT `penyewaans_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggans` (`id_pelanggan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekaps`
--
ALTER TABLE `rekaps`
  ADD CONSTRAINT `rekaps_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id_admin`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekaps_id_alatoutdoor_foreign` FOREIGN KEY (`id_alatoutdoor`) REFERENCES `alatoutdoors` (`id_alatoutdoor`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekaps_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggans` (`id_pelanggan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
