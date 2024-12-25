-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 25, 2024 at 01:45 PM
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
-- Database: `outdooria_hikyu`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_admin` (IN `p_nama_admin` VARCHAR(100), IN `p_email_admin` VARCHAR(100), IN `p_no_telp_admin` VARCHAR(15), IN `p_password_admin` VARCHAR(255), IN `p_foto_admin` VARCHAR(255))   BEGIN
    DECLARE id_admin_baru VARCHAR(10);
    SET id_admin_baru = id_admin_baru(p_nama_admin);
    
    INSERT INTO admin (id_admin, nama_admin, email_admin, no_telp_admin, password_admin, tanggal_ditambahkan, foto_admin)
    VALUES (id_admin_baru, p_nama_admin, p_email_admin, p_no_telp_admin, p_password_admin, CURRENT_TIMESTAMP, p_foto_admin);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_alat_pendakian` (IN `p_nama_alat` VARCHAR(100), IN `p_kategori` ENUM('primary','secondary','accessory','others'), IN `p_stok` INT, IN `p_harga_sewa` DECIMAL(10,0), IN `p_foto_produk` VARCHAR(255), IN `p_deskripsi` TEXT)   BEGIN
    DECLARE id_alat_baru VARCHAR(10);
    SET id_alat_baru = id_alat_baru(p_nama_alat, p_kategori);
    
    INSERT INTO alat_pendakian (id_alat, nama_alat, kategori, stok, harga_sewa, foto_produk, deskripsi)
    VALUES (id_alat_baru, p_nama_alat, p_kategori, p_stok, p_harga_sewa, p_foto_produk, p_deskripsi);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_chat` (IN `p_id_user` VARCHAR(10), IN `p_id_admin` VARCHAR(10), IN `p_pesan` TEXT, IN `p_foto_chat` VARCHAR(255))   BEGIN
    DECLARE id_chat_baru VARCHAR(10);
    SET id_chat_baru = id_chat_baru();
    
    INSERT INTO chat (id_chat, id_user, id_admin, pesan, tanggal_kirim, foto_chat)
    VALUES (id_chat_baru, p_id_user, p_id_admin, p_pesan, CURRENT_TIMESTAMP, p_foto_chat);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_favorit` (IN `p_id_user` VARCHAR(10), IN `p_id_alat` VARCHAR(10))   BEGIN
    DECLARE id_favorit_baru VARCHAR(10);
    SET id_favorit_baru = id_favorit_baru();
    
    INSERT INTO favorit (id_favorit, id_user, id_alat, tanggal_ditambahkan)
    VALUES (id_favorit_baru, p_id_user, p_id_alat, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_feedback` (IN `p_id_user` VARCHAR(10), IN `p_id_alat` VARCHAR(10), IN `p_komentar` TEXT, IN `p_rating` DECIMAL(2,1))   BEGIN
    DECLARE id_feedback_baru VARCHAR(10);
    SET id_feedback_baru = id_feedback_baru();
    
    INSERT INTO feedback (id_feedback, id_user, id_alat, komentar, rating, tanggal_feedback)
    VALUES (id_feedback_baru, p_id_user, p_id_alat, p_komentar, p_rating, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_informasi_pendakian` (IN `p_id_admin` VARCHAR(10), IN `p_nama_gunung` VARCHAR(100), IN `p_lokasi` VARCHAR(255), IN `p_harga_biaya` DECIMAL(10,0), IN `p_deskripsi` TEXT, IN `p_foto_gunung` VARCHAR(255))   BEGIN
    DECLARE id_informasi_baru VARCHAR(10);
    SET id_informasi_baru = id_informasi_baru();
    
    INSERT INTO informasi_pendakian (id_informasi, id_admin, nama_gunung, lokasi, harga_biaya, deskripsi, tanggal_update, foto_gunung)
    VALUES (id_informasi_baru, p_id_admin, p_nama_gunung, p_lokasi, p_harga_biaya, p_deskripsi, CURRENT_TIMESTAMP, p_foto_gunung);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_penyewaan` (IN `p_id_user` VARCHAR(10), IN `p_seri_alat` VARCHAR(10), IN `p_tanggal_penyewaan` DATETIME, IN `p_tanggal_pengembalian` DATETIME, IN `p_total_harga` DECIMAL(10,0), IN `p_bukti_pembayaran` VARCHAR(255))   BEGIN
    DECLARE id_penyewaan_baru VARCHAR(10);
    SET id_penyewaan_baru = id_penyewaan_baru();
    
    INSERT INTO penyewaan (id_penyewaan, id_user, seri_alat, tanggal_penyewaan, tanggal_pengembalian, total_harga, status_sewa, bukti_pembayaran)
    VALUES (id_penyewaan_baru, p_id_user, p_seri_alat, p_tanggal_penyewaan, p_tanggal_pengembalian, p_total_harga, 'menunggu', p_bukti_pembayaran);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_seri` (IN `p_id_alat` VARCHAR(10), IN `p_kondisi` ENUM('baru','baik','minus'), IN `p_status_produk` ENUM('tersedia','disewa','dalam perawatan','rusak'))   BEGIN
    DECLARE id_seri_baru VARCHAR(10);
    SET id_seri_baru = seri_alat_baru();
    
    INSERT INTO seri (seri_alat, id_alat, kondisi, status_produk, tanggal_ditambahkan)
    VALUES (id_seri_baru, p_id_alat, p_kondisi, p_status_produk, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_user` (IN `p_nama` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(255), IN `p_no_telepon` VARCHAR(15), IN `p_alamat` TEXT, IN `p_foto_profil` VARCHAR(255))   BEGIN
    DECLARE id_user_baru VARCHAR(10);
    SET id_user_baru = id_user_baru(p_nama);
    
    INSERT INTO users (id_user, nama, email, password, no_telepon, alamat, tanggal_daftar, foto_profil)
    VALUES (id_user_baru, p_nama, p_email, p_password, p_no_telepon, p_alamat, CURRENT_TIMESTAMP, p_foto_profil);
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `id_admin_baru` (`nama_admin` VARCHAR(100)) RETURNS VARCHAR(10) CHARSET utf8mb4 DETERMINISTIC READS SQL DATA BEGIN
    DECLARE id_admin_baru VARCHAR(10);
    DECLARE huruf_depan VARCHAR(1);
    DECLARE urutan INT;
    DECLARE urutan_str VARCHAR(5);

    SET huruf_depan = UPPER(LEFT(nama_admin, 1));

    SELECT COUNT(*) INTO urutan FROM admin;

    SET urutan = urutan + 1;
    SET urutan_str = LPAD(urutan, 5, '0');
    SET id_admin_baru = CONCAT(huruf_depan, urutan_str);

    WHILE EXISTS (SELECT 1 FROM admin WHERE id_admin = id_admin_baru) DO
        SET urutan = urutan + 1;
        SET urutan_str = LPAD(urutan, 5, '0');
        SET id_admin_baru = CONCAT(huruf_depan, urutan_str);
    END WHILE;

    RETURN id_admin_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `id_alat_baru` (`p_nama_alat` VARCHAR(100), `p_kategori` ENUM('primary','secondary','accessory','others')) RETURNS VARCHAR(10) CHARSET utf8mb4 DETERMINISTIC READS SQL DATA BEGIN
    DECLARE huruf_kategori CHAR(1);
    DECLARE huruf_nama CHAR(1);
    DECLARE alat_baru INT;
    DECLARE id_alat_baru VARCHAR(10);
    DECLARE urutan_str VARCHAR(5);

    SET huruf_kategori = UPPER(SUBSTRING(p_kategori, 1, 1));
    SET huruf_nama = UPPER(SUBSTRING(p_nama_alat, 1, 1));

    SELECT COUNT(*) INTO alat_baru FROM alat_pendakian WHERE kategori = p_kategori;

    SET alat_baru = alat_baru + 1;
    SET urutan_str = LPAD(alat_baru, 5, '0');
    SET id_alat_baru = CONCAT(huruf_kategori, '-', huruf_nama, '-', urutan_str);

    WHILE EXISTS (SELECT 1 FROM alat_pendakian WHERE id_alat = id_alat_baru) DO
        SET alat_baru = alat_baru + 1;
        SET urutan_str = LPAD(alat_baru, 5, '0');
        SET id_alat_baru = CONCAT(huruf_kategori, '-', huruf_nama, '-', urutan_str);
    END WHILE;

    RETURN id_alat_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `id_chat_baru` () RETURNS VARCHAR(10) CHARSET utf8mb4 DETERMINISTIC READS SQL DATA BEGIN
    DECLARE id_chat_baru VARCHAR(10);
    DECLARE urutan INT;
    DECLARE urutan_str VARCHAR(5);

    SELECT COUNT(*) INTO urutan FROM chat;

    SET urutan = urutan + 1;
    SET urutan_str = LPAD(urutan, 5, '0');
    SET id_chat_baru = CONCAT('C-', urutan_str);

    WHILE EXISTS (SELECT 1 FROM chat WHERE id_chat = id_chat_baru) DO
        SET urutan = urutan + 1;
        SET urutan_str = LPAD(urutan, 5, '0');
        SET id_chat_baru = CONCAT('C-', urutan_str);
    END WHILE;

    RETURN id_chat_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `id_favorit_baru` () RETURNS VARCHAR(10) CHARSET utf8mb4 DETERMINISTIC READS SQL DATA BEGIN
    DECLARE id_favorit_baru VARCHAR(10);
    DECLARE urutan INT;
    DECLARE urutan_str VARCHAR(5);

    SELECT COUNT(*) INTO urutan FROM favorit;

    SET urutan = urutan + 1;
    SET urutan_str = LPAD(urutan, 5, '0');
    SET id_favorit_baru = CONCAT('K-', urutan_str);

    WHILE EXISTS (SELECT 1 FROM favorit WHERE id_favorit = id_favorit_baru) DO
        SET urutan = urutan + 1;
        SET urutan_str = LPAD(urutan, 5, '0');
        SET id_favorit_baru = CONCAT('K-', urutan_str);
    END WHILE;

    RETURN id_favorit_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `id_feedback_baru` () RETURNS VARCHAR(10) CHARSET utf8mb4 DETERMINISTIC READS SQL DATA BEGIN
    DECLARE id_feedback_baru VARCHAR(10);
    DECLARE urutan INT;
    DECLARE urutan_str VARCHAR(5);

    SELECT COUNT(*) INTO urutan FROM feedback;

    SET urutan = urutan + 1;
    SET urutan_str = LPAD(urutan, 5, '0');
    SET id_feedback_baru = CONCAT('F-', urutan_str);

    WHILE EXISTS (SELECT 1 FROM feedback WHERE id_feedback = id_feedback_baru) DO
        SET urutan = urutan + 1;
        SET urutan_str = LPAD(urutan, 5, '0');
        SET id_feedback_baru = CONCAT('F-', urutan_str);
    END WHILE;

    RETURN id_feedback_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `id_informasi_baru` () RETURNS VARCHAR(10) CHARSET utf8mb4 DETERMINISTIC READS SQL DATA BEGIN
    DECLARE id_informasi_baru VARCHAR(10);
    DECLARE urutan INT;
    DECLARE urutan_str VARCHAR(5);

    SELECT COUNT(*) INTO urutan FROM informasi_pendakian;

    SET urutan = urutan + 1;
    SET urutan_str = LPAD(urutan, 5, '0');
    SET id_informasi_baru = CONCAT('I-', urutan_str);

    WHILE EXISTS (SELECT 1 FROM informasi_pendakian WHERE id_informasi = id_informasi_baru) DO
        SET urutan = urutan + 1;
        SET urutan_str = LPAD(urutan, 5, '0');
        SET id_informasi_baru = CONCAT('I-', urutan_str);
    END WHILE;

    RETURN id_informasi_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `id_penyewaan_baru` () RETURNS VARCHAR(10) CHARSET utf8mb4 DETERMINISTIC READS SQL DATA BEGIN
    DECLARE id_penyewaan_baru VARCHAR(10);
    DECLARE urutan INT;
    DECLARE urutan_str VARCHAR(5);

    SELECT COUNT(*) INTO urutan FROM penyewaan;

    SET urutan = urutan + 1;
    SET urutan_str = LPAD(urutan, 5, '0');
    SET id_penyewaan_baru = CONCAT('P-', urutan_str);

    WHILE EXISTS (SELECT 1 FROM penyewaan WHERE id_penyewaan = id_penyewaan_baru) DO
        SET urutan = urutan + 1;
        SET urutan_str = LPAD(urutan, 5, '0');
        SET id_penyewaan_baru = CONCAT('P-', urutan_str);
    END WHILE;

    RETURN id_penyewaan_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `id_user_baru` (`nama` VARCHAR(100)) RETURNS VARCHAR(10) CHARSET utf8mb4 DETERMINISTIC READS SQL DATA BEGIN
    DECLARE id_user_baru VARCHAR(10);
    DECLARE huruf_depan VARCHAR(1);
    DECLARE urutan INT;
    DECLARE urutan_str VARCHAR(5);

    SET huruf_depan = UPPER(LEFT(nama, 1));

    SELECT COUNT(*) INTO urutan FROM users;

    SET urutan = urutan + 1;
    SET urutan_str = LPAD(urutan, 5, '0');
    SET id_user_baru = CONCAT(huruf_depan, urutan_str);

    WHILE EXISTS (SELECT 1 FROM users WHERE id_user = id_user_baru) DO
        SET urutan = urutan + 1;
        SET urutan_str = LPAD(urutan, 5, '0');
        SET id_user_baru = CONCAT(huruf_depan, urutan_str);
    END WHILE;

    RETURN id_user_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `seri_alat_baru` () RETURNS VARCHAR(10) CHARSET utf8mb4 DETERMINISTIC BEGIN
    DECLARE seri_alat_baru VARCHAR(10);
    DECLARE urutan INT;
    DECLARE urutan_str VARCHAR(5);

    SELECT COALESCE(MAX(CAST(SUBSTRING(seri_alat, 3) AS UNSIGNED)), 0) + 1 INTO urutan
    FROM seri
    WHERE seri_alat REGEXP '^S-[0-9]+$';

    SET urutan_str = LPAD(urutan, 5, '0');

    SET seri_alat_baru = CONCAT('S-', urutan_str);

    RETURN seri_alat_baru;
END$$

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
('S-L-00002', 'lampu', 'secondary', 11, '50000', 'tenda4p.jpg', 'untuk penerangan');

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
('P-00005', 'W00004', 'S-00005', '2024-12-07 10:00:00', '2024-12-08 10:00:00', '100000', 'disewa', 'bukti_pembayaran.jpg');

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
('S-00006', 'S-L-00002', 'baik', 'tersedia', '2024-12-07 03:40:42'),
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
