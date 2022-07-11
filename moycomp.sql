-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 02:24 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moycomp`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) UNSIGNED NOT NULL,
  `judul` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci,
  `penulis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglbuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgledit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `judul`, `isi`, `penulis`, `tglbuat`, `editor`, `tgledit`, `status`) VALUES
(1, 'Udinus', 'lorem ipsum', 'Admin', '2022-07-11 07:48:34', 'Admin', '2022-07-11 07:48:34', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `idcart` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `tglorder` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL DEFAULT 'Cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`idcart`, `orderid`, `userid`, `tglorder`, `status`) VALUES
(10, '15wKVT0nej25Y', 2, '2022-04-17 12:10:42', 'Selesai'),
(11, '16Up4DJh6ogno', 2, '2022-07-10 16:01:20', 'Cart');

-- --------------------------------------------------------

--
-- Table structure for table `detailorder`
--

CREATE TABLE `detailorder` (
  `detailid` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailorder`
--

INSERT INTO `detailorder` (`detailid`, `orderid`, `idproduk`, `qty`) VALUES
(13, '15wKVT0nej25Y', 1, 100),
(14, '16Up4DJh6ogno', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `namakategori` varchar(20) NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`, `tgldibuat`) VALUES
(1, 'Processor', '2022-04-17 07:28:34'),
(2, 'RAM', '2022-04-17 07:34:17'),
(3, 'Motherboard', '2022-04-17 12:15:40'),
(4, 'VGA', '2022-06-18 08:05:19'),
(5, 'PSU', '2022-06-18 08:05:19'),
(6, 'Casing PC', '2022-06-18 08:05:19'),
(7, 'SSD', '2022-06-18 08:05:19'),
(8, 'HDD', '2022-06-18 09:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `idkonfirmasi` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `namarekening` varchar(25) NOT NULL,
  `tglbayar` date NOT NULL,
  `tglsubmit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userid` int(11) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgljoin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(7) NOT NULL DEFAULT 'Member',
  `lastlogin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `namalengkap`, `email`, `password`, `notelp`, `alamat`, `tgljoin`, `role`, `lastlogin`) VALUES
(1, 'Admin', 'admin', '$2y$10$GJVGd4ji3QE8ikTBzNyA0uLQhiGd6MirZeSJV1O6nUpjSVp1eaKzS', '01010101', 'Indonesia', '2022-04-17 11:31:17', 'Admin', NULL),
(2, 'Yuma Mahdi Andika', 'yuma', '$2y$10$xXEMgj5pMT9EE0QAx3QW8uEn155Je.FHH5SuIATxVheOt0Z4rhK6K', '082223033728', 'Indonesia', '2022-04-16 11:30:40', 'Member', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no` int(11) NOT NULL,
  `metode` varchar(25) NOT NULL,
  `norek` varchar(25) NOT NULL,
  `logo` text,
  `an` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no`, `metode`, `norek`, `logo`, `an`) VALUES
(1, 'Bank BCA', '12121212', 'images/bca.jpg', 'Yuma Mahdi Andika'),
(2, 'Bank Mandiri', '13131313', 'images/mandiri.jpg', 'Yuma Mahdi Andika'),
(3, 'Bank BRI', '18181818', 'images/bri.png', 'Yuma Mahdi Andika');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaproduk` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `rate` int(11) NOT NULL,
  `hargabefore` int(11) NOT NULL,
  `hargaafter` int(11) NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `gambar`, `deskripsi`, `rate`, `hargabefore`, `hargaafter`, `tgldibuat`) VALUES
(1, 1, 'AMD Ryzen 5 3600', 'produk/ryzen5.jpg', 'CPU Cores 6\r\nThreads 12\r\nBase Clock 3.6GHz\r\nMax Boost Clock 4.2GHz\r\nTotal L2 Cache 3MB', 5, 2999999, 2500000, '2022-04-17 09:10:26'),
(2, 2, 'KLEVV CRAS X DDR4 RAM 16GB', 'produk/kleiv.jpg', 'Format : DDR4 Unbuffered DIMM\r\nCapacity : 16GB (8GB x2)/ 32GB(16GB x2)\r\nSpeed : 3200 16 - 18 - 18 - 38 @1.35V\r\nDimension : (L) 133.5 x (W) 51 x (H) 8mm\r\nWarranty Limited : Lifetime Warranty', 3, 1299000, 999000, '2022-04-17 12:16:53'),
(3, 3, 'ROG Maximus XII Extreme', 'produk/asusrog.png', 'Intel Z490, 4 x DDR4 up to 4800MHz (OC), Socket 1200\r\nE-ATX Form Factor', 4, 13000000, 7700000, '2022-04-17 09:24:13'),
(4, 4, 'Geforce RTX 3090', 'produk/rtx3090.png', 'GPU GeForce RTX 3090\r\nCUDA cores 10496\r\nVideo Memory 24GB GDDR6X\r\nMemory Bus 384-bit\r\nEngine Clock Boost: 1695 MHz\r\nMemory Clock 19.5 Gbps\r\nPCI Express 4.0 16x', 5, 31000000, 27500000, '2022-04-17 09:24:13'),
(5, 5, 'Corsair CX550', 'produk/cx550.jpg', 'Corsair CX550 Power Supply (PSU) CX Series 550 Watt 80 PLUS', 4, 1050000, 950000, '2022-04-17 09:24:13'),
(6, 6, 'Cube Byron', 'produk/cube.jpg', 'CUBE GAMING LICHT - ATX - LEFT SIDE TEMPERED GLASS - PSU COVER', 3, 425000, 380000, '2022-04-17 09:24:13'),
(7, 6, 'Case Infinity Vesta', 'produk/vesta.jpg', 'Model : VESTA\r\nSize : L398x W200 x H420\r\n3.5" x 2 / 2.5" x 2 / USB 2.0 x 2 / USB 3 x 1\r\nFAN UP TO 6 FAN\r\nMotherboard : Standart ATX, Micro ATx\r\nPower Supply : Optional Standart ATX', 4, 390000, 345000, '2022-04-17 09:24:13'),
(8, 7, 'Samsung SSD 980 Pro', 'produk/ssd980.jpg', 'PCIe Gen 4.0 interface-Up to 7,000 MB/s read and 5,000 MB/s write speeds-5-year limited warranty or 1,200 TBW', 5, 5250000, 4765000, '2022-04-17 09:24:13'),
(9, 8, 'WDC Blue 500 GB', 'produk/16aZzsWXY0tHM.jpg', 'Brand: WD ( Western Digital ) Series: Blue Kapasitas: 500GB Kecepatan Rotasi: 7200RPM Ukuran : 3.5 Inch Penyimpanan: Internal Interface: SATA Suport Untuk: PC (Portable Computer) / Desktop', 3, 190000, 165000, '2022-06-18 09:09:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `judul` (`judul`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`),
  ADD UNIQUE KEY `orderid` (`orderid`),
  ADD KEY `orderid_2` (`orderid`);

--
-- Indexes for table `detailorder`
--
ALTER TABLE `detailorder`
  ADD PRIMARY KEY (`detailid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`idkonfirmasi`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idkategori` (`idkategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `detailorder`
--
ALTER TABLE `detailorder`
  MODIFY `detailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `idkonfirmasi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailorder`
--
ALTER TABLE `detailorder`
  ADD CONSTRAINT `idproduk` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderid` FOREIGN KEY (`orderid`) REFERENCES `cart` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `login` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `idkategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
