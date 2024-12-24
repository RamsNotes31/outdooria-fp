-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2024 at 06:07 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_outdooria_hikyu`
--

DELIMITER $$
--
-- Procedures
--
$$

$$

$$

$$

$$

$$

$$

$$

$$

--
-- Functions
--
$$

$$

$$

$$

$$

$$

$$

$$

$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `no_telp_admin` varchar(15) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `no_telp_admin`, `password_admin`, `tanggal_ditambahkan`, `foto_admin`) VALUES
('1', 'Rama Danadipa', 'rama@gmail.com', '089697100997', 'ramadanadipa', '2024-11-27 12:13:25', NULL),
('2', 'Panji Ihsanudin Fajri', 'panji@gmail.com', '085777419874', 'pnj1165', '2024-11-27 12:13:25', NULL),
('A00005', 'adada', 'admdain@example.com', '083334567890', 'pasdasword123', '2024-12-07 08:08:53', 'foto_admin.jpg'),
('N00003', 'Nama Admin', 'admin@example.com', '081234567890', 'password123', '2024-12-07 03:39:29', 'foto_admin.jpg'),
('N00005', 'Nama Admin2', 'admin2@example.com', '081234567892', 'password1232', '2024-12-07 03:39:29', 'foto_admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `alat_pendakian`
--

CREATE TABLE `alat_pendakian` (
  `id_alat` varchar(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `kategori` enum('primary','secondary','accessory','others') NOT NULL DEFAULT 'others',
  `stok` int NOT NULL DEFAULT '0',
  `harga_sewa` decimal(10,0) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alat_pendakian`
--

INSERT INTO `alat_pendakian` (`id_alat`, `nama_alat`, `kategori`, `stok`, `harga_sewa`, `foto_produk`, `deskripsi`) VALUES
('1', 'Tenda 4P', 'primary', 88, '55000', '', 'Tenda Untuk 4 Orang'),
('2', 'Tracking Pole', 'secondary', 67, '15000', '', 'Alat Bantuan'),
('A-J-00001', 'jam', 'accessory', 3, '21000', 'jam.jpg', 'jam'),
('O-K-00001', 'kompor', 'others', 6, '50000', 'kompor.jpg', 'untuk memasak'),
('S-L-00002', 'lampu', 'secondary', 10, '50000', 'tenda4p.jpg', 'untuk penerangan');

--
-- Triggers `alat_pendakian`
--
DELIMITER $$
CREATE TRIGGER `stok_alat_seri` AFTER INSERT ON `alat_pendakian` FOR EACH ROW BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE id_seri_baru VARCHAR(20);

    WHILE i <= NEW.stok DO
        SET id_seri_baru = seri_alat_baru();

        INSERT INTO seri (seri_alat, id_alat, kondisi, status_produk, tanggal_ditambahkan)
        VALUES (id_seri_baru, NEW.id_alat, 'baik', 'tersedia', CURRENT_TIMESTAMP);

        SET i = i + 1;
    END WHILE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id_chat` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_admin` varchar(11) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal_kirim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_chat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id_chat`, `id_user`, `id_admin`, `pesan`, `tanggal_kirim`, `foto_chat`) VALUES
('1', '2', '1', 'Ready min?', '2024-11-27 12:22:54', NULL),
('2', '1', '2', 'Stock masih ada?', '2024-11-27 12:22:54', NULL),
('C-00003', 'N00003', 'N00003', 'Halo, apakah stok masih ada?', '2024-12-07 03:46:28', 'foto_chat.jpg'),
('C-00004', 'W00004', 'A00005', 'Halo, apakah stok masih ada?', '2024-12-07 08:11:25', 'foto_chat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id_favorit` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_alat` varchar(11) NOT NULL,
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favorit`
--

INSERT INTO `favorit` (`id_favorit`, `id_user`, `id_alat`, `tanggal_ditambahkan`) VALUES
('1', '2', '1', '2024-11-27 12:23:40'),
('2', '1', '2', '2024-11-27 12:23:40'),
('K-00003', 'N00003', 'S-L-00002', '2024-12-07 03:47:04'),
('K-00004', 'W00004', 'S-L-00002', '2024-12-07 08:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_alat` varchar(11) NOT NULL,
  `komentar` text,
  `rating` decimal(2,1) DEFAULT NULL,
  `tanggal_feedback` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `id_user`, `id_alat`, `komentar`, `rating`, `tanggal_feedback`) VALUES
