-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2020 pada 07.24
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `keterangan` text NOT NULL,
  `satuan_id` int(1) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `kode_barang`, `nama_barang`, `keterangan`, `satuan_id`, `stock`, `harga`, `harga_jual`, `date_created`) VALUES
(2, 'B-P-0002', 'Sampoerna Hijau', 'Kursi Kayu', 4, 100, 125000, 132000, 1592813650),
(3, 'B-P-0003', 'Aqua Gelas', 'Aqua Gelas', 5, 25, 25000, 27000, 1592814174),
(5, 'B-P-0004', 'Citato', 'Citato per pak', 3, 25, 50000, 60000, 1592818113),
(6, 'B-P-0005', 'Minyak Goreng Fortune', 'Minyak Goreng Fortune Kemasan 1 Kg', 2, 30, 13000, 15000, 1592837013),
(7, 'B-P-0006', 'Dunhill Putih', 'Dunhill Putih per slop', 4, 25, 220000, 225000, 1592837048),
(8, 'B-P-0007', 'Dunhill Merah', 'Dunhill Merah per slop', 4, 25, 225000, 230000, 1592837403),
(9, 'B-P-0008', 'Class Mild', 'Class Mild per slop', 4, 25, 250000, 255000, 1592837894),
(10, 'B-P-0009', 'Kopi ABC', 'Kopi ABC Bubuk', 1, 25, 8000, 10000, 1592839268);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`satuan_id`, `satuan`) VALUES
(1, 'Lusin'),
(2, 'Bungkus'),
(3, 'Pak'),
(4, 'Slop'),
(5, 'Dus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sub_transaksi`
--

CREATE TABLE `tb_sub_transaksi` (
  `id` int(11) NOT NULL,
  `no_resi` varchar(100) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sub_transaksi`
--

INSERT INTO `tb_sub_transaksi` (`id`, `no_resi`, `barang_id`, `qty`) VALUES
(13, 'BRX-0001', 3, 1),
(14, 'BRX-0001', 5, 1),
(17, 'BRX-0002', 3, 1),
(18, 'BRX-0002', 9, 1),
(19, 'BRX-0002', 10, 1),
(20, 'BRX-0003', 3, 1),
(21, 'BRX-0003', 6, 1),
(22, 'BRX-0004', 3, 2),
(23, 'BRX-0004', 9, 1),
(24, 'BRX-0005', 9, 2),
(25, 'BRX-0005', 5, 1),
(26, 'BRX-0006', 2, 1),
(27, 'BRX-0007', 5, 1),
(28, 'BRX-0007', 9, 1),
(29, 'BRX-0008', 2, 1),
(30, 'BRX-0008', 9, 1),
(31, 'BRX-0009', 8, 1),
(32, 'BRX-0009', 9, 1),
(33, 'BRX-0009', 10, 1),
(34, 'BRX-0010', 10, 1),
(35, 'BRX-0010', 2, 1),
(36, 'BRX-0010', 5, 1),
(37, 'BRX-0011', 10, 1),
(38, 'BRX-0011', 8, 1),
(39, 'BRX-0011', 2, 1),
(40, 'BRX-0011', 9, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `no_resi` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_resi`, `total`, `date_created`) VALUES
('BRX-0001', 75000, '2020-06-22'),
('BRX-0002', 283000, '2020-06-23'),
('BRX-0003', 38000, '2020-06-23'),
('BRX-0004', 300000, '2020-06-23'),
('BRX-0005', 550000, '2020-06-24'),
('BRX-0006', 125000, '2020-06-24'),
('BRX-0007', 300000, '2020-06-24'),
('BRX-0008', 375000, '2020-06-24'),
('BRX-0009', 483000, '2020-06-24'),
('BRX-0010', 183000, '2020-06-24'),
('BRX-0011', 608000, '2020-06-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(248) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'vanrezky', 'vanrezkysadewa1@gmail.com', 'default.png', '$2y$10$CKzopz5HkuaoE.9GuMFhoeF2rIt0xF5Jg.Bevb78W2txwBdJXJwxq', 1, 1, 1592804077),
(2, 'Yensiska', 'yensiska@gmail.com', 'default.png', '$2y$10$q1fUUZ9Xd4cWb46lAdAg..s9hURx2Z6PBCV4PKzKF6pv7CcSGacWu', 2, 1, 1592807639),
(6, 'kasir', 'kasir@gmail.com', 'default.png', '$2y$10$JUzowKxWhHibbOdSS7xQeu55c9Z4eyAHaE5CRnQawgkYAkNzUCYqK', 3, 1, 1592808349),
(7, 'Administrator', 'admin@admin.com', 'default.png', '$2y$10$TeQIYhONz.f8WSlfB9R2YOE7lEsh/OYjcsbIv/3S3X1s7JjRh43c.', 1, 1, 1592969750),
(8, 'Bos Besar', 'bosgadang@gmail.com', 'default.png', '$2y$10$pK8YEcL4ayOzrcgZG1MZK.r29SpurvqzOBBC0OMpbFW6yVn/dDx8u', 2, 1, 1592969782);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_role`
--

CREATE TABLE `tb_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user_role`
--

INSERT INTO `tb_user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Pimpinan'),
(3, 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indeks untuk tabel `tb_sub_transaksi`
--
ALTER TABLE `tb_sub_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_resi` (`no_resi`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`no_resi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user_role`
--
ALTER TABLE `tb_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_sub_transaksi`
--
ALTER TABLE `tb_sub_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_user_role`
--
ALTER TABLE `tb_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_sub_transaksi`
--
ALTER TABLE `tb_sub_transaksi`
  ADD CONSTRAINT `no_resi` FOREIGN KEY (`no_resi`) REFERENCES `tb_transaksi` (`no_resi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
