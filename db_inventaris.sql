-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jan 2022 pada 20.14
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `waktu_keluar` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `kode_barang`, `jumlah_keluar`, `tgl_keluar`, `waktu_keluar`) VALUES
(10, 'BRG-1212210001', 1, '2021-12-12', '00:00:00'),
(11, 'BRG-1212210002', 1, '2021-12-12', '00:00:00'),
(12, 'BRG-1212210003', 1, '2021-12-12', '00:00:00'),
(13, 'BRG-1312210004', 2, '2021-12-13', '00:00:00'),
(14, 'BRG-1312210005', 1, '2021-12-13', '00:00:00'),
(15, 'BRG-1812210006', 2, '2021-12-18', '00:00:00'),
(21, 'BRG-1212210001', 1, '2021-12-18', '00:00:00'),
(23, 'BRG-1212210001', 1, '2021-12-22', '18:33:39'),
(26, 'BRG-1212210001', 1, '2021-12-24', '12:50:53'),
(31, 'BRG-1201220001', 100, '2022-01-12', '00:20:26');

--
-- Trigger `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `insert_stok_barang_keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW UPDATE `stok_barang` SET `stok_barang`.`keluar` = `stok_barang`.`keluar` + NEW.jumlah_keluar WHERE `stok_barang`.`kode_barang` = NEW.kode_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `kode_barang` varchar(30) NOT NULL,
  `kategori_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `waktu_masuk` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`kode_barang`, `kategori_barang`, `nama_barang`, `harga`, `jumlah_masuk`, `tgl_masuk`, `waktu_masuk`) VALUES
('BRG-1201220001', 1, 'tes', 123123, 123, '2022-01-12', '00:16:52'),
('BRG-1212210001', 1, 'Pensil', 2000, 5, '2021-12-12', '00:00:00'),
('BRG-1212210002', 2, 'Monitor', 2000000, 5, '2021-12-12', '00:00:00'),
('BRG-1212210003', 1, 'Penghapus', 500, 5, '2021-12-12', '00:00:00'),
('BRG-1312210004', 1, 'Komputer', 1000000, 5, '2021-12-13', '00:00:00'),
('BRG-1312210005', 2, 'HP', 1500000, 5, '2021-12-13', '00:00:00'),
('BRG-1812210006', 1, 'Laptop', 2000000, 5, '2021-12-18', '00:00:00');

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `insert_stok_barang_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW INSERT INTO stok_barang (kode_barang, masuk, keluar) VALUES (NEW.kode_barang, NEW.jumlah_masuk, 0)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_barang_masuk` BEFORE UPDATE ON `barang_masuk` FOR EACH ROW UPDATE `stok_barang` SET `stok_barang`.`masuk` = NEW.jumlah_masuk WHERE `stok_barang`.`kode_barang` = NEW.kode_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `kategori`) VALUES
(1, 'Barang Pakai'),
(2, 'Barang Baku');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_barang`
--

CREATE TABLE `stok_barang` (
  `kode_barang` varchar(30) NOT NULL,
  `masuk` int(11) NOT NULL,
  `keluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_barang`
--

INSERT INTO `stok_barang` (`kode_barang`, `masuk`, `keluar`) VALUES
('BRG-1201220001', 123, 100),
('BRG-1212210001', 5, 4),
('BRG-1212210002', 5, 1),
('BRG-1212210003', 5, 1),
('BRG-1312210004', 5, 2),
('BRG-1312210005', 5, 1),
('BRG-1812210006', 5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `address`, `phone_number`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Kota Madiun', '085674826800', 'default.jpg', '$2y$10$eYmrDGiSo.kYeOlCJ16mL.5svYfru9EuCf5dVaRnWI1Yhlbh1Zis6', 1, 1, 1634922345),
(2, 'Petugas', 'petugas@gmail.com', 'Madiun', '085674826794', 'default.jpg', '$2y$10$ma563W8sdbGTkocsLKxWbOEpDJ2CEaP0ova7xYmvP/BKa7aAF7sIS', 2, 1, 1634925897),
(3, 'User', 'user@gmail.com', 'Madiun', '085674826794', 'default.jpg', '$2y$10$j3CnaVPc.ht2K2CYn2KsrOsbJKnUgzRoMSH46MnCpLtznjVxPKQ5O', 3, 1, 1637549378);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 1, 3),
(7, 3, 6),
(42, 1, 5),
(43, 2, 6),
(44, 2, 3),
(47, 1, 6),
(49, 1, 15),
(51, 2, 2),
(52, 3, 2),
(55, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Home'),
(3, 'Data'),
(4, 'Data'),
(5, 'Laporan'),
(6, 'User'),
(10, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Administrator'),
(2, 'Petugas'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 6, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 1, 'Data Users', 'admin/datausers', 'fas fa-fw fa-users', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 0),
(8, 10, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(9, 10, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(20, 5, 'Cetak Laporan', 'laporan', 'fas fa-fw fa-file', 1),
(21, 3, 'Stok Barang', 'data', 'fas fa-fw fa-folder', 1),
(22, 3, 'Kategori Barang', 'data/kategori', 'fas fa-fw fa-folder', 1),
(23, 3, 'Barang Masuk', 'data/barangmasuk', 'fas fa-fw fa-folder-plus', 1),
(213, 3, 'Barang Keluar', 'data/barangkeluar', 'fas fa-fw fa-folder-minus', 1),
(216, 2, 'Dashboard', 'user/dashboard', 'fas fa-fw fa-tachometer-alt', 1),
(217, 4, 'Barang', 'user/barang', 'fas fa-fw fa-folder', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `fk_kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `fk_kategori_barang` (`kategori_barang`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `fk_kode_barang` FOREIGN KEY (`kode_barang`) REFERENCES `barang_masuk` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `fk_kategori_barang` FOREIGN KEY (`kategori_barang`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD CONSTRAINT `fk_barang_masuk_barang` FOREIGN KEY (`kode_barang`) REFERENCES `barang_masuk` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
