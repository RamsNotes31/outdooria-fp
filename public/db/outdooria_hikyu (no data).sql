-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2025 at 05:18 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_admin` (IN `p_nama_admin` VARCHAR(100), IN `p_email_admin` VARCHAR(100), IN `p_no_telp_admin` VARCHAR(15), IN `p_password_admin` VARCHAR(255), IN `p_jenis_kelamin_admin` ENUM('L','P',' O'), IN `p_foto_admin` VARCHAR(255))   BEGIN
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
    
    INSERT INTO alat_pendakian (id_alat, nama_alat, kategori, stok, harga_sewa, foto_produk, deskripsi)
    VALUES (id_alat_baru, p_nama_alat, p_kategori, p_stok, p_harga_sewa, p_foto_produk, p_deskripsi);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_chat` (IN `p_id_user` VARCHAR(10), IN `p_id_admin` VARCHAR(10), IN `p_role` ENUM('user','admin'), IN `p_pesan` TEXT, IN `p_foto_chat` VARCHAR(255))   BEGIN
    DECLARE id_chat_baru VARCHAR(10);
    SET id_chat_baru = id_chat_baru();
    
    INSERT INTO chat (id_chat, id_user, id_admin, role, pesan, tanggal_kirim, foto_chat)
    VALUES (id_chat_baru, p_id_user, p_id_admin, p_role, p_pesan, CURRENT_TIMESTAMP, p_foto_chat);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_favorit` (IN `p_id_user` VARCHAR(10), IN `p_id_alat` VARCHAR(10))   BEGIN
    DECLARE id_favorit_baru VARCHAR(10);
    SET id_favorit_baru = id_favorit_baru();
    
    INSERT INTO favorit (id_favorit, id_user, id_alat, tanggal_ditambahkan)
    VALUES (id_favorit_baru, p_id_user, p_id_alat, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_feedback` (IN `p_id_user` VARCHAR(10), IN `p_id_alat` VARCHAR(10), IN `p_id_penyewaan` VARCHAR(10), IN `p_komentar` TEXT, IN `p_rating` DECIMAL(2,1), IN `p_foto` VARCHAR(255))   BEGIN
    DECLARE id_feedback_baru VARCHAR(10);
   
    SET id_feedback_baru = id_feedback_baru(); 

    INSERT INTO feedback (id_feedback, id_user, id_alat, id_penyewaan, komentar, rating, foto, tanggal_feedback)
    VALUES (id_feedback_baru, p_id_user, p_id_alat, p_id_penyewaan, p_komentar, p_rating, p_foto, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_informasi_pendakian` (IN `p_id_admin` VARCHAR(10), IN `p_nama_gunung` VARCHAR(100), IN `p_lokasi` VARCHAR(255), IN `p_harga_biaya` DECIMAL(10,0), IN `p_deskripsi` TEXT, IN `p_foto_gunung` VARCHAR(255))   BEGIN
    DECLARE id_informasi_baru VARCHAR(10);
    SET id_informasi_baru = id_informasi_baru();
    
    INSERT INTO informasi_pendakian (id_informasi, id_admin, nama_gunung, lokasi, harga_biaya, deskripsi, tanggal_update, foto_gunung)
    VALUES (id_informasi_baru, p_id_admin, p_nama_gunung, p_lokasi, p_harga_biaya, p_deskripsi, CURRENT_TIMESTAMP, p_foto_gunung);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_penyewaan` (IN `p_id_user` VARCHAR(10), IN `p_seri_alat` VARCHAR(10), IN `p_tanggal_penyewaan` DATETIME, IN `p_tanggal_pengembalian` DATETIME, IN `p_total_harga` DECIMAL(10,0))   BEGIN
    DECLARE id_penyewaan_baru VARCHAR(10);
    SET id_penyewaan_baru = id_penyewaan_baru();
    
    INSERT INTO penyewaan (id_penyewaan, id_user, seri_alat, tanggal_penyewaan, tanggal_pengembalian, total_harga)
    VALUES (id_penyewaan_baru, p_id_user, p_seri_alat, p_tanggal_penyewaan, p_tanggal_pengembalian, p_total_harga);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_seri` (IN `p_id_alat` VARCHAR(10), IN `p_kondisi` ENUM('baru','baik','minus'), IN `p_status_produk` ENUM('tersedia','disewa','dalam perawatan','rusak'))   BEGIN
    DECLARE id_seri_baru VARCHAR(10);
    SET id_seri_baru = seri_alat_baru();
    
    INSERT INTO seri (seri_alat, id_alat, kondisi, status_produk, tanggal_ditambahkan)
    VALUES (id_seri_baru, p_id_alat, p_kondisi, p_status_produk, CURRENT_TIMESTAMP);
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
('1165', 'bot', 'bot@bot', '0123456789', 'botbot123', 'O', '2025-01-01 01:30:52', 'default.png'),
('S00002', 'super admin', 'admin@admin', '0897654321', 'admin123', 'O', '2025-01-01 01:55:18', 'default.png');

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
  `id_admin` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `role` enum('user','admin') NOT NULL,
  `pesan` text NOT NULL,
  `tanggal_kirim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_chat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `status_produk` enum('tersedia','disewa','dalam perawatan','rusak','menunggu') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'tersedia',
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
('P00001', 'panji', 'panji@gmail.com', 'pnj1165', 'L', '085777419874', 'Jawa', '2025-01-01 01:27:20', 'panji.jpg'),
('U00002', 'user', 'user@user', 'user123', 'O', '08987612345', 'User', '2025-01-01 01:56:50', 'default.png');

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
CREATE DEFINER=`root`@`localhost` EVENT `auto_cancel_penyewaan` ON SCHEDULE EVERY 1 HOUR STARTS '2024-12-27 13:10:34' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE `penyewaan`
    SET `status_sewa` = 'batal'
    WHERE `status_sewa` = 'menunggu' 
      AND TIMESTAMPDIFF(HOUR, `tanggal_penyewaan`, NOW()) >= 12;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `auto_complete_penyewaan` ON SCHEDULE EVERY 1 HOUR STARTS '2024-12-27 14:03:15' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
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
