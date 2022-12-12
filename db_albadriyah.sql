-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Des 2022 pada 09.47
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_albadriyah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(20) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_user`, `username`, `password`, `level`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nohp`, `foto`) VALUES
(1, 'rudihasan', '$2y$10$1t1n.WxrOdP781NQPR7BFunkwU3.EdI5vO/kZZ85VbYwPjSJQRnEu', 'Pimpinan', 'Rudi Hasan', 'Panyabungan', '2022-07-22', 'Padang Panjang', '08566550514', 'messages-1.jpg'),
(4, 'fadhil', '$2y$10$RZ5wbY/wSIiUPE4Ve05REeQJnf3JzdGwXROE6v.Vuc2qb8LiRLfsu', 'Admin', 'Fadhiil', 'Padang', '2022-08-02', 'Padang', '081266990000', 'people-3214687_1920.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `kode_jadwal` varchar(30) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `isi_kamar` varchar(20) NOT NULL,
  `tanggal_keberangkatan` date NOT NULL,
  `nopesawat` varchar(10) NOT NULL,
  `tanggal_kepulangan` date NOT NULL,
  `kuota_pendaftaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `kode_jadwal`, `id_paket`, `harga`, `isi_kamar`, `tanggal_keberangkatan`, `nopesawat`, `tanggal_kepulangan`, `kuota_pendaftaran`) VALUES
(2, 'JDL001', 1, 2000000000, '2 jen', '2022-12-16', '17', '2022-12-28', 200),
(3, 'JDL002', 4, 3000000, '2 jen', '2022-12-27', '5', '2022-12-31', 50),
(4, 'JDL003', 5, 12000000, '2 jen', '2022-12-12', '57', '2022-12-29', 250);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `kode_paket` varchar(30) NOT NULL,
  `jenis` varchar(30) DEFAULT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `pesawat` varchar(30) NOT NULL,
  `hotel_mekkah` varchar(100) NOT NULL,
  `hotel_madinah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `kode_paket`, `jenis`, `nama_paket`, `pesawat`, `hotel_mekkah`, `hotel_madinah`) VALUES
(1, 'PKT001', 'umroh', 'Satu', 'Air', 'Ko', 'KO'),
(4, 'PKT002', 'umroh', 'Dua', 'Air', 'K', 'KO'),
(5, 'PKT003', 'umroh', 'Dua', 'Lion Air', 'Syaidina', 'Syaidina');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `no_pembayaran` varchar(30) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_pend` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `bukti_transfer` varchar(100) NOT NULL,
  `status_pembayaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `no_pembayaran`, `id_pemesanan`, `id_pend`, `id_paket`, `tanggal_bayar`, `jumlah_bayar`, `bukti_transfer`, `status_pembayaran`) VALUES
(1, 'PB001', 1, 1, 1, '2022-12-10', 20000000, 'Screenshot (185).png', 'Pembayaran Di Terima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `no_pemesanan` varchar(30) NOT NULL,
  `id_pend` int(11) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `telah_bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `no_pemesanan`, `id_pend`, `tanggal_pemesanan`, `id_jadwal`, `id_paket`, `harga`, `telah_bayar`, `sisa`, `status`) VALUES
(1, 'PS001', 1, '2022-12-16', 2, 1, 2000000000, 20000000, 1980000000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pend` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `no_registrasi` varchar(11) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` varchar(10) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telpon_rumah` varchar(12) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `ukuran_pakaian` varchar(5) NOT NULL,
  `ahli_waris` varchar(30) NOT NULL,
  `hubungan` varchar(20) NOT NULL,
  `norekening` varchar(20) NOT NULL,
  `atas_nama` varchar(30) NOT NULL,
  `nama_bank` varchar(40) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pend`, `username`, `password`, `no_registrasi`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jk`, `nik`, `alamat`, `kota`, `provinsi`, `kode_pos`, `email`, `telpon_rumah`, `no_hp`, `ukuran_pakaian`, `ahli_waris`, `hubungan`, `norekening`, `atas_nama`, `nama_bank`, `foto`) VALUES
(2, 'ayu', '$2y$10$V1GP89PsoYrE4agFuqJ95OkfEJD1NRy9Vc5wXG3LsCLTiCIaEkKz6', 'REG001', 'Ayu Putri Anjani', 'Padang', '1998-10-10', 'Wanita', '1305081411900002', 'Padang', 'Padang', 'Sumatera Barat', '25581', 'ayu@gmail.com', '12345', '085364060619', 'XL', 'Anjani', 'Ibu Kandung', '134543', 'Anjani', 'Bank Indonesia (BI)', 'cliffs-5547648_1920.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`) USING BTREE;

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pend`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pend` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