('1', '2', '1', 'Mantap', '4.5', '2024-11-27 12:21:59'),
('2', '1', '2', 'Kualitas Bagus', '4.0', '2024-11-27 12:21:59'),
('F-00003', 'N00003', 'S-L-00002', 'Kualitas bagus', '4.5', '2024-12-07 03:45:45'),
('F-00004', 'W00004', 'S-L-00002', 'Kualitas bagus', '4.5', '2024-12-07 08:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_pendakian`
--

CREATE TABLE `informasi_pendakian` (
  `id_informasi` varchar(11) NOT NULL,
  `id_admin` varchar(11) NOT NULL,
  `nama_gunung` varchar(100) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `harga_biaya` decimal(10,0) NOT NULL DEFAULT '0',
  `deskripsi` text NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_gunung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `informasi_pendakian`
--

INSERT INTO `informasi_pendakian` (`id_informasi`, `id_admin`, `nama_gunung`, `lokasi`, `harga_biaya`, `deskripsi`, `tanggal_update`, `foto_gunung`) VALUES
('1', '1', 'Gunung Lawu', 'Karanganyar, Jawa Tengah', '35000', 'Gunung Lawu adalah gunung berapi yang terletak di perbatasan antara Jawa Tengah dan Jawa Timur, Indonesia. Dengan ketinggian sekitar 3.265 meter di atas permukaan laut, Gunung Lawu dikenal sebagai salah satu gunung yang populer untuk pendakian. Gunung ini memiliki tiga puncak utama, yaitu Hargo Dumilah, Hargo Dalem, dan Hargo Dumiling. Selain itu, Gunung Lawu juga memiliki beberapa situs bersejarah dan spiritual, seperti Candi Cetho dan Candi Sukuh, yang menambah daya tariknya. Pendakian Gunung Lawu menawarkan pemandangan alam yang indah, hutan yang lebat, dan udara yang sejuk, menjadikannya destinasi favorit bagi para pendaki dan pecinta alam.', '2024-11-27 12:19:54', ''),
('2', '2', 'Gunung Prau', 'Temanggung, Jawa Tengah', '25000', 'Gunung Prau adalah salah satu gunung yang terletak di kawasan Dieng, Temanggung, Jawa Tengah, Indonesia. Dengan ketinggian sekitar 2.565 meter di atas permukaan laut, Gunung Prau dikenal sebagai salah satu destinasi favorit bagi para pendaki. Gunung ini menawarkan pemandangan yang menakjubkan, termasuk panorama matahari terbit dan terbenam yang spektakuler, serta pemandangan pegunungan di sekitarnya seperti Gunung Sindoro, Gunung Sumbing, dan Gunung Merbabu. Selain itu, Gunung Prau juga terkenal dengan padang bunga daisy yang indah di puncaknya, menjadikannya tempat yang ideal untuk berkemah dan menikmati keindahan alam. Pendakian Gunung Prau relatif mudah, sehingga cocok untuk pendaki pemula maupun berpengalaman.', '2024-11-27 12:19:54', ''),
('I-00003', 'N00003', 'Gunung Merapi', 'Yogyakarta, Indonesia', '50000', 'Gunung berapi aktif di Indonesia.', '2024-12-07 03:42:16', 'merapi.jpg'),
('I-00004', 'A00005', 'Gunung Merapi1', 'Yogyakarta, Indonesia', '50000', 'Gunung berapi aktif di Indonesia.', '2024-12-07 08:09:55', 'merapi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `seri_alat` varchar(11) NOT NULL,
  `tanggal_penyewaan` datetime NOT NULL,
  `tanggal_pengembalian` datetime NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `status_sewa` enum('menunggu','disewa','selesai','batal') NOT NULL DEFAULT 'menunggu',
  `bukti_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `id_user`, `seri_alat`, `tanggal_penyewaan`, `tanggal_pengembalian`, `total_harga`, `status_sewa`, `bukti_pembayaran`) VALUES
('1', '2', '1', '2024-11-27 19:28:52', '2024-11-28 19:28:52', '110000', 'menunggu', NULL),
('2', '1', '2', '2024-11-27 19:28:52', '2024-11-28 19:28:52', '30000', 'batal', NULL),
('P-00003', 'N00003', 'S-00003', '2024-12-07 10:00:00', '2024-12-08 10:00:00', '100000', 'selesai', 'bukti_pembayaran.jpg'),
('P-00004', 'N00003', 'S-00004', '2024-12-07 10:00:00', '2024-12-08 10:00:00', '100000', 'selesai', 'bukti_pembayaran.jpg'),
('P-00005', 'W00004', 'S-00005', '2024-12-07 10:00:00', '2024-12-08 10:00:00', '100000', 'disewa', 'bukti_pembayaran.jpg'),
('P-00006', 'W00004', 'S-00006', '2024-12-07 10:00:00', '2024-12-08 10:00:00', '100000', 'disewa', 'bukti_pembayaran.jpg');

--
-- Triggers `penyewaan`
--
DELIMITER $$
CREATE TRIGGER `update_stok_dan_status_produk` AFTER UPDATE ON `penyewaan` FOR EACH ROW BEGIN
    IF OLD.status_sewa = 'menunggu' AND NEW.status_sewa = 'disewa' THEN
        UPDATE alat_pendakian
        SET stok = stok - 1
        WHERE id_alat = (SELECT id_alat FROM seri WHERE seri_alat = NEW.seri_alat);

        UPDATE seri
        SET status_produk = 'disewa'
        WHERE seri_alat = NEW.seri_alat;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_dan_status_produk_selesai` AFTER UPDATE ON `penyewaan` FOR EACH ROW BEGIN
    IF OLD.status_sewa = 'disewa' AND NEW.status_sewa = 'selesai' THEN
        UPDATE alat_pendakian
        SET stok = stok + 1
        WHERE id_alat = (SELECT id_alat FROM seri WHERE seri_alat = NEW.seri_alat);

        UPDATE seri
        SET status_produk = 'tersedia'
        WHERE seri_alat = NEW.seri_alat;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `seri`
--

CREATE TABLE `seri` (
  `seri_alat` varchar(11) NOT NULL,
  `id_alat` varchar(11) NOT NULL,
  `kondisi` enum('baru','baik','minus') NOT NULL DEFAULT 'baik',
  `status_produk` enum('tersedia','disewa','dalam perawatan','rusak') NOT NULL DEFAULT 'tersedia',
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seri`
--

INSERT INTO `seri` (`seri_alat`, `id_alat`, `kondisi`, `status_produk`, `tanggal_ditambahkan`) VALUES
('1', '2', 'baru', 'tersedia', '2024-11-27 12:27:00'),
('2', '1', 'minus', 'dalam perawatan', '2024-11-27 12:27:00'),
('S-00003', 'S-L-00002', 'baik', 'tersedia', '2024-12-07 03:40:42'),
('S-00004', 'S-L-00002', 'baru', 'tersedia', '2024-12-07 03:40:42'),
('S-00005', 'S-L-00002', 'baik', 'disewa', '2024-12-07 03:40:42'),
('S-00006', 'S-L-00002', 'baik', 'disewa', '2024-12-07 03:40:42'),
('S-00007', 'S-L-00002', 'baik', 'tersedia', '2024-12-07 03:40:42'),
('S-00008', 'S-L-00002', 'baik', 'tersedia', '2024-12-07 03:40:42'),
('S-00009', 'S-L-00002', 'baik', 'tersedia', '2024-12-07 03:40:42'),
('S-00010', 'S-L-00002', 'baik', 'tersedia', '2024-12-07 03:40:42'),
('S-00011', 'S-L-00002', 'baik', 'tersedia', '2024-12-07 03:40:42'),
('S-00012', 'S-L-00002', 'baik', 'tersedia', '2024-12-07 03:40:42'),
('S-00014', 'O-K-00001', 'baru', 'tersedia', '2024-12-07 06:10:42'),
('S-00015', 'O-K-00001', 'baru', 'tersedia', '2024-12-07 06:10:44'),
('S-00017', 'O-K-00001', 'baru', 'tersedia', '2024-12-07 06:10:46'),
('S-00018', 'O-K-00001', 'baru', 'tersedia', '2024-12-07 06:10:48'),
('S-00019', 'O-K-00001', 'baru', 'tersedia', '2024-12-07 08:17:57'),
('S-00020', 'S-L-00002', 'baru', 'tersedia', '2024-12-07 08:18:09'),
('S-00021', 'S-L-00002', 'baru', 'tersedia', '2024-12-07 08:19:33'),
('S-00022', 'O-K-00001', 'baru', 'tersedia', '2024-12-07 08:19:59'),
('S-00023', 'A-J-00001', 'baik', 'tersedia', '2024-12-07 08:33:56'),
('S-00024', 'A-J-00001', 'baik', 'tersedia', '2024-12-07 08:33:56'),
('S-00025', 'A-J-00001', 'baik', 'tersedia', '2024-12-07 08:33:56'),
('S-00026', 'A-J-00001', 'baru', 'tersedia', '2024-12-07 08:35:55');

--
-- Triggers `seri`
--
DELIMITER $$
CREATE TRIGGER `update_stok_alat_pendakian` AFTER UPDATE ON `seri` FOR EACH ROW BEGIN
    IF OLD.status_produk = 'tersedia' AND (NEW.status_produk = 'dalam perawatan' OR NEW.status_produk = 'rusak') THEN
        UPDATE alat_pendakian
        SET stok = stok - 1
        WHERE id_alat = NEW.id_alat;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_alat_pendakian_delete` AFTER DELETE ON `seri` FOR EACH ROW BEGIN
    UPDATE alat_pendakian
    SET stok = stok - 1
    WHERE id_alat = OLD.id_alat;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_alat_pendakian_tersedia` AFTER UPDATE ON `seri` FOR EACH ROW BEGIN
    IF OLD.status_produk = 'rusak' OR OLD.status_produk = 'dalam perawatan'  AND (NEW.status_produk = 'tersedia') THEN
        UPDATE alat_pendakian
        SET stok = stok + 1
        WHERE id_alat = NEW.id_alat;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text,
  `tanggal_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `no_telepon`, `alamat`, `tanggal_daftar`, `foto_profil`) VALUES
('1', 'Marcellinus Sorongan', 'marcel@gmail.com', 'acell123', '0987654321', 'Sleman City Hall', '2024-11-27 12:10:17', NULL),
('2', 'Fahmi Aziz', 'fahmi@gmail.com', 'mii321', '1234567890', 'Godean', '2024-11-27 12:10:17', NULL),
('N00003', 'Nama User', 'user@example.com', 'password123', '081234567891', 'Alamat User', '2024-12-07 03:39:43', 'foto_profil.jpg'),
('W00004', 'wfawf', 'ufwawfafer@example.com', 'pfwafassword123', '081224567891', 'Alamat User', '2024-12-07 08:09:12', 'foto_profil.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_alat_dengan_favorit`
-- (See below for the actual view)
--
CREATE TABLE `view_alat_dengan_favorit` (
`jumlah_favorit` bigint
,`nama_alat` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_alat_dengan_rating`
-- (See below for the actual view)
--
CREATE TABLE `view_alat_dengan_rating` (
`jumlah_feedback` bigint
,`nama_alat` varchar(100)
,`rata_rata_rating` decimal(6,5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_bukti_pembayaran`
-- (See below for the actual view)
--
CREATE TABLE `view_bukti_pembayaran` (
`bukti_pembayaran` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_foto_alat`
-- (See below for the actual view)
--
CREATE TABLE `view_foto_alat` (
`foto_produk` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_foto_chat`
-- (See below for the actual view)
--
CREATE TABLE `view_foto_chat` (
`foto_chat` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_foto_gunung`
-- (See below for the actual view)
--
CREATE TABLE `view_foto_gunung` (
`foto_gunung` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `view_alat_dengan_favorit`
--
DROP TABLE IF EXISTS `view_alat_dengan_favorit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_alat_dengan_favorit`  AS SELECT `a`.`nama_alat` AS `nama_alat`, count(`f`.`id_favorit`) AS `jumlah_favorit` FROM (`alat_pendakian` `a` left join `favorit` `f` on((`a`.`id_alat` = `f`.`id_alat`))) GROUP BY `a`.`id_alat`, `a`.`nama_alat``nama_alat`  ;

-- --------------------------------------------------------

--
-- Structure for view `view_alat_dengan_rating`
--
DROP TABLE IF EXISTS `view_alat_dengan_rating`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_alat_dengan_rating`  AS SELECT `a`.`nama_alat` AS `nama_alat`, coalesce(avg(`f`.`rating`),0) AS `rata_rata_rating`, count(`f`.`id_feedback`) AS `jumlah_feedback` FROM (`alat_pendakian` `a` left join `feedback` `f` on((`a`.`id_alat` = `f`.`id_alat`))) GROUP BY `a`.`id_alat`, `a`.`nama_alat``nama_alat`  ;

-- --------------------------------------------------------

--
-- Structure for view `view_bukti_pembayaran`
--
DROP TABLE IF EXISTS `view_bukti_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_bukti_pembayaran`  AS SELECT `penyewaan`.`bukti_pembayaran` AS `bukti_pembayaran` FROM `penyewaan` WHERE (`penyewaan`.`bukti_pembayaran` is not null)  ;

-- --------------------------------------------------------

--
-- Structure for view `view_foto_alat`
--
DROP TABLE IF EXISTS `view_foto_alat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_foto_alat`  AS SELECT `alat_pendakian`.`foto_produk` AS `foto_produk` FROM `alat_pendakian` WHERE (`alat_pendakian`.`foto_produk` is not null)  ;

-- --------------------------------------------------------

--
-- Structure for view `view_foto_chat`
--
DROP TABLE IF EXISTS `view_foto_chat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_foto_chat`  AS SELECT `chat`.`foto_chat` AS `foto_chat` FROM `chat` WHERE (`chat`.`foto_chat` is not null)  ;

-- --------------------------------------------------------

--
-- Structure for view `view_foto_gunung`
--
DROP TABLE IF EXISTS `view_foto_gunung`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_foto_gunung`  AS SELECT `informasi_pendakian`.`foto_gunung` AS `foto_gunung` FROM `informasi_pendakian` WHERE (`informasi_pendakian`.`foto_gunung` is not null)  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `nama_admin` (`nama_admin`),
  ADD UNIQUE KEY `email_admin` (`email_admin`),
  ADD UNIQUE KEY `no_telp_admin` (`no_telp_admin`),
  ADD UNIQUE KEY `password_admin` (`password_admin`);

--
-- Indexes for table `alat_pendakian`
--
ALTER TABLE `alat_pendakian`
  ADD PRIMARY KEY (`id_alat`),
  ADD UNIQUE KEY `nama_alat` (`nama_alat`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id_favorit`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alat` (`id_alat`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alat` (`id_alat`);

--
-- Indexes for table `informasi_pendakian`
--
ALTER TABLE `informasi_pendakian`
  ADD PRIMARY KEY (`id_informasi`),
  ADD UNIQUE KEY `nama_gunung` (`nama_gunung`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `seri_alat` (`seri_alat`);

--
-- Indexes for table `seri`
--
ALTER TABLE `seri`
  ADD PRIMARY KEY (`seri_alat`),
  ADD KEY `id_alat` (`id_alat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `no_telepon` (`no_telepon`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `favorit_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `favorit_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `alat_pendakian` (`id_alat`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `alat_pendakian` (`id_alat`);

--
-- Constraints for table `informasi_pendakian`
--
ALTER TABLE `informasi_pendakian`
  ADD CONSTRAINT `informasi_pendakian_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `penyewaan_ibfk_2` FOREIGN KEY (`seri_alat`) REFERENCES `seri` (`seri_alat`);

--
-- Constraints for table `seri`
--
ALTER TABLE `seri`
  ADD CONSTRAINT `seri_ibfk_1` FOREIGN KEY (`id_alat`) REFERENCES `alat_pendakian` (`id_alat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
