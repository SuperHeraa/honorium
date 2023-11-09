-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Okt 2023 pada 15.26
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `honorium`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `keterangan`, `hak_akses`) VALUES
(1, 'Admin', 1),
(2, 'Pegawai', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rw_jabatan`
--

CREATE TABLE `rw_jabatan` (
  `id` int(11) NOT NULL,
  `bulantahun` varchar(20) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `honor_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rw_jabatan`
--

INSERT INTO `rw_jabatan` (`id`, `bulantahun`, `id_pegawai`, `nama_jabatan`, `honor_jabatan`) VALUES
(1, '092023', 38, 'Waka Kurikulum', 450000),
(2, '092023', 50, 'Admin Sosial Media', 150000),
(3, '092023', 37, 'Waka Kesiswaan', 300000),
(4, '092023', 37, 'Kepala Program Jurusan', 500000),
(5, '102023', 38, 'Waka Kurikulum', 450000),
(6, '102023', 42, 'Kepala Program Jurusan', 500000),
(7, '102023', 50, 'Admin Sosial Media', 150000),
(8, '102023', 37, 'Waka Kesiswaan', 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rw_jam`
--

CREATE TABLE `rw_jam` (
  `id` int(11) NOT NULL,
  `bulantahun` varchar(20) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `jumlah_jam` int(11) NOT NULL,
  `honor_perjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rw_jam`
--

INSERT INTO `rw_jam` (`id`, `bulantahun`, `id_pegawai`, `mapel`, `jumlah_jam`, `honor_perjam`) VALUES
(1, '092023', 38, 'ASJ', 6, 20000),
(2, '092023', 50, 'Sejarah Indo Kelas 11', 5, 20000),
(3, '092023', 50, 'Prakarya Kewirausahaan Kelas 10', 5, 20000),
(4, '092023', 37, 'Sejarah Indo Kelas 10 A', 7, 20000),
(5, '092023', 37, 'Sejarah Indo Kelas 10 B', 7, 20000),
(6, '102023', 38, 'ASJ', 6, 20000),
(7, '102023', 42, 'Sejarah Indo Kelas 10 B', 7, 20000),
(8, '102023', 42, 'Matematika kelas 10', 5, 20000),
(9, '102023', 50, 'Sejarah Indo Kelas 11', 5, 20000),
(10, '102023', 50, 'Prakarya Kewirausahaan Kelas 10', 5, 20000),
(11, '102023', 37, 'Sejarah Indo Kelas 10 A', 7, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absen` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `bulantahun` varchar(15) NOT NULL,
  `hadir` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `alfa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_absensi`
--

INSERT INTO `tb_absensi` (`id_absen`, `id_pegawai`, `bulantahun`, `hadir`, `izin`, `sakit`, `alfa`) VALUES
(19, 38, '082023', 20, 0, 0, 0),
(20, 42, '082023', 20, 0, 0, 0),
(21, 37, '082023', 15, 0, 5, 0),
(23, 48, '082023', 20, 0, 0, 0),
(24, 50, '082023', 20, 0, 0, 0),
(25, 38, '092023', 15, 0, 0, 0),
(26, 42, '092023', 0, 0, 0, 0),
(27, 48, '092023', 0, 0, 0, 0),
(28, 50, '092023', 0, 0, 0, 0),
(29, 37, '092023', 20, 0, 0, 0),
(31, 38, '102023', 4, 1, 0, 0),
(32, 42, '102023', 17, 1, 2, 0),
(33, 48, '102023', 10, 0, 1, 0),
(34, 50, '102023', 6, 0, 0, 0),
(35, 37, '102023', 15, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_arsip`
--

CREATE TABLE `tb_arsip` (
  `id` int(11) NOT NULL,
  `bulantahun` varchar(20) NOT NULL,
  `idp` int(11) NOT NULL,
  `jarak_transport` varchar(50) NOT NULL,
  `honor_transport` int(11) NOT NULL,
  `status_walas` int(11) NOT NULL,
  `hadir` int(11) NOT NULL,
  `honor_walas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_arsip`
--

INSERT INTO `tb_arsip` (`id`, `bulantahun`, `idp`, `jarak_transport`, `honor_transport`, `status_walas`, `hadir`, `honor_walas`) VALUES
(1, '092023', 38, '5 KM', 10000, 0, 15, 0),
(2, '092023', 42, '10 KM', 15000, 1, 0, 100000),
(3, '092023', 48, '10 KM', 15000, 0, 0, 0),
(4, '092023', 50, '10 KM', 15000, 0, 0, 0),
(5, '092023', 37, '5 KM', 10000, 1, 20, 100000),
(6, '102023', 38, '5 KM', 10000, 0, 4, 0),
(7, '102023', 42, '10 KM', 15000, 1, 17, 100000),
(8, '102023', 48, '10 KM', 15000, 0, 10, 0),
(9, '102023', 50, '10 KM', 15000, 0, 6, 0),
(10, '102023', 37, '5 KM', 10000, 1, 15, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_honorjam`
--

CREATE TABLE `tb_honorjam` (
  `id` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `honor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_honorjam`
--

INSERT INTO `tb_honorjam` (`id`, `jenis`, `honor`) VALUES
(1, 'per jam', 20000),
(2, 'walas', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_honor_kegiatan`
--

CREATE TABLE `tb_honor_kegiatan` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `bulantahun` varchar(15) NOT NULL,
  `nama_kegiatan` varchar(20) NOT NULL,
  `honor_kegiatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_honor_kegiatan`
--

INSERT INTO `tb_honor_kegiatan` (`id`, `id_pegawai`, `bulantahun`, `nama_kegiatan`, `honor_kegiatan`) VALUES
(27, 42, '092023', 'pembimbing prakerin', 200000),
(28, 37, '092023', 'a', 100000),
(29, 37, '092023', 'b', 50000),
(31, 38, '092023', 'Anbk SMP', 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `honor_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`, `honor_jabatan`) VALUES
(1, 'Kepala Sekolah', 1000000),
(2, 'Kepala Program Jurusan', 500000),
(3, 'Waka Kurikulum', 450000),
(4, 'Waka Kesiswaan', 300000),
(5, 'Waka Humas Hubin', 200000),
(15, 'Admin Sosial Media', 155000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jam_mengajar`
--

CREATE TABLE `tb_jam_mengajar` (
  `id_jam` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `jumlah_jam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jam_mengajar`
--

INSERT INTO `tb_jam_mengajar` (`id_jam`, `nama_mapel`, `jumlah_jam`) VALUES
(1, 'Sejarah Indo Kelas 10 A', 7),
(2, 'Sejarah Indo Kelas 10 B', 7),
(3, 'Sejarah Indo Kelas 11', 5),
(5, 'Prakarya Kewirausahaan Kelas 10', 5),
(6, 'Matematika kelas 10', 5),
(7, 'ASJ', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_transport` int(11) NOT NULL,
  `walas` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nama_pegawai`, `jenis_kelamin`, `alamat`, `id_transport`, `walas`, `image`, `username`, `password`, `hak_akses`) VALUES
(37, 'nana gajah paling ngeselin', 'P', 'Land of down', 2, 1, '1695887560.png', 'nanas', '$2y$10$M1PA.cNcq7IQSWlSAXrlXOX/JcGjxLVkezFu1g14YPxpdZeLrapCe', 2),
(38, 'AnjayaniYeah', 'L', 'tepi pantai', 2, 0, 'default_avatar.png', 'anjay', '$2y$10$hEg0UxWSq8BCS5DEYxLBUuuyV9Ek0etpakaPfvtsxBuaOgbj19N2W', 2),
(42, 'Balmon', 'L', 'Wakanda', 3, 1, 'default_avatar.png', 'momon', '$2y$10$hEg0UxWSq8BCS5DEYxLBUuuyV9Ek0etpakaPfvtsxBuaOgbj19N2W', 2),
(48, 'Kadita', 'P', 'Wakanda', 3, 0, '1695689166.png', 'kaditas', '$2y$10$PLGxSBLoWe/8xIC6yd/ts.wiHPd4gsCaEjVjOIR2dGVUPPYz19eBy', 1),
(50, 'Ling Lung', 'L', 'Land of down', 3, 0, 'default_avatar.png', 'ling', '$2y$10$hEg0UxWSq8BCS5DEYxLBUuuyV9Ek0etpakaPfvtsxBuaOgbj19N2W', 2),
(52, 'Molina', 'P', 'Land of down', 3, 0, '1695887408.png', 'molin', '$2y$10$hEg0UxWSq8BCS5DEYxLBUuuyV9Ek0etpakaPfvtsxBuaOgbj19N2W', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transport`
--

CREATE TABLE `tb_transport` (
  `id_transport` int(11) NOT NULL,
  `jarak` varchar(30) NOT NULL,
  `honor_transport` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transport`
--

INSERT INTO `tb_transport` (`id_transport`, `jarak`, `honor_transport`) VALUES
(1, '0 KM', 0),
(2, '5 KM', 10000),
(3, '10 KM', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_jabatan`
--

CREATE TABLE `tmp_jabatan` (
  `id_tmp` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `honor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tmp_jabatan`
--

INSERT INTO `tmp_jabatan` (`id_tmp`, `id_pegawai`, `id_jabatan`, `honor`) VALUES
(25, 37, 4, 300000),
(35, 50, 15, 150000),
(36, 52, 5, 200000),
(37, 38, 3, 450000),
(38, 42, 2, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_jam`
--

CREATE TABLE `tmp_jam` (
  `id_tmp` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_jam` int(11) NOT NULL,
  `jumlah_jam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tmp_jam`
--

INSERT INTO `tmp_jam` (`id_tmp`, `id_pegawai`, `id_jam`, `jumlah_jam`) VALUES
(109, 37, 1, 7),
(111, 50, 3, 5),
(112, 50, 5, 5),
(115, 38, 7, 6),
(118, 42, 2, 7),
(119, 42, 6, 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rw_jabatan`
--
ALTER TABLE `rw_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rw_jam`
--
ALTER TABLE `rw_jam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `tb_arsip`
--
ALTER TABLE `tb_arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_honorjam`
--
ALTER TABLE `tb_honorjam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_honor_kegiatan`
--
ALTER TABLE `tb_honor_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `tb_jam_mengajar`
--
ALTER TABLE `tb_jam_mengajar`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indeks untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `tb_transport`
--
ALTER TABLE `tb_transport`
  ADD PRIMARY KEY (`id_transport`);

--
-- Indeks untuk tabel `tmp_jabatan`
--
ALTER TABLE `tmp_jabatan`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indeks untuk tabel `tmp_jam`
--
ALTER TABLE `tmp_jam`
  ADD PRIMARY KEY (`id_tmp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rw_jabatan`
--
ALTER TABLE `rw_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rw_jam`
--
ALTER TABLE `rw_jam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tb_arsip`
--
ALTER TABLE `tb_arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_honorjam`
--
ALTER TABLE `tb_honorjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_honor_kegiatan`
--
ALTER TABLE `tb_honor_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_jam_mengajar`
--
ALTER TABLE `tb_jam_mengajar`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `tb_transport`
--
ALTER TABLE `tb_transport`
  MODIFY `id_transport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tmp_jabatan`
--
ALTER TABLE `tmp_jabatan`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tmp_jam`
--
ALTER TABLE `tmp_jam`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
