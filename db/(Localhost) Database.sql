-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2025 at 01:21 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_admin` (IN `p_nama_admin` VARCHAR(100), IN `p_email_admin` VARCHAR(100), IN `p_no_telp_admin` VARCHAR(15), IN `p_password_admin` VARCHAR(255), IN `p_jenis_kelamin_admin` ENUM('L','P','O'), IN `p_foto_admin` VARCHAR(255))   BEGIN
    DECLARE id_admin_baru VARCHAR(10);
    SET id_admin_baru = id_admin_baru(p_nama_admin);
    
    INSERT INTO admin (
        id_admin, 
        nama_admin, 
        email_admin, 
        no_telp_admin, 
        password_admin, 
        jenis_kelamin,
        tanggal_ditambahkan, 
        foto_admin
    )
    VALUES (
        id_admin_baru, 
        p_nama_admin, 
        p_email_admin, 
        p_no_telp_admin, 
        p_password_admin,
        p_jenis_kelamin_admin,
        CURRENT_TIMESTAMP, 
        p_foto_admin
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_alat_pendakian` (IN `p_nama_alat` VARCHAR(100), IN `p_kategori` ENUM('primary','secondary','accessory','others'), IN `p_stok` INT, IN `p_harga_sewa` DECIMAL(10,0), IN `p_foto_produk` VARCHAR(255), IN `p_deskripsi` TEXT)   BEGIN
    DECLARE id_alat_baru VARCHAR(10);
    SET id_alat_baru = id_alat_baru(p_nama_alat, p_kategori);
    
    INSERT INTO alat_pendakian (
        id_alat, 
        nama_alat, 
        kategori, 
        stok, 
        harga_sewa, 
        foto_produk, 
        deskripsi
    )
    VALUES (
        id_alat_baru, 
        p_nama_alat, 
        p_kategori, 
        p_stok, 
        p_harga_sewa, 
        p_foto_produk, 
        p_deskripsi
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_chat` (IN `p_id_user` VARCHAR(10), IN `p_id_admin` VARCHAR(10), IN `p_role` ENUM('user','admin'), IN `p_pesan` TEXT, IN `p_foto_chat` VARCHAR(255))   BEGIN
    DECLARE id_chat_baru VARCHAR(10);
    SET id_chat_baru = id_chat_baru();
    
    INSERT INTO chat (
        id_chat, 
        id_user, 
        id_admin, 
        role, 
        pesan, 
        tanggal_kirim, 
        foto_chat
    )
    VALUES (
        id_chat_baru, 
        p_id_user, 
        p_id_admin, 
        p_role, 
        p_pesan, 
        CURRENT_TIMESTAMP, 
        p_foto_chat
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_favorit` (IN `p_id_user` VARCHAR(10), IN `p_id_alat` VARCHAR(10))   BEGIN
    DECLARE id_favorit_baru VARCHAR(10);
    SET id_favorit_baru = id_favorit_baru();
    
    INSERT INTO favorit (
        id_favorit, 
        id_user, 
        id_alat, 
        tanggal_ditambahkan
    )
    VALUES (
        id_favorit_baru, 
        p_id_user, 
        p_id_alat, 
        CURRENT_TIMESTAMP
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_feedback` (IN `p_id_user` VARCHAR(10), IN `p_id_alat` VARCHAR(10), IN `p_id_penyewaan` VARCHAR(10), IN `p_komentar` TEXT, IN `p_rating` DECIMAL(2,1), IN `p_foto` VARCHAR(255))   BEGIN
    DECLARE id_feedback_baru VARCHAR(10);
    SET id_feedback_baru = id_feedback_baru();

    INSERT INTO feedback (
        id_feedback, 
        id_user, 
        id_alat, 
        id_penyewaan, 
        komentar, 
        rating, 
        foto, 
        tanggal_feedback
    )
    VALUES (
        id_feedback_baru, 
        p_id_user, 
        p_id_alat, 
        p_id_penyewaan, 
        p_komentar, 
        p_rating, 
        p_foto, 
        CURRENT_TIMESTAMP
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_informasi_pendakian` (IN `p_id_admin` VARCHAR(10), IN `p_nama_gunung` VARCHAR(100), IN `p_lokasi` VARCHAR(255), IN `p_harga_biaya` DECIMAL(10,0), IN `p_deskripsi` TEXT, IN `p_foto_gunung` VARCHAR(255))   BEGIN
    DECLARE id_informasi_baru VARCHAR(10);
    SET id_informasi_baru = id_informasi_baru();
    
    INSERT INTO informasi_pendakian (
        id_informasi, 
        id_admin, 
        nama_gunung, 
        lokasi, 
        harga_biaya, 
        deskripsi, 
        tanggal_update, 
        foto_gunung
    )
    VALUES (
        id_informasi_baru, 
        p_id_admin, 
        p_nama_gunung, 
        p_lokasi, 
        p_harga_biaya, 
        p_deskripsi, 
        CURRENT_TIMESTAMP, 
        p_foto_gunung
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_penyewaan` (IN `p_id_user` VARCHAR(10), IN `p_seri_alat` VARCHAR(10), IN `p_tanggal_penyewaan` DATETIME, IN `p_tanggal_pengembalian` DATETIME, IN `p_total_harga` DECIMAL(10,0))   BEGIN
    DECLARE id_penyewaan_baru VARCHAR(10);
    SET id_penyewaan_baru = id_penyewaan_baru();
    
    INSERT INTO penyewaan (
        id_penyewaan, 
        id_user, 
        seri_alat, 
        tanggal_penyewaan, 
        tanggal_pengembalian, 
        total_harga
    )
    VALUES (
        id_penyewaan_baru, 
        p_id_user, 
        p_seri_alat, 
        p_tanggal_penyewaan, 
        p_tanggal_pengembalian, 
        p_total_harga
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_seri` (IN `p_id_alat` VARCHAR(10), IN `p_kondisi` ENUM('baru','baik','minus'), IN `p_status_produk` ENUM('tersedia','disewa','dalam perawatan','rusak'))   BEGIN
    DECLARE id_seri_baru VARCHAR(10);
    SET id_seri_baru = seri_alat_baru();
    
    INSERT INTO seri (
        seri_alat, 
        id_alat, 
        kondisi, 
        status_produk, 
        tanggal_ditambahkan
    )
    VALUES (
        id_seri_baru, 
        p_id_alat, 
        p_kondisi, 
        p_status_produk, 
        CURRENT_TIMESTAMP
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_user` (IN `p_nama` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(255), IN `p_jenis_kelamin` ENUM('L','P','O'), IN `p_no_telepon` VARCHAR(15), IN `p_alamat` TEXT, IN `p_foto_profil` VARCHAR(255))   BEGIN
    DECLARE id_user_baru VARCHAR(10);
    SET id_user_baru = id_user_baru(p_nama);
    
    INSERT INTO users (
        id_user, 
        nama, 
        email, 
        password, 
        jenis_kelamin,
        no_telepon, 
        alamat, 
        tanggal_daftar, 
        foto_profil
    )
    VALUES (
        id_user_baru, 
        p_nama, 
        p_email, 
        p_password, 
        p_jenis_kelamin,
        p_no_telepon, 
        p_alamat, 
        CURRENT_TIMESTAMP, 
        p_foto_profil
    );
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `id_admin_baru` (`nama_admin` VARCHAR(100)) RETURNS VARCHAR(10) CHARSET utf8mb3 DETERMINISTIC READS SQL DATA BEGIN
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

CREATE DEFINER=`root`@`localhost` FUNCTION `id_alat_baru` (`p_nama_alat` VARCHAR(100), `p_kategori` ENUM('primary','secondary','accessory','others')) RETURNS VARCHAR(10) CHARSET utf8mb3 DETERMINISTIC READS SQL DATA BEGIN
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

CREATE DEFINER=`root`@`localhost` FUNCTION `id_chat_baru` () RETURNS VARCHAR(10) CHARSET utf8mb3 DETERMINISTIC READS SQL DATA BEGIN
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

CREATE DEFINER=`root`@`localhost` FUNCTION `id_favorit_baru` () RETURNS VARCHAR(10) CHARSET utf8mb3 DETERMINISTIC READS SQL DATA BEGIN
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

CREATE DEFINER=`root`@`localhost` FUNCTION `id_feedback_baru` () RETURNS VARCHAR(10) CHARSET utf8mb3 DETERMINISTIC READS SQL DATA BEGIN
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

CREATE DEFINER=`root`@`localhost` FUNCTION `id_informasi_baru` () RETURNS VARCHAR(10) CHARSET utf8mb3 DETERMINISTIC READS SQL DATA BEGIN
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

CREATE DEFINER=`root`@`localhost` FUNCTION `id_penyewaan_baru` () RETURNS VARCHAR(10) CHARSET utf8mb3 DETERMINISTIC READS SQL DATA BEGIN
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

CREATE DEFINER=`root`@`localhost` FUNCTION `id_user_baru` (`nama` VARCHAR(100)) RETURNS VARCHAR(10) CHARSET utf8mb3 DETERMINISTIC READS SQL DATA BEGIN
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

CREATE DEFINER=`root`@`localhost` FUNCTION `seri_alat_baru` () RETURNS VARCHAR(10) CHARSET utf8mb3 DETERMINISTIC BEGIN
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
  `jenis_kelamin` enum('P','L','O') DEFAULT 'O',
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `no_telp_admin`, `password_admin`, `jenis_kelamin`, `tanggal_ditambahkan`, `foto_admin`) VALUES
('1165', 'Admin', 'admin@admin', '', 'admin', 'O', '2025-01-14 07:23:16', 'default.png'),
('P00002', 'Panji', 'panji@hikyu', '085777419874', 'panji123', 'L', '2025-01-14 07:25:30', 'panji.jpg'),
('R00003', 'Rama', 'rama@hikyu', '089697100997', 'rama123', 'L', '2025-01-14 07:27:39', 'rama.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `alat_pendakian`
--

INSERT INTO `alat_pendakian` (`id_alat`, `nama_alat`, `kategori`, `stok`, `harga_sewa`, `foto_produk`, `deskripsi`) VALUES
('A-H-00002', 'Headlamp', 'accessory', 49, '5000', 'Headlamp.jpg', 'Lampu kepala dengan daya tahan baterai tinggi.'),
('A-R-00001', 'Raincoat', 'accessory', 10, '10000', 'Raincoat.jpg', 'Jas hujan praktis untuk menjaga tubuh tetap kering.'),
('O-M-00001', 'Matras', 'others', 65, '5000', 'Matras.jpg', 'Matras ringan untuk tidur lebih nyaman.'),
('P-S-00002', 'Sleeping Bag', 'primary', 15, '35000', 'Sleeping_Bag.jpg', 'Sleeping bag berkualitas tinggi, nyaman untuk cuaca dingin.'),
('P-T-00001', 'Tenda Dome 4P', 'primary', 4, '75000', 'Tenda_Dome_4P.jpg', 'Tenda berkapasitas 4 orang, cocok untuk pendakian keluarga.'),
('S-K-00001', 'Kompor Portable', 'secondary', 10, '15000', 'Kompor_Portable.jpg', 'Kompor ringan dan mudah digunakan untuk memasak di gunung.'),
('S-T-00002', 'Tracking Pole', 'secondary', 35, '20000', 'Tracking_Pole.jpg', 'Tongkat pendukung untuk perjalanan trekking.');

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
  `id_admin` varchar(11) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL,
  `pesan` text NOT NULL,
  `tanggal_kirim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_chat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id_chat`, `id_user`, `id_admin`, `role`, `pesan`, `tanggal_kirim`, `foto_chat`) VALUES
('C-00001', 'U00003', NULL, 'user', 'halo min -)', '2025-01-14 08:57:20', NULL),
('C-00002', 'M00002', NULL, 'user', 'halo\r\n', '2025-01-14 09:05:29', NULL),
('C-00003', 'U00003', '1165', 'user', '<strong>Detail Invoice</strong> <br><br>Invoice: #P-00001<br> Nama: user<br> Alat: Tenda Dome 4P<br> Tanggal Sewa: 14 January 2025<br> Tanggal Balik: 17 January 2025<br> Harga: Rp. 75.000<br>', '2025-01-14 09:09:13', 'P-00001_user.jpg'),
('C-00004', 'U00003', '1165', 'admin', 'Baik, pesanan telah kami terima, silahkan datang untuk mengambil alat tersebut untuk kami proses lebih lanjut. Terima kasih.', '2025-01-14 09:09:13', NULL),
('C-00005', 'M00002', '1165', 'admin', 'halo juga', '2025-01-14 09:18:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id_favorit` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_alat` varchar(11) NOT NULL,
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `favorit`
--

INSERT INTO `favorit` (`id_favorit`, `id_user`, `id_alat`, `tanggal_ditambahkan`) VALUES
('K-00001', 'U00003', 'P-T-00001', '2025-01-14 09:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_alat` varchar(11) NOT NULL,
  `id_penyewaan` varchar(11) NOT NULL,
  `komentar` text,
  `rating` decimal(2,1) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal_feedback` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `id_user`, `id_alat`, `id_penyewaan`, `komentar`, `rating`, `foto`, `tanggal_feedback`) VALUES
('F-00001', 'U00003', 'A-H-00002', 'P-00002', 'test', '5.0', 'user_P-00002.png', '2025-01-16 12:38:51');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `informasi_pendakian`
--

INSERT INTO `informasi_pendakian` (`id_informasi`, `id_admin`, `nama_gunung`, `lokasi`, `harga_biaya`, `deskripsi`, `tanggal_update`, `foto_gunung`) VALUES
('I-00001', '1165', 'Gunung Papandayan', 'Garut, Jawa Barat', '65000', 'Terletak di kawasan Garut, Jawa Barat, Gunung Papandayan merupakan salah satu gunung favorit bagi pendaki pemula. Gunung ini sangat cocok bagi pendaki pemula karena medan pendakiannya yang landau dan telah dilengkapi fasilitas umum seperti toilet dan warung makan. Gunung ini juga terbilang gampang dicapai karena akses angkutan umum menuju ke sini sangat banyak dan mudah ditemukan.\r\n\r\nDengan menempuh sekitar 4 sampai 5 jam waktu pendakian, Gunung Papandayan memiliki banyak kawah seperti Kawah Mas, kawah Baru, kawah Nangklak, dan Kawah Manuk. Mendaki gunung ini, kamu pun bisa mencapai padang Edelweis yang luas di Tegal Alun atau bersantai di kawasan Hutan Mati yang ada di gunung untuk pendaki pemula di Indonesia satu ini.', '2025-01-14 07:56:16', 'gunung_papandayan.jpg'),
('I-00002', '1165', 'Gunung Ijen', 'Perbatasan Banyuwangi dan Bondowoso, Jawa Timur', '30000', 'Gunun Ijen terkenal berkat fenomena api biru dan kawah belerangnya yang memukau. Gunung yang cocok untuk pendaki pemula ini terletak di Kabupaten Banyuwangi dengan ketinggian 2.443 mdpl dan memerlukan waktu sekitar 2,5-3 jam pendakian untuk sampai ke puncaknya dari pos pendakian Paltuding. \r\n\r\nMeski tak terlalu tinggi dan medan pendakian gunung ini sempurna bagi para pendaki pemula, kamu harus tetap berhati-hati karena Gunung Ijen memiliki alur pendakian berpasir dan lumayan curam di beberapa titiknya.', '2025-01-14 07:57:54', 'gunung_ijen.jpg'),
('I-00003', '1165', 'Gunung Batur', 'Kintamani, Pulau Bali', '75000', 'Berlokasi di daerah Kintamani, Pulau Bali, Gunung Batur cocok dijadikan pilihan bagi para pendaki pemula yang ingin berlibur. Dibandingkan dengan Gunung Agung, gunung yang satu ini tergolong lebih mudah didaki dengan waktu tempuh pendakian menuju ke puncaknya memakan sekitar 2 hingga 3 jam. \r\n\r\nBegitu sampai di puncaknya, kamu akan disuguhkan pemandangan danau Kintamani yang indah. Waktu terbaik mendaki gunung untuk pendaki pemula ini adalah ketika subuh karena kamu akan melihat pemandangan indah ketika matahari terbit di puncak. Buat kamu yang ingin mendaki gunung ini, kamu bisa mencari paket tur pendakian reguler dengan pemandu yang bisa menemanimu.', '2025-01-14 07:59:11', 'gunung_batur.jpg'),
('I-00004', '1165', 'Gunung Pulosari', 'Pandeglang, Banten', '10000', 'ak perlu mendaki terlalu tinggi untuk menikmati pemandangan alam yang indah. Kamu bisa pergi ke Gunung Pulosari. Dengan ketinggian 1.346 mdpl, gunung untuk pendaki pemula di Indonesia yang berada di daerah Pandeglang, Banten, ini punya jalur pendakian yang relatif pendek sehingga cocok untuk kamu yang baru ingin mencoba pengalaman mendaki gunung.\r\n\r\nKamu hanya memerlukan waktu kurang lebih 1,5 jam untuk mencapai puncak. Meski tidak terlalu tinggi dan memiliki jalur pendakian yang singkat, kamu harus tetap berhati-hati karena medan Gunung Pulosari dikenal cukup terjal.', '2025-01-14 08:00:06', 'gunung_pulosari.jpg'),
('I-00005', '1165', 'Gunung Gede', 'Kabupaten Cianjur dan Sukabumi, Jawa Barat', '29000', 'Satu lagi gunung yang cocok untuk pendaki pemula adalah Gunung Gede. Terletak di Jawa Barat, Gunung Gede punya jalur pendakian yang relatif pendek. Sama seperti Gunung Papandayan, Gunung Gede juga memiliki padang bunga edelweiss Surya Kencana. \r\n\r\nMendaki gunung ini, kamu akan disuguhkan trek pendakian yang mudah dan relatif ringan serta memudahkanmu menikmati pemandangan alam indah air terjun Ciebereum. \r\n\r\nPada jalur pendakian ini juga terdapat sumber air panas yang bisa kamu kunjungi. Ingin menantang dirimu sampai di puncak Gunung Gede? Persiapkan fisikmu untuk menempuk jarak sekitar 6 jam perjalanan mendaki sampai ke puncak dari gunung untuk pendaki pemula.', '2025-01-14 08:02:26', 'gunung_gede.jpg'),
('I-00006', '1165', 'Gunung Sibayak', 'Karo, Sumatera Utara', '2000', 'Kamu pendaki pemula yang ingin mendaki gunung berapi aktif? Gunung Sibayak bisa menjadi pilihan yang tepat bagimu. Terletak di kawasan Dataran Tinggi Karo, Sumatera Utara, Gunung Sibayak yang memiliki ketinggian 2.904 mdpl ini menawarkan pengalaman pendakian gunung dengan pemandangan alam indah batuan cadas dan kawah aktif. Waktu terbaik untuk mendaki adalah ketika subuh karena begitu sampai di puncak, kamu akan melihat pemandangan matahari terbit yang cantik.', '2025-01-14 08:03:47', 'gunung_sibayak.png'),
('I-00007', '1165', 'Gunung Prau', 'Dieng, Jawa Timur', '50000', 'Gunung Prau terletak di Dieng, Jawa Timur, dan telah menjadi pilihan favorit para pendaki pemula semenjak lama. Gunung ini berada di ketinggian 2.565 mdpl dan punya puncak terluas di Indonesia yang bisa dijadikan tempat berkemah sembari menanti matahari terbit. Kamu bisa menempuh waktu sekitar 3 jam untuk mencapai puncak Gunung Prau yang bisa mulai didaki dari pos pendakian Desa Patak Banteng, Dieng.', '2025-01-14 08:05:04', 'gunung_prau.jpg'),
('I-00008', '1165', 'Gunung Andong', 'Kabupaten Magelang, Jawa Tengah.', '4000', 'Pernah dengar nama Gunung Andong? Lokasinya ada di perbatasan antara Semarang, Salatiga, dan Magelang. Secara administrasi, Gunung Andong berada di Dusun Sawit, Desa Girirejo, Kecamatan Ngablak, Kabupaten Magelang, Jawa Tengah.\r\n\r\nGunung Andong memiliki ketinggian sekitar 1.726 mdpl yang ramah bagi pendaki pemula. Di sana terdapat Hutan Wisata Mangli untuk melihat berbagai macam tanaman, seperti pohon pinus, cengkeh, bambu petus, bambu apus, bambu legi, hingga sayuran semacam kubis, wortel, kacang panjang, terung, dan cabai.', '2025-01-14 08:08:01', 'gunung_andong.jpg'),
('I-00009', '1165', 'Gunung Jayawijaya', 'Papua, Papua Tengah', '40000000', 'Seperti menjadi tantangan ultimate bagi pendaki yang ada di Indonesia bahkan dunia, Gunung Jayawijaya yang terletak di Papua Tengah ini adalah bagian dari pegunungan yang membentang hingga ke Provinsi Papua Pegunungan.\r\n\r\nPuncak tertingginya disebut dengan Puncak Jaya, dengan ketinggian 4,884 mdpl. Berbicara tentang daya tarik, jelas salju abadi adalah satu diantara sekian banyak keistimewaan gunung ini. Tapi tantangan besar harus siap dihadapi, sebab tingkat kesulitan yang disajikan tidak main-main. Hanya pendaki profesional dan berpengalaman saja yang direkomendasikan untuk mendaki gunung ini.', '2025-01-14 08:12:05', 'gunung_jayawijaya.jpg'),
('I-00010', '1165', 'Gunung Bukit Raya', 'Kabupaten Katingan, Kalimantan Tengah', '200000', 'Menjadi salah satu gunung yang terkenal di kawasan Kalimantan, gunung ini memiliki ketinggian di angka 2,278 mdpl. Kondang karena keindahan flora dan faunanya yang cantik, kamu juga bisa menikmati banyak sungai yang mengalir dengan air jernih.\r\n\r\nBerbicara lokasi sendiri gunung ini ada di Bukit Raya, Kabupaten Katingan, Kalimantan Tengah. Untuk bisa mendaki gunung ini kamu perlu persiapan yang cukup matang, dan perencanaan yang baik sebab jalurnya akan cukup panjang dengan medan yang menantang.', '2025-01-14 08:13:14', 'gunung_bukit_raya.jpg'),
('I-00011', '1165', 'Pegunungan Latimojong', 'Kabupaten Enrekang, Sulawesi Selatan', '4000000', 'Yang satu ini bisa jadi destinasi para pendaki karena merupakan puncak tertinggi di Sulawesi Selatan. Dengan puncak Rante Mario di ketinggian 3,430 mdpl, lokasinya ada di kawasan Kabupaten Enrekang. Sebenarnya barisan Pegunungan Latimojong sendiri memiliki beberapa puncak, tapi puncak Rante Mario adalah salah satu yang paling terkenal.\r\n\r\nKeunikannya adalah bahwa pegunungan tertinggi ini bukan berasal dari gunung api, tapi terbentuk dari batuan tektonik  sejak 100 juta tahun yang lalu. Jadi nuansanya akan lebih unik dibandingkan dengan beberapa gunung yang ada di daftar ini.\r\n\r\nTantangannya jelas, kamu perlu mempersiapkan diri lebih matang sebab jalur pendakiannya akan cukup panjang.', '2025-01-14 08:14:17', 'pegunungan_latimojong.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `seri_alat` varchar(11) NOT NULL,
  `tanggal_penyewaan` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `status_sewa` enum('menunggu','disewa','selesai','batal') NOT NULL DEFAULT 'menunggu',
  `bukti_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `id_user`, `seri_alat`, `tanggal_penyewaan`, `tanggal_pengembalian`, `total_harga`, `status_sewa`, `bukti_pembayaran`) VALUES
('P-00001', 'U00003', 'S-00001', '2025-01-14', '2025-01-17', '75000', 'disewa', 'P-00001_user.jpg'),
('P-00002', 'U00003', 'S-00076', '2025-01-16', '2025-01-19', '5000', 'selesai', NULL);

--
-- Triggers `penyewaan`
--
DELIMITER $$
CREATE TRIGGER `after_insert_penyewaan` AFTER INSERT ON `penyewaan` FOR EACH ROW BEGIN
        UPDATE seri
        SET status_produk = 'menunggu'
        WHERE seri_alat = NEW.seri_alat;
        
        UPDATE alat_pendakian
        SET stok = stok - 1
        WHERE id_alat = (SELECT id_alat FROM seri WHERE seri_alat = NEW.seri_alat);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_reject` AFTER UPDATE ON `penyewaan` FOR EACH ROW BEGIN
    IF OLD.status_sewa = 'menunggu' AND NEW.status_sewa = 'batal' THEN
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
DELIMITER $$
CREATE TRIGGER `update_stok_dan_status_produk` AFTER UPDATE ON `penyewaan` FOR EACH ROW BEGIN
    IF OLD.status_sewa = 'menunggu' AND NEW.status_sewa = 'disewa' THEN
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
  `status_produk` enum('tersedia','disewa','dalam perawatan','rusak','menunggu') NOT NULL DEFAULT 'tersedia',
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `seri`
--

INSERT INTO `seri` (`seri_alat`, `id_alat`, `kondisi`, `status_produk`, `tanggal_ditambahkan`) VALUES
('S-00001', 'P-T-00001', 'baik', 'disewa', '2025-01-14 08:12:11'),
('S-00002', 'P-T-00001', 'baik', 'tersedia', '2025-01-14 08:12:11'),
('S-00003', 'P-T-00001', 'baik', 'tersedia', '2025-01-14 08:12:11'),
('S-00004', 'P-T-00001', 'baik', 'tersedia', '2025-01-14 08:12:11'),
('S-00005', 'P-T-00001', 'baik', 'tersedia', '2025-01-14 08:12:11'),
('S-00006', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00007', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00008', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00009', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00010', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00011', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00012', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00013', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00014', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00015', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00016', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00017', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00018', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00019', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00020', 'P-S-00002', 'baik', 'tersedia', '2025-01-14 08:17:11'),
('S-00021', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00022', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00023', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00024', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00025', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00026', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00027', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00028', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00029', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00030', 'S-K-00001', 'baik', 'tersedia', '2025-01-14 08:19:30'),
('S-00031', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00032', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00033', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00034', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00035', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00036', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00037', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00038', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00039', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00040', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00041', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00042', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00043', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00044', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00045', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00046', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00047', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00048', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00049', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00050', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00051', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00052', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00053', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00054', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00055', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00056', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00057', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00058', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00059', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00060', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00061', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00062', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00063', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00064', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00065', 'S-T-00002', 'baik', 'tersedia', '2025-01-14 08:21:25'),
('S-00066', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00067', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00068', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00069', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00070', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00071', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00072', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00073', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00074', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00075', 'A-R-00001', 'baik', 'tersedia', '2025-01-14 08:27:15'),
('S-00076', 'A-H-00002', 'baik', 'menunggu', '2025-01-14 08:28:33'),
('S-00077', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00078', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00079', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00080', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00081', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00082', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00083', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00084', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00085', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00086', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00087', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00088', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00089', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00090', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00091', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00092', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00093', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00094', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00095', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00096', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00097', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00098', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00099', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00100', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00101', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00102', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00103', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00104', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00105', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00106', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00107', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00108', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00109', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00110', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00111', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00112', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00113', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00114', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00115', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00116', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00117', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00118', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00119', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00120', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00121', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00122', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00123', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00124', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00125', 'A-H-00002', 'baik', 'tersedia', '2025-01-14 08:28:33'),
('S-00126', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00127', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00128', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00129', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00130', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00131', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00132', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00133', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00134', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00135', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00136', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00137', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00138', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00139', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00140', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00141', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00142', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00143', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00144', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00145', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00146', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00147', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00148', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00149', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00150', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00151', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00152', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00153', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00154', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00155', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00156', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00157', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00158', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00159', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00160', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00161', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00162', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00163', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00164', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00165', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00166', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00167', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00168', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00169', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00170', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00171', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00172', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00173', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00174', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00175', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00176', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00177', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00178', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00179', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00180', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00181', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00182', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00183', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00184', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00185', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00186', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00187', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00188', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00189', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40'),
('S-00190', 'O-M-00001', 'baik', 'tersedia', '2025-01-14 08:29:40');

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
  `jenis_kelamin` enum('P','L','O') DEFAULT 'O',
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text,
  `tanggal_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `jenis_kelamin`, `no_telepon`, `alamat`, `tanggal_daftar`, `foto_profil`) VALUES
('F00001', 'Fahmi', 'fahmi@amikom', 'fahmi123', 'L', '087760659315', 'Godean', '2025-01-14 07:31:32', 'Fahmi.jpg'),
('M00002', 'Marcel', 'marcel@amikom', 'marcel123', 'L', '081320007169', 'SCH', '2025-01-14 07:32:12', 'Marcel.jpg'),
('U00003', 'user', 'user@user', 'user123', 'O', '085280664986', 'Bumi', '2025-01-14 08:43:03', 'default.png');

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
  ADD KEY `id_alat` (`id_alat`),
  ADD KEY `id_penyewaan` (`id_penyewaan`);

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
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `alat_pendakian` (`id_alat`),
  ADD CONSTRAINT `feedback_ibfk_4` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`);

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

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `auto_cancel_penyewaan` ON SCHEDULE EVERY 1 HOUR STARTS '2024-12-27 20:10:34' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE `penyewaan`
    SET `status_sewa` = 'batal'
    WHERE `status_sewa` = 'menunggu' 
      AND TIMESTAMPDIFF(HOUR, `tanggal_penyewaan`, NOW()) >= 12;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `auto_complete_penyewaan` ON SCHEDULE EVERY 1 HOUR STARTS '2024-12-27 21:03:15' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE `penyewaan`
    SET `status_sewa` = 'selesai'
    WHERE `status_sewa` = 'disewa'
      AND CURDATE() >= `tanggal_pengembalian`;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
