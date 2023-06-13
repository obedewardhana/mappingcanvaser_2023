-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2022 pada 06.56
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `des_holt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data`
--

CREATE TABLE `tb_data` (
  `id_data` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_jenis` varchar(11) NOT NULL,
  `jumlah` float NOT NULL,
  `kesehatan` float NOT NULL,
  `pendidikan` float NOT NULL,
  `dayabeli` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_data`
--

INSERT INTO `tb_data` (`id_data`, `tanggal`, `kode_jenis`, `jumlah`, `kesehatan`, `pendidikan`, `dayabeli`) VALUES
(18, '2020-11-04', 'J02', 69.3301, 82.14, 63.7, 63.69),
(19, '2019-11-04', 'J02', 69.1643, 82.08, 63.35, 63.63),
(20, '2018-11-04', 'J02', 68.4885, 81.68, 62.95, 62.48),
(21, '2017-11-04', 'J02', 67.8957, 81.45, 62.82, 61.17),
(22, '2016-11-04', 'J02', 67.4905, 81.34, 62.76, 60.22),
(23, '2015-06-05', 'J02', 66.7539, 81.23, 61.67, 59.38),
(24, '2014-03-05', 'J02', 66.1461, 80.77, 60.69, 59.04),
(25, '2013-11-05', 'J02', 65.6526, 80.75, 59.7, 58.7),
(26, '2012-11-05', 'J02', 64.8821, 80.72, 57.98, 58.36),
(27, '2011-11-05', 'J02', 64.4807, 80.71, 57.36, 57.91),
(28, '2010-11-05', 'J02', 63.5135, 80.68, 54.98, 57.76);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `kode_jenis` varchar(16) NOT NULL,
  `nama_jenis` varchar(255) DEFAULT NULL,
  `hasil` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenis`
--

INSERT INTO `tb_jenis` (`kode_jenis`, `nama_jenis`, `hasil`) VALUES
('J02', 'IPM', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periode`
--

CREATE TABLE `tb_periode` (
  `kode_periode` varchar(16) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_periode`
--

INSERT INTO `tb_periode` (`kode_periode`, `tanggal`) VALUES
('P01', '2020-01-01'),
('P02', '2020-02-01'),
('P03', '2020-03-01'),
('P04', '2020-04-01'),
('P05', '2020-05-01'),
('P06', '2020-06-01'),
('P07', '2020-07-01'),
('P08', '2020-08-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_relasi`
--

CREATE TABLE `tb_relasi` (
  `ID` int(11) NOT NULL,
  `kode_periode` varchar(16) DEFAULT NULL,
  `kode_jenis` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_relasi`
--

INSERT INTO `tb_relasi` (`ID`, `kode_periode`, `kode_jenis`, `nilai`) VALUES
(1, 'P01', 'J01', 67),
(4, 'P02', 'J01', 95),
(7, 'P03', 'J01', 72),
(10, 'P04', 'J01', 76),
(13, 'P05', 'J01', 62),
(19, 'P06', 'J01', 85),
(22, 'P07', 'J01', 97),
(25, 'P08', 'J01', 88);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Adis', 'adis', 'adis'),
(3, 'Eko', 'eko', 'eko');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_data`
--
ALTER TABLE `tb_data`
  ADD PRIMARY KEY (`id_data`);

--
-- Indeks untuk tabel `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`kode_jenis`);

--
-- Indeks untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`kode_periode`);

--
-- Indeks untuk tabel `tb_relasi`
--
ALTER TABLE `tb_relasi`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_data`
--
ALTER TABLE `tb_data`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `tb_relasi`
--
ALTER TABLE `tb_relasi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
