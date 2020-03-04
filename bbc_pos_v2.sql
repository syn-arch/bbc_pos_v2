-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 09:43 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbc_pos_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_menu`
--

CREATE TABLE `akses_menu` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_menu`
--

INSERT INTO `akses_menu` (`id`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(5, 1, 4),
(6, 1, 5),
(7, 1, 6),
(22, 1, 3),
(23, 1, 7),
(25, 4, 1),
(26, 4, 6),
(27, 6, 1),
(28, 6, 2),
(29, 6, 4),
(30, 6, 6),
(31, 6, 7),
(32, 4, 4),
(33, 4, 2),
(34, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `akses_submenu`
--

CREATE TABLE `akses_submenu` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_submenu`
--

INSERT INTO `akses_submenu` (`id`, `id_role`, `id_submenu`) VALUES
(14, 1, 1),
(15, 1, 2),
(16, 1, 3),
(18, 1, 5),
(19, 1, 6),
(20, 1, 7),
(21, 1, 8),
(22, 1, 9),
(23, 1, 10),
(24, 1, 11),
(25, 1, 12),
(39, 1, 13),
(40, 1, 4),
(51, 1, 14),
(54, 1, 15),
(55, 1, 16),
(57, 4, 1),
(58, 4, 13),
(59, 4, 2),
(60, 4, 3),
(61, 4, 14),
(62, 6, 1),
(63, 6, 9),
(66, 6, 6),
(67, 6, 15),
(68, 6, 2),
(69, 6, 3),
(70, 6, 14),
(71, 6, 16),
(72, 4, 7),
(73, 4, 12),
(74, 4, 9),
(75, 4, 10),
(76, 4, 11),
(77, 4, 8),
(78, 1, 17),
(79, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` int(11) NOT NULL,
  `barcode` varchar(128) DEFAULT NULL,
  `kd_departemen` int(11) NOT NULL,
  `kd_supplier` int(11) NOT NULL,
  `kd_kelas` int(11) NOT NULL,
  `nm_barang` varchar(128) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `ada_barcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `barcode`, `kd_departemen`, `kd_supplier`, `kd_kelas`, `nm_barang`, `harga_jual`, `harga_beli`, `profit`, `stok`, `diskon`, `gambar`, `ada_barcode`) VALUES
(11, '8886008101053', 1, 1, 10, 'Aqua Botol 600ml', 6000, 1000, 5000, 14, 0, 'white-image8.png', 1),
(12, '', 2, 1, 12, 'Mouse NYK', 8500, 4500, 4000, 7, 0, 'images_(1).jpg', 0),
(13, '', 2, 1, 12, 'Keyboard NYK', 10000, 4500, 5500, 1, 0, 'images_(2).jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `kd_departemen` int(11) NOT NULL,
  `nm_departemen` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`kd_departemen`, `nm_departemen`) VALUES
(1, 'Food'),
(2, 'Non Food');

-- --------------------------------------------------------

--
-- Table structure for table `detil_transaksi`
--

CREATE TABLE `detil_transaksi` (
  `id` int(11) NOT NULL,
  `kd_transaksi` varchar(30) NOT NULL,
  `kd_user` varchar(6) NOT NULL,
  `kd_barang` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_transaksi`
--

INSERT INTO `detil_transaksi` (`id`, `kd_transaksi`, `kd_user`, `kd_barang`, `qty`, `total`, `status`) VALUES
(38, 'T-030220C3CA66', '1', '12', 2, 17000, 'selesai'),
(39, 'T-030220C3CA66', '1', '13', 4, 30000, 'selesai'),
(40, 'T-03022064640D', '1', '12', 3, 25500, 'selesai'),
(41, 'T-030220FC1C8F', '1', '13', 10, 75000, 'selesai'),
(42, 'T-030220208BD6', '1', '12', 1, 8500, 'selesai'),
(43, 'T-030220AAEE21', '1', '11', 5, 29100, 'selesai'),
(44, 'T-0302207BD9B4', '1', '12', 1, 8500, 'selesai'),
(45, 'T-0302207BD9B4', '1', '13', 4, 40000, 'selesai'),
(46, 'T-030220493DF7', '1', '13', 0, 10000, 'selesai'),
(47, 'T-030220493DF7', '1', '12', 1, 8500, 'selesai'),
(48, 'T-030220493DF7', '1', '12', 1, 8500, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kd_kelas` int(11) NOT NULL,
  `kd_departemen` int(11) NOT NULL,
  `nm_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `kd_departemen`, `nm_kelas`) VALUES
(9, 1, 'Snack'),
(10, 1, 'Drink'),
(11, 2, 'Pakaian'),
(12, 2, 'Attribut Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nm_menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nm_menu`) VALUES
(1, 'Admin'),
(2, 'Master'),
(3, 'Akses'),
(4, 'Transaksi'),
(5, 'Laporan'),
(6, 'User'),
(7, 'Utilities');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `kd_kembali` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `kd_user` int(11) NOT NULL,
  `tgl` varchar(128) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nm_role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nm_role`) VALUES
(1, 'Owner'),
(4, 'Admin'),
(6, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `tgl` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id`, `kd_barang`, `tgl`, `status`, `jumlah`, `keterangan`) VALUES
(1, 13, '2020-02-03', 'Stok Masuk', 20, 'stok masuk');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `id_menu` varchar(128) NOT NULL,
  `nm_submenu` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `id_menu`, `nm_submenu`, `url`, `icon`) VALUES
(1, '1', 'Dashboard', 'admin', 'fa fa-tachometer-alt'),
(2, '6', 'My Profile', 'user', 'fa fa-user'),
(3, '6', 'Edit Profile', 'user/edit_profile', 'fa fa-edit'),
(4, '3', 'Pengaturan Hak Akses', 'akses', 'fa fa-shield-alt'),
(6, '4', 'Transaksi', 'transaksi', 'fa fa-dollar'),
(7, '4', 'Pengaturan Stok', 'transaksi/stok', 'fa fa-square'),
(8, '5', 'Laporan Penjualan', 'laporan', 'fa fa-calendar'),
(9, '2', 'Data Barang', 'master', 'fa fa-stop'),
(10, '2', 'Data Departemen', 'master/departemen', 'fa fa-th-large'),
(11, '2', 'Data Supplier', 'master/supplier', 'fa fa-truck'),
(12, '2', 'Data Petugas', 'master/petugas', 'fa fa-users'),
(13, '1', 'Konfigurasi', 'admin/config', 'fa fa-cog'),
(14, '6', 'Ubah Password', 'user/ubah_password', 'fa fa-key'),
(15, '4', 'Pengembalian', 'transaksi/pengembalian', 'fa fa-arrow-left'),
(16, '7', 'Cetak Barcode', 'utilities', 'fa fa-barcode'),
(17, '5', 'Riwayat Transaksi', 'laporan/riwayat', 'fa fa-calendar'),
(18, '7', 'Backup Database', 'utilities/backup', 'fa fa-download');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kd_supplier` int(11) NOT NULL,
  `nm_supplier` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `telepon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kd_supplier`, `nm_supplier`, `alamat`, `telepon`) VALUES
(1, 'PT.Cocacolaa', 'Kp.Situraci1', '0838226231702');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `nm_toko` varchar(128) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `nm_toko`, `telepon`, `alamat`, `gambar`, `keterangan`) VALUES
(1, 'Business center', '083822623170', 'Jl. Babakan Tiga No. 32 Kec. Ciwidey Kab. Bandung', 'kisspng-thumb-computer-icons-finger-5b2d415a36ddd0_4643786515296925062248.png', 'Selamat datang dan selamat berbelanja. \r\nMau sekalian pulsanya kak ? :)');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kd_transaksi` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `kd_user` varchar(30) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tunai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kd_transaksi`, `tgl`, `kd_user`, `total_bayar`, `tunai`) VALUES
('T-030220208BD6', '2020-02-03', '1', 8500, 10000),
('T-030220493DF7', '2020-03-04', '1', 27000, 30000),
('T-03022064640D', '2020-02-03', '1', 25500, 30000),
('T-0302207BD9B4', '2020-02-03', '1', 48500, 50000),
('T-030220AAEE21', '2020-02-03', '1', 29100, 30000),
('T-030220C3CA66', '2020-02-03', '1', 47000, 50000),
('T-030220FC1C8F', '2020-02-03', '1', 75000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kd_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nm_user` varchar(30) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kd_user`, `id_role`, `nm_user`, `alamat`, `telepon`, `jk`, `email`, `password`, `gambar`) VALUES
(1, 1, 'Adiatna Sukmana', 'Kp.Situraci', '083822623170', 'Laki-Laki', 'adiatna@gmail.com', '$2y$10$htzOeUT2C7nIV6ija5/0keVmuSSsWRIjpbk8VDmwGduEWSkN8kBOC', 'man-3.png'),
(2, 6, 'Muhammad Rivaldi', 'Kp.Nangkerok', '083822623170', 'Laki-Laki', 'rivaldi@gmail.com', '$2y$10$QgmnkJo3Vhp.2ZuHk8t5O.jClYBsp303iXPLVDgpwhHqJPCMYnz5S', 'man-2.png'),
(3, 4, 'Abdurrahman Shah', 'Kp.Rawabogo', '083822623170', 'Laki-Laki', 'abdurrahman@gmail.com', '$2y$10$r6sTDNIduaKBN6UxOJMraOiyhaxFXW78ZGQFit3sNDDk0duPp8ud6', 'man.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_menu`
--
ALTER TABLE `akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akses_submenu`
--
ALTER TABLE `akses_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`kd_departemen`);

--
-- Indexes for table `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`kd_kembali`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kd_supplier`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kd_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_menu`
--
ALTER TABLE `akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `akses_submenu`
--
ALTER TABLE `akses_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `kd_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `kd_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kd_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `kd_kembali` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `kd_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `kd_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
