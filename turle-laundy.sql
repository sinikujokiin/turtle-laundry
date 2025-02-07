-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 07, 2025 at 07:49 PM
-- Server version: 10.11.10-MariaDB-cll-lve
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `n1574432_e_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `url` text NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `url`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'members/store', 'Menambahkan member Muhammad Rafli Syaban', '2023-05-25 13:32:19', '2023-05-25 20:43:03', NULL),
(2, 5, 'members/update/ay9paTY5NnlTempKKzVuK0dqZ1Vvdz09', 'Mengubah member Luthfi Ihdalhusnayain', '2023-05-25 13:34:14', '2023-05-25 13:34:14', NULL),
(3, NULL, 'login', 'Gagal login dengan usernam a & password ', '2023-05-25 13:39:14', '2023-05-25 13:39:14', NULL),
(4, NULL, 'login', 'Gagal login dengan usernam a & password alJwd2lKZjEvTnMxRUgrSEMxSEx3Zz09', '2023-05-25 13:39:38', '2023-05-25 13:39:38', NULL),
(5, 5, 'login', 'Owner Telah login', '2023-05-25 13:39:59', '2023-05-25 13:39:59', NULL),
(6, NULL, 'login', 'Gagal login dengan usernam owner & password K1BGZWFzZmVrWVRlRzh3cFVGYWF2Zz09', '2023-05-25 19:40:37', '2023-05-25 19:40:37', NULL),
(7, 5, 'login', 'Owner Telah login', '2023-05-25 19:40:43', '2023-05-25 19:40:43', NULL),
(8, 5, 'transactions/store', 'Membuat transaksi 23052535-002', '2023-05-25 19:41:33', '2023-05-25 19:41:33', NULL),
(9, 5, 'transactions/update/dTNlQVYxSWJRclZCeEZEVHZMRFJMdz09', 'Mengubah transaksi 23052535-002', '2023-05-25 19:43:03', '2023-05-25 19:43:03', NULL),
(10, 5, 'transactions/update/dTNlQVYxSWJRclZCeEZEVHZMRFJMdz09', 'Mengubah transaksi 23052535-002', '2023-05-25 19:43:16', '2023-05-25 19:43:16', NULL),
(11, 5, 'transactions/next/dTNlQVYxSWJRclZCeEZEVHZMRFJMdz09/diproses', 'Mengubah status transaksi 23052535-002', '2023-05-25 19:44:38', '2023-05-25 19:44:38', NULL),
(12, NULL, 'login', 'Gagal login dengan usernam owners & password NU04RlV5cWlHL2tOVjBheU4vM1Q2UT09', '2023-05-25 22:40:16', '2023-05-25 22:40:16', NULL),
(13, 5, 'login', 'Owner Telah login', '2023-05-25 22:40:23', '2023-05-25 22:40:23', NULL),
(14, 5, 'setting/store', 'Memperbarui pengaturan website', '2023-05-25 23:24:28', '2023-05-25 23:24:28', NULL),
(15, 5, 'login', 'Owner Telah login', '2023-05-26 13:10:28', '2023-05-26 13:10:28', NULL),
(16, 1, 'login', 'Staff01 Telah login', '2023-05-26 21:09:06', '2023-05-26 21:09:06', NULL),
(17, 1, 'transactions/store', 'Membuat transaksi 23052631-003', '2023-05-26 21:10:08', '2023-05-26 21:10:08', NULL),
(18, 5, 'login', 'Owner Telah login', '2023-05-27 00:35:09', '2023-05-27 00:35:09', NULL),
(19, 5, 'transactions/next/clFxWjFjRThRcEwrVlpJRndTdVM2Zz09/diproses/index', 'Mengubah status transaksi 23052631-003', '2023-05-27 03:14:52', '2023-05-27 03:14:52', NULL),
(20, 5, 'transactions/update/dTNlQVYxSWJRclZCeEZEVHZMRFJMdz09', 'Mengubah transaksi 23052535-002', '2023-05-27 03:15:04', '2023-05-27 03:15:04', NULL),
(21, 5, 'transactions/update/clFxWjFjRThRcEwrVlpJRndTdVM2Zz09', 'Mengubah transaksi 23052631-003', '2023-05-27 03:15:10', '2023-05-27 03:15:10', NULL),
(22, 5, 'login', 'Owner Telah login', '2023-05-27 07:09:28', '2023-05-27 07:09:28', NULL),
(23, 5, 'transactions/store', 'Membuat transaksi 23052725-004', '2023-05-27 07:47:43', '2023-05-27 07:47:43', NULL),
(24, 5, 'transactions/update/UklRS2s2ZFNYdWlYNUFKYUg4MC9Idz09', 'Mengubah transaksi 23052725-004', '2023-05-27 07:55:50', '2023-05-27 07:55:50', NULL),
(25, 5, 'transactions/next/clFxWjFjRThRcEwrVlpJRndTdVM2Zz09/dicuci/index', 'Mengubah status transaksi 23052631-003', '2023-05-27 08:16:51', '2023-05-27 08:16:51', NULL),
(26, 5, 'login', 'Owner Telah login', '2023-05-27 14:49:47', '2023-05-27 14:49:47', NULL),
(27, 5, 'login', 'Owner Telah login', '2023-05-28 14:12:10', '2023-05-28 14:12:10', NULL),
(28, 5, 'login', 'Owner Telah login', '2023-05-29 13:23:56', '2023-05-29 13:23:56', NULL),
(29, 5, 'login', 'Owner Telah login', '2023-05-31 11:47:20', '2023-05-31 11:47:20', NULL),
(30, 1, 'login', 'Staff01 Telah login', '2023-05-31 13:41:34', '2023-05-31 13:41:34', NULL),
(31, 1, 'transactions/next/clFxWjFjRThRcEwrVlpJRndTdVM2Zz09/siap%20diambil', 'Mengubah status transaksi 23052631-003', '2023-05-31 13:46:24', '2023-05-31 13:46:24', NULL),
(32, 1, 'transactions/next/clFxWjFjRThRcEwrVlpJRndTdVM2Zz09/sudah%20diambil', 'Mengubah status transaksi 23052631-003', '2023-05-31 13:46:27', '2023-05-31 13:46:27', NULL),
(33, 5, 'login', 'Owner Telah login', '2023-05-31 14:34:22', '2023-05-31 14:34:22', NULL),
(34, NULL, 'login', 'Gagal login Staff01 karena akun tidak aktif', '2023-05-31 15:00:33', '2023-05-31 15:00:33', NULL),
(35, 5, 'users/update/ay9paTY5NnlTempKKzVuK0dqZ1Vvdz09', 'Mengubah pengguna ', '2023-05-31 15:00:46', '2023-05-31 15:00:46', NULL),
(36, 1, 'login', 'Staff01 Telah login', '2023-05-31 15:00:53', '2023-05-31 15:00:53', NULL),
(37, 1, 'login', 'Staff01 Telah login', '2023-05-31 15:06:30', '2023-05-31 15:06:30', NULL),
(38, 5, 'login', 'Owner Telah login', '2023-05-31 15:22:00', '2023-05-31 15:22:00', NULL),
(39, 5, 'transactions/next/MDg2WlVoRjI0S1M1UUxndXpTb0pWZz09/dicuci/index', 'Mengubah status transaksi 23052535-002', '2023-05-31 15:22:21', '2023-05-31 15:22:21', NULL),
(40, 5, 'login', 'Owner Telah login', '2023-05-31 22:51:38', '2023-05-31 22:51:38', NULL),
(41, 1, 'login', 'Staff01 Telah login', '2023-05-31 23:27:08', '2023-05-31 23:27:08', NULL),
(42, 5, 'login', 'Owner Telah login', '2023-05-31 23:27:57', '2023-05-31 23:27:57', NULL),
(43, 5, 'login', 'Owner Telah login', '2023-06-01 04:59:39', '2023-06-01 04:59:39', NULL),
(44, 5, 'login', 'Owner Telah login', '2023-06-01 10:40:41', '2023-06-01 10:40:41', NULL),
(45, 2, 'login', 'Staff02 Telah login', '2023-06-01 10:41:04', '2023-06-01 10:41:04', NULL),
(46, 2, 'transactions/store', 'Membuat transaksi 23060132-005', '2023-06-01 10:50:39', '2023-06-01 10:50:39', NULL),
(47, 2, 'transactions/next/bnY1dTBjZ0JBNkFVdlFvM05sNGFNdz09/diproses', 'Mengubah status transaksi 23060132-005', '2023-06-01 10:51:09', '2023-06-01 10:51:09', NULL),
(48, NULL, 'login', 'Gagal login dengan username luthfiihdal98 & password VkZwaUNZT2lteGJMNFdKdGl6Wm1zQT09', '2023-06-02 23:51:47', '2023-06-02 23:51:47', NULL),
(49, 5, 'login', 'Owner Telah login', '2023-06-02 23:51:59', '2023-06-02 23:51:59', NULL),
(50, 5, 'login', 'Owner Telah login', '2023-06-03 00:27:00', '2023-06-03 00:27:00', NULL),
(51, 3, 'login', 'Staff03 Telah login', '2023-06-03 00:35:05', '2023-06-03 00:35:05', NULL),
(52, 5, 'login', 'Owner Telah login', '2023-06-03 02:33:09', '2023-06-03 02:33:09', NULL),
(53, 5, 'login', 'Owner Telah login', '2023-06-03 09:37:08', '2023-06-03 09:37:08', NULL),
(54, 5, 'transactions/next/bnY1dTBjZ0JBNkFVdlFvM05sNGFNdz09/dicuci/index', 'Mengubah status transaksi 23060132-005', '2023-06-03 09:37:51', '2023-06-03 09:37:51', NULL),
(55, NULL, 'login', 'Gagal login dengan username owner & password eWVnaTBBL01TbEw1WmlyU0I1eVZFUT09', '2023-06-03 09:45:34', '2023-06-03 09:45:34', NULL),
(56, 5, 'login', 'Owner Telah login', '2023-06-03 09:46:01', '2023-06-03 09:46:01', NULL),
(57, 3, 'login', 'Staff03 Telah login', '2023-06-03 09:47:20', '2023-06-03 09:47:20', NULL),
(58, 5, 'login', 'Owner Telah login', '2023-06-03 09:48:48', '2023-06-03 09:48:48', NULL),
(59, 5, 'transactions/next/eDNuSnQ2UkxHTlhnd0F1QkNDR1VNUT09/diproses/index', 'Mengubah status transaksi 23052725-004', '2023-06-03 09:58:03', '2023-06-03 09:58:03', NULL),
(60, 1, 'login', 'Staff01 Telah login', '2023-06-03 10:13:07', '2023-06-03 10:13:07', NULL),
(61, 3, 'login', 'Staff03 Telah login', '2023-06-03 10:14:21', '2023-06-03 10:14:21', NULL),
(62, 2, 'login', 'Staff02 Telah login', '2023-06-03 10:14:55', '2023-06-03 10:14:55', NULL),
(63, NULL, 'login', 'Gagal login dengan username owners & password a3R6QlJ0WG9xNGpsai9EQlptSUNuUT09', '2023-06-03 15:29:28', '2023-06-03 15:29:28', NULL),
(64, 5, 'login', 'Owner Telah login', '2023-06-03 15:29:40', '2023-06-03 15:29:40', NULL),
(65, 5, 'login', 'Owner Telah login', '2023-06-03 20:55:04', '2023-06-03 20:55:04', NULL),
(66, 5, 'login', 'Owner Telah login', '2023-06-03 22:16:28', '2023-06-03 22:16:28', NULL),
(67, 3, 'login', 'Staff03 Telah login', '2023-06-03 22:26:52', '2023-06-03 22:26:52', NULL),
(68, 1, 'login', 'Staff01 Telah login', '2023-06-03 22:27:54', '2023-06-03 22:27:54', NULL),
(69, 5, 'login', 'Owner Telah login', '2023-06-04 05:56:24', '2023-06-04 05:56:24', NULL),
(70, 5, 'login', 'Owner Telah login', '2023-06-04 20:17:08', '2023-06-04 20:17:08', NULL),
(71, 1, 'login', 'Staff01 Telah login', '2023-06-04 22:05:48', '2023-06-04 22:05:48', NULL),
(72, 5, 'login', 'Owner Telah login', '2023-06-05 18:51:55', '2023-06-05 18:51:55', NULL),
(73, 5, 'login', 'Owner Telah login', '2023-06-07 16:28:04', '2023-06-07 16:28:04', NULL),
(74, 1, 'login', 'Staff01 Telah login', '2023-06-08 20:50:37', '2023-06-08 20:50:37', NULL),
(75, 2, 'login', 'Staff02 Telah login', '2023-06-08 20:51:16', '2023-06-08 20:51:16', NULL),
(76, 5, 'login', 'Owner Telah login', '2023-06-09 17:43:42', '2023-06-09 17:43:42', NULL),
(77, 2, 'login', 'Staff02 Telah login', '2023-06-09 17:44:38', '2023-06-09 17:44:38', NULL),
(78, 5, 'login', 'Owner Telah login', '2023-06-09 17:45:52', '2023-06-09 17:45:52', NULL),
(79, 5, 'login', 'Owner Telah login', '2023-06-10 08:18:36', '2023-06-10 08:18:36', NULL),
(80, 3, 'login', 'Staff03 Telah login', '2023-06-10 08:28:32', '2023-06-10 08:28:32', NULL),
(81, NULL, 'login', 'Gagal login dengan username owner & password SXhpODlraklCUldvMVVIN3dDZVhWQT09', '2023-06-10 08:38:24', '2023-06-10 08:38:24', NULL),
(82, 5, 'login', 'Owner Telah login', '2023-06-10 08:38:38', '2023-06-10 08:38:38', NULL),
(83, 3, 'login', 'Staff03 Telah login', '2023-06-10 09:03:54', '2023-06-10 09:03:54', NULL),
(84, NULL, 'login', 'Gagal login dengan username staff03 & password THNUVnp0QkVWMkoxMWU0VVpNcHVhdz09', '2023-06-10 09:07:06', '2023-06-10 09:07:06', NULL),
(85, 5, 'login', 'Owner Telah login', '2023-06-10 09:13:21', '2023-06-10 09:13:21', NULL),
(86, 3, 'login', 'Staff03 Telah login', '2023-06-10 09:22:16', '2023-06-10 09:22:16', NULL),
(87, 5, 'login', 'Owner Telah login', '2023-06-10 09:22:30', '2023-06-10 09:22:30', NULL),
(88, 5, 'login', 'Owner Telah login', '2023-06-10 09:55:24', '2023-06-10 09:55:24', NULL),
(89, 3, 'login', 'Staff03 Telah login', '2023-06-10 10:59:17', '2023-06-10 10:59:17', NULL),
(90, 3, 'transactions/store', 'Membuat transaksi 23061023-006', '2023-06-10 10:59:45', '2023-06-10 10:59:45', NULL),
(91, 3, 'transactions/next/TzlvZS9PN0tHaE5WbTVOVkw5Y0YzQT09/diproses/index', 'Mengubah status transaksi 23061023-006', '2023-06-10 10:59:49', '2023-06-10 10:59:49', NULL),
(92, 5, 'login', 'Owner Telah login', '2023-06-10 11:02:59', '2023-06-10 11:02:59', NULL),
(93, 3, 'login', 'Staff03 Telah login', '2023-06-10 11:04:04', '2023-06-10 11:04:04', NULL),
(94, 3, 'login', 'Staff03 Telah login', '2023-06-12 20:15:33', '2023-06-12 20:15:33', NULL),
(95, 3, 'transactions/next/TzlvZS9PN0tHaE5WbTVOVkw5Y0YzQT09/dicuci/index', 'Mengubah status transaksi 23061023-006', '2023-06-12 20:43:01', '2023-06-12 20:43:01', NULL),
(96, 3, 'login', 'Staff03 Telah login', '2023-06-20 23:15:40', '2023-06-20 23:15:40', NULL),
(97, NULL, 'login', 'Gagal login dengan username admin & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2023-06-25 21:10:23', '2023-06-25 21:10:23', NULL),
(98, NULL, 'login', 'Gagal login dengan username admin & password Q3FHdlJjclQ0L2ZhMHBIdmtRdUh1UT09', '2023-06-25 21:10:28', '2023-06-25 21:10:28', NULL),
(99, NULL, 'login', 'Gagal login dengan username admin & password Q3FHdlJjclQ0L2ZhMHBIdmtRdUh1UT09', '2023-06-25 21:10:35', '2023-06-25 21:10:35', NULL),
(100, NULL, 'login', 'Gagal login dengan username admin & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2023-06-25 21:10:41', '2023-06-25 21:10:41', NULL),
(101, 5, 'login', 'Owner Telah login', '2023-06-25 21:11:05', '2023-06-25 21:11:05', NULL),
(102, NULL, 'login', 'Gagal login dengan username admin & password QUhjOGpRbS9KbmhLUmF6ZmNRaytGdz09', '2023-07-04 13:17:11', '2023-07-04 13:17:11', NULL),
(103, NULL, 'login', 'Gagal login dengan username owner & password SXhpODlraklCUldvMVVIN3dDZVhWQT09', '2023-07-04 13:17:15', '2023-07-04 13:17:15', NULL),
(104, NULL, 'login', 'Gagal login dengan username owner & password ZnM5SkR4cXJMOVYySjVyNFlJTStzdz09', '2023-07-04 13:17:23', '2023-07-04 13:17:23', NULL),
(105, NULL, 'login', 'Gagal login dengan username admin & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2023-07-04 13:17:27', '2023-07-04 13:17:27', NULL),
(106, 5, 'login', 'Owner Telah login', '2023-07-04 13:17:32', '2023-07-04 13:17:32', NULL),
(107, NULL, 'login', 'Gagal login dengan username luthfiihdal98 & password ZnM5SkR4cXJMOVYySjVyNFlJTStzdz09', '2023-07-04 13:22:44', '2023-07-04 13:22:44', NULL),
(108, NULL, 'login', 'Gagal login dengan username admin & password d2UyaFNuTUZUV1VzRGlZamxFOWZFUT09', '2023-07-04 13:22:49', '2023-07-04 13:22:49', NULL),
(109, NULL, 'login', 'Gagal login dengan username admin & password Q3FHdlJjclQ0L2ZhMHBIdmtRdUh1UT09', '2023-07-04 13:22:52', '2023-07-04 13:22:52', NULL),
(110, 5, 'login', 'Owner Telah login', '2023-07-04 13:24:19', '2023-07-04 13:24:19', NULL),
(111, 5, 'login', 'Owner Telah login', '2023-08-31 10:09:01', '2023-08-31 10:09:01', NULL),
(112, NULL, 'login', 'Gagal login dengan username owner & password SXhpODlraklCUldvMVVIN3dDZVhWQT09', '2023-08-31 18:52:28', '2023-08-31 18:52:28', NULL),
(113, 5, 'login', 'Owner Telah login', '2023-08-31 18:52:34', '2023-08-31 18:52:34', NULL),
(114, 5, 'login', 'Owner Telah login', '2023-09-01 11:03:14', '2023-09-01 11:03:14', NULL),
(115, NULL, 'login', 'Gagal login dengan username admin & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2023-09-07 08:44:28', '2023-09-07 08:44:28', NULL),
(116, NULL, 'login', 'Gagal login dengan username owner & password SXhpODlraklCUldvMVVIN3dDZVhWQT09', '2023-09-07 08:44:33', '2023-09-07 08:44:33', NULL),
(117, NULL, 'login', 'Gagal login dengan username admin & password ZnM5SkR4cXJMOVYySjVyNFlJTStzdz09', '2023-09-07 08:44:44', '2023-09-07 08:44:44', NULL),
(118, NULL, 'login', 'Gagal login dengan username admin & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2023-09-07 08:44:47', '2023-09-07 08:44:47', NULL),
(119, NULL, 'login', 'Gagal login dengan username admin & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2023-09-07 08:44:54', '2023-09-07 08:44:54', NULL),
(120, NULL, 'login', 'Gagal login dengan username admin & password ZnM5SkR4cXJMOVYySjVyNFlJTStzdz09', '2023-09-07 08:45:20', '2023-09-07 08:45:20', NULL),
(121, NULL, 'login', 'Gagal login dengan username admin & password SU1QNkZEb3ptYVBtS0J4WkhEQ1dKQT09', '2023-09-07 08:45:24', '2023-09-07 08:45:24', NULL),
(122, NULL, 'login', 'Gagal login dengan username admin & password Q3FHdlJjclQ0L2ZhMHBIdmtRdUh1UT09', '2023-09-07 08:45:28', '2023-09-07 08:45:28', NULL),
(123, 5, 'login', 'Owner Telah login', '2023-09-07 08:45:55', '2023-09-07 08:45:55', NULL),
(124, 5, 'login', 'Owner Telah login', '2023-09-07 14:51:46', '2023-09-07 14:51:46', NULL),
(125, 5, 'users/update/M0Zsalc2MnJOaGNwVUZkcDBlNEdUZz09', 'Mengubah pengguna ', '2023-09-07 14:52:26', '2023-09-07 14:52:26', NULL),
(126, NULL, 'forgot-password', 'Reset password berhasil dikirim ke luthfi.ihdalhusnayain98@gmail.com ', '2023-09-07 14:52:56', '2023-09-07 14:52:56', NULL),
(127, NULL, 'forgot-password', 'Reset password berhasil dikirim ke luthfi.ihdalhusnayain98@gmail.com ', '2023-09-07 15:16:21', '2023-09-07 15:16:21', NULL),
(128, NULL, 'forgot-password', 'Reset password berhasil dikirim ke luthfi.ihdalhusnayain98@gmail.com ', '2023-09-08 05:26:55', '2023-09-08 05:26:55', NULL),
(129, 5, 'login', 'Owner Telah login', '2023-09-08 05:28:23', '2023-09-08 05:28:23', NULL),
(130, 5, 'login', 'Owner Telah login', '2023-09-08 16:12:37', '2023-09-08 16:12:37', NULL),
(131, NULL, 'login', 'Gagal login dengan username staff01 & password L2ZCME1Pek5hL0dwK0VnSmJzRzFaZz09', '2023-09-08 16:15:32', '2023-09-08 16:15:32', NULL),
(132, NULL, 'login', 'Gagal login dengan username staff01 & password L2ZCME1Pek5hL0dwK0VnSmJzRzFaZz09', '2023-09-08 16:15:47', '2023-09-08 16:15:47', NULL),
(133, 3, 'login', 'Staff03 Telah login', '2023-09-08 16:16:08', '2023-09-08 16:16:08', NULL),
(134, 3, 'members/store', 'Menambahkan member Dian Sastro', '2023-09-08 16:18:06', '2023-09-08 16:18:06', NULL),
(135, 3, 'transactions/store', 'Membuat transaksi 23090843-007', '2023-09-08 16:21:56', '2023-09-08 16:21:56', NULL),
(136, 3, 'transactions/next/TE1CQjk0L2NkWE9jSXR5aXNCNmd3Zz09/diproses/index', 'Mengubah status transaksi 23090843-007', '2023-09-08 16:22:13', '2023-09-08 16:22:13', NULL),
(137, 3, 'transactions/next/TE1CQjk0L2NkWE9jSXR5aXNCNmd3Zz09/dicuci/index', 'Mengubah status transaksi 23090843-007', '2023-09-08 16:22:36', '2023-09-08 16:22:36', NULL),
(138, 5, 'login', 'Owner Telah login', '2023-09-08 16:22:54', '2023-09-08 16:22:54', NULL),
(139, 5, 'login', 'Owner Telah login', '2023-10-01 21:27:08', '2023-10-01 21:27:08', NULL),
(140, 3, 'login', 'Staff03 Telah login', '2023-10-01 21:28:28', '2023-10-01 21:28:28', NULL),
(141, 5, 'login', 'Owner Telah login', '2023-10-01 21:32:07', '2023-10-01 21:32:07', NULL),
(142, NULL, 'login', 'Gagal login dengan username admin & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2023-10-05 15:57:40', '2023-10-05 15:57:40', NULL),
(143, NULL, 'login', 'Gagal login dengan username admin & password aUtYbXlST2pHRlNOeFNHcThmUk94dz09', '2023-10-05 15:57:47', '2023-10-05 15:57:47', NULL),
(144, 5, 'login', 'Owner Telah login', '2023-10-05 15:59:08', '2023-10-05 15:59:08', NULL),
(145, NULL, 'login', 'Gagal login dengan username admin & password SU1QNkZEb3ptYVBtS0J4WkhEQ1dKQT09', '2023-10-11 23:35:59', '2023-10-11 23:35:59', NULL),
(146, NULL, 'login', 'Gagal login dengan username admin & password Q3FHdlJjclQ0L2ZhMHBIdmtRdUh1UT09', '2023-10-11 23:36:06', '2023-10-11 23:36:06', NULL),
(147, NULL, 'login', 'Gagal login dengan username admin & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2023-12-04 15:02:20', '2023-12-04 15:02:20', NULL),
(148, 5, 'login', 'Owner Telah login', '2023-12-04 15:02:34', '2023-12-04 15:02:34', NULL),
(149, NULL, 'login', 'Gagal login dengan username owners & password a3R6QlJ0WG9xNGpsai9EQlptSUNuUT09', '2023-12-14 10:09:13', '2023-12-14 10:09:13', NULL),
(150, 5, 'login', 'Owner Telah login', '2023-12-14 10:09:18', '2023-12-14 10:09:18', NULL),
(151, 5, 'transactions/next/eDNuSnQ2UkxHTlhnd0F1QkNDR1VNUT09/dicuci/index', 'Mengubah status transaksi 23052725-004', '2023-12-14 10:10:08', '2023-12-14 10:10:08', NULL),
(152, 5, 'transactions/next/TE1CQjk0L2NkWE9jSXR5aXNCNmd3Zz09/siap%20diambil/index', 'Mengubah status transaksi 23090843-007', '2023-12-14 10:10:18', '2023-12-14 10:10:18', NULL),
(153, 5, 'login', 'Owner Telah login', '2024-03-05 19:25:50', '2024-03-05 19:25:50', NULL),
(154, NULL, 'login', 'Gagal login dengan username admin & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2024-06-03 09:40:43', '2024-06-03 09:40:43', NULL),
(155, NULL, 'login', 'Gagal login dengan username administrator & password UjlWOXJ5emFKMnVCWmRRWFZHaW0vZz09', '2024-06-03 09:40:50', '2024-06-03 09:40:50', NULL),
(156, NULL, 'login', 'Gagal login dengan username admin & password aUtYbXlST2pHRlNOeFNHcThmUk94dz09', '2024-06-03 09:40:54', '2024-06-03 09:40:54', NULL),
(157, NULL, 'login', 'Gagal login dengan username admin & password ZnM5SkR4cXJMOVYySjVyNFlJTStzdz09', '2024-06-03 09:40:57', '2024-06-03 09:40:57', NULL),
(158, NULL, 'login', 'Gagal login dengan username admin & password WFRLZzYzS29Ic1gyZmlwUTAyUHFkUT09', '2024-06-03 09:41:01', '2024-06-03 09:41:01', NULL),
(159, NULL, 'login', 'Gagal login dengan username administrator & password WFRLZzYzS29Ic1gyZmlwUTAyUHFkUT09', '2024-06-03 09:41:10', '2024-06-03 09:41:10', NULL),
(160, NULL, 'login', 'Gagal login dengan username owner & password SXhpODlraklCUldvMVVIN3dDZVhWQT09', '2024-06-03 09:41:14', '2024-06-03 09:41:14', NULL),
(161, NULL, 'login', 'Gagal login dengan username owner & password aUtYbXlST2pHRlNOeFNHcThmUk94dz09', '2024-06-03 09:41:19', '2024-06-03 09:41:19', NULL),
(162, NULL, 'login', 'Gagal login dengan username owner & password aUtYbXlST2pHRlNOeFNHcThmUk94dz09', '2024-06-03 09:41:52', '2024-06-03 09:41:52', NULL),
(163, 5, 'login', 'Owner Telah login', '2024-06-03 09:41:56', '2024-06-03 09:41:56', NULL),
(164, 5, 'setting/save-access', 'Memperbarui pengaturan hak akses', '2024-06-03 09:43:46', '2024-06-03 09:43:46', NULL),
(165, 5, 'transactions/store', 'Membuat transaksi 24060345-008', '2024-06-03 09:45:03', '2024-06-03 09:45:03', NULL),
(166, 5, 'transactions/next/czhpOXh3Y29ucWNvWXI1U1JnQWRBUT09/diproses', 'Mengubah status transaksi 24060345-008', '2024-06-03 09:45:49', '2024-06-03 09:45:49', NULL),
(167, NULL, 'login', 'Gagal login dengan username staff01 & password L2ZCME1Pek5hL0dwK0VnSmJzRzFaZz09', '2024-06-03 11:40:46', '2024-06-03 11:40:46', NULL),
(168, 1, 'login', 'Staff01 Telah login', '2024-06-03 11:40:53', '2024-06-03 11:40:53', NULL),
(169, 5, 'login', 'Owner Telah login', '2024-06-03 11:47:42', '2024-06-03 11:47:42', NULL),
(170, 5, 'login', 'Owner Telah login', '2024-06-06 21:00:09', '2024-06-06 21:00:09', NULL),
(171, NULL, 'login', 'Gagal login dengan username owners & password SXhpODlraklCUldvMVVIN3dDZVhWQT09', '2024-07-03 09:58:41', '2024-07-03 09:58:41', NULL),
(172, 5, 'login', 'Owner Telah login', '2024-07-03 09:58:46', '2024-07-03 09:58:46', NULL),
(173, 5, 'transactions/store', 'Membuat transaksi 24070315-009', '2024-07-03 10:00:53', '2024-07-03 10:00:53', NULL),
(174, 5, 'transactions/next/YWIxdWlXemd1TURPTS80NDBNaUZjZz09/diproses', 'Mengubah status transaksi 24070315-009', '2024-07-03 10:01:14', '2024-07-03 10:01:14', NULL),
(175, 5, 'transactions/update/YWIxdWlXemd1TURPTS80NDBNaUZjZz09', 'Mengubah transaksi 24070315-009', '2024-07-03 10:03:21', '2024-07-03 10:03:21', NULL),
(176, 5, 'transactions/next/YWIxdWlXemd1TURPTS80NDBNaUZjZz09/dicuci', 'Mengubah status transaksi 24070315-009', '2024-07-03 10:03:48', '2024-07-03 10:03:48', NULL),
(177, 5, 'login', 'Owner Telah login', '2024-07-26 08:06:42', '2024-07-26 08:06:42', NULL),
(178, NULL, 'login', 'Gagal login dengan username owners & password SXhpODlraklCUldvMVVIN3dDZVhWQT09', '2024-08-30 10:05:19', '2024-08-30 10:05:19', NULL),
(179, 5, 'login', 'Owner Telah login', '2024-08-30 10:05:35', '2024-08-30 10:05:35', NULL),
(180, 5, 'login', 'Owner Telah login', '2024-09-02 14:20:26', '2024-09-02 14:20:26', NULL),
(181, 5, 'login', 'Owner Telah login', '2024-10-08 08:01:42', '2024-10-08 08:01:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` enum('Pria','Wanita') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `phone`, `email`, `address`, `gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Luthfi Ihdalhusnayain', '0895322316585', 'luthfi.ihdalhusnayain98@gmail.com', 'Jl. Marunda Baru 6', 'Pria', '2023-05-22 14:50:26', '2023-05-22 14:52:57', NULL),
(2, 'Siti Aisyah', '085890836201', 'aisyahsiti461@gmail.com', 'Gang Regge', 'Wanita', '2023-05-22 14:55:23', '2023-05-22 21:55:38', NULL),
(3, 'Muhammad Rafli Syaban', '00000000000', 'rafli@gmail.com', 'Jl. Marunda Baru 6', 'Pria', '2023-05-25 13:32:19', '2023-05-25 13:32:19', NULL),
(4, 'Dian Sastro', '088762525151', 'dian@gmail.com', 'Jl. Cakung Raya, Jakarta Timur', 'Wanita', '2023-09-08 16:18:06', '2023-09-08 16:18:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cuci kering dan Setrika', 'Pakaian dicuci sesuai dengan bahan pakaian, kemudian di jemur dan disetrika', '2023-05-22 13:43:43', '2023-05-22 13:56:27', NULL),
(2, 'Setrika', 'Pakaian Hanya dilakukan penyetrikaan saja', '2023-05-22 13:44:26', '2023-05-22 13:44:26', NULL),
(3, 'Cuci Lipat', 'Pakaian Hanya dilakukan pencucian dan pelipatan pakaian tanpa di setrika', '2023-05-22 13:45:56', '2023-05-22 21:01:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_details`
--

CREATE TABLE `service_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `unit` enum('Pcs','Kg') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service_details`
--

INSERT INTO `service_details` (`id`, `service_id`, `name`, `price`, `unit`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Baju kiloan', 8000, 'Kg', '2023-05-22 14:20:51', '2023-05-22 21:32:59', NULL),
(2, 1, 'Kemeja', 15000, 'Pcs', '2023-05-22 14:33:46', '2023-05-22 14:33:46', NULL),
(3, 1, 'Jaket', 30000, 'Pcs', '2023-05-22 14:34:03', '2023-05-22 14:34:03', NULL),
(4, 1, 'Rok', 30000, 'Pcs', '2023-05-22 14:34:20', '2023-05-22 14:34:29', NULL),
(5, 1, 'Bedcover single', 20000, 'Pcs', '2023-05-22 14:34:47', '2023-05-22 14:34:47', NULL),
(6, 1, 'Bedcover standart', 25000, 'Pcs', '2023-05-22 14:35:01', '2023-05-22 14:35:01', NULL),
(7, 1, 'Bedcover king', 30000, 'Pcs', '2023-05-22 14:35:15', '2023-05-22 14:35:15', NULL),
(8, 1, 'Sweater ', 15000, 'Pcs', '2023-05-22 14:35:27', '2023-05-22 14:35:27', NULL),
(9, 1, 'Oia selimut', 15000, 'Pcs', '2023-05-22 14:35:45', '2023-05-22 14:35:45', NULL),
(10, 1, 'Sprei 1 set', 15000, 'Pcs', '2023-05-22 14:36:01', '2023-05-22 14:36:01', NULL),
(11, 2, 'Setrika Pakaian', 6000, 'Kg', '2023-05-22 14:36:31', '2023-05-22 14:36:31', NULL),
(12, 3, 'Cuci Lipat Pakaian', 6000, 'Kg', '2023-05-22 14:36:46', '2023-05-22 14:36:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(15) NOT NULL,
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `discount` char(3) DEFAULT NULL,
  `tax` char(2) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `due_time` time DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_status` enum('sudah dibayar','belum dibayar') NOT NULL DEFAULT 'belum dibayar',
  `status` enum('diterima','diproses','dicuci','siap diambil','sudah diambil') NOT NULL DEFAULT 'diterima',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `code`, `member_id`, `subtotal`, `discount`, `tax`, `total`, `due_date`, `due_time`, `payment_date`, `payment_status`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '23052515-001', 1, 151000, '0', '0', 151000, '2023-05-27', '12:44:35', '2023-05-25 12:22:08', 'sudah dibayar', 'sudah diambil', 5, NULL, '2023-05-25 12:22:08', '2023-05-26 06:30:31', NULL),
(2, '23052535-002', 3, 61000, '3', '0', 59170, '2023-05-27', '03:15:00', '2023-05-25 19:43:03', 'sudah dibayar', 'dicuci', 5, NULL, '2023-05-25 19:41:33', '2023-05-31 15:22:21', NULL),
(3, '23052631-003', 3, 118000, '2', '11', 128620, '2023-05-27', '03:15:07', '2023-05-27 03:15:10', 'sudah dibayar', 'sudah diambil', 1, NULL, '2023-05-26 21:10:08', '2023-05-31 13:46:27', NULL),
(4, '23052725-004', 2, 24000, '0', '0', 24000, '2023-05-27', '07:55:47', NULL, 'belum dibayar', 'dicuci', 5, NULL, '2023-05-27 07:47:43', '2023-12-14 10:10:08', NULL),
(5, '23060132-005', 3, 100000, '10', '2', 92000, '2023-06-05', '10:00:00', '2023-06-01 10:50:39', 'sudah dibayar', 'dicuci', 2, NULL, '2023-06-01 10:50:39', '2023-06-03 09:37:51', NULL),
(6, '23061023-006', 2, 6000, '777', '0', -460620, '2023-06-10', '10:59:00', '2023-06-10 10:59:45', 'sudah dibayar', 'dicuci', 3, NULL, '2023-06-10 10:59:45', '2023-06-12 20:43:01', NULL),
(7, '23090843-007', 4, 40000, '0', '0', 40000, '2023-09-12', '22:00:00', '2023-09-08 16:21:56', 'sudah dibayar', 'siap diambil', 3, NULL, '2023-09-08 16:21:56', '2023-12-14 10:10:18', NULL),
(8, '24060345-008', 4, 288000, '2', '11', 313920, '2024-06-06', '09:00:00', '2024-06-03 09:45:03', 'sudah dibayar', 'diproses', 5, NULL, '2024-06-03 09:45:03', '2024-06-03 09:45:49', NULL),
(9, '24070315-009', 1, 288000, '5', '10', 302400, '2024-07-03', '10:02:53', NULL, 'sudah dibayar', 'dicuci', 5, NULL, '2024-07-03 10:00:53', '2024-07-03 10:03:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `transaction_id` int(10) UNSIGNED DEFAULT NULL,
  `service_detail_id` int(10) UNSIGNED DEFAULT NULL,
  `weight` decimal(10,0) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `service_detail_id`, `weight`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, 8000, '2023-05-25 19:22:08', NULL, NULL),
(2, 1, 3, 2, 30000, '2023-05-25 19:22:08', NULL, NULL),
(3, 1, 2, 5, 15000, '2023-05-25 19:22:08', NULL, NULL),
(4, 2, 1, 2, 8000, '2023-05-26 02:41:33', NULL, NULL),
(5, 2, 8, 3, 15000, '2023-05-26 02:41:33', NULL, NULL),
(6, 3, 12, 1, 6000, '2023-05-27 04:10:08', NULL, NULL),
(7, 3, 11, 2, 6000, '2023-05-27 04:10:08', NULL, NULL),
(8, 3, 1, 5, 8000, '2023-05-27 04:10:08', NULL, NULL),
(9, 3, 3, 2, 30000, '2023-05-27 04:10:08', NULL, NULL),
(10, 4, 1, 3, 8000, '2023-05-27 14:47:43', NULL, NULL),
(11, 5, 1, 5, 8000, '2023-06-01 17:50:39', NULL, NULL),
(12, 5, 7, 2, 30000, '2023-06-01 17:50:39', NULL, NULL),
(13, 6, 11, 1, 6000, '2023-06-10 10:59:45', NULL, NULL),
(14, 7, 1, 5, 8000, '2023-09-08 16:21:56', NULL, NULL),
(15, 8, 4, 4, 30000, '2024-06-03 09:45:03', NULL, NULL),
(16, 8, 7, 5, 30000, '2024-06-03 09:45:03', NULL, NULL),
(17, 8, 11, 3, 6000, '2024-06-03 09:45:03', NULL, NULL),
(18, 9, 12, 8, 6000, '2024-07-03 10:00:53', NULL, NULL),
(19, 9, 4, 6, 30000, '2024-07-03 10:00:53', NULL, NULL),
(20, 9, 11, 10, 6000, '2024-07-03 10:00:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`id`, `transaction_id`, `status`, `user_id`, `description`, `created_at`) VALUES
(1, 1, 'dibuat', 5, 'Pesanan laundry dibuat', '2023-05-25 19:22:08'),
(2, 1, 'diproses', 5, 'Status pesanan diubah dari diterima menjadi diproses', '2023-05-25 19:25:13'),
(3, 1, 'dicuci', 5, 'Status pesanan diubah dari diproses menjadi dicuci', '2023-05-25 19:43:27'),
(4, 1, 'siap diambil', 5, 'Status pesanan diubah dari dicuci menjadi siap diambil', '2023-05-25 19:44:13'),
(5, 1, 'sudah diambil', 5, 'Status pesanan diubah dari siap diambil menjadi sudah diambil', '2023-05-25 19:44:21'),
(6, 1, 'diubah', 5, 'Pesanan laundry diperbarui', '2023-05-25 19:44:39'),
(7, 2, 'dibuat', 5, 'Pesanan laundry dibuat', '2023-05-26 02:41:33'),
(8, 2, 'diubah', 5, 'Pesanan laundry diperbarui', '2023-05-26 02:43:03'),
(9, 2, 'diubah', 5, 'Pesanan laundry diperbarui', '2023-05-26 02:43:16'),
(10, 2, 'diproses', 5, 'Status pesanan diubah dari diterima menjadi diproses', '2023-05-26 02:44:38'),
(11, 3, 'dibuat', 1, 'Pesanan laundry dibuat', '2023-05-27 04:10:08'),
(12, 3, 'diproses', 5, 'Status pesanan diubah dari diterima menjadi diproses', '2023-05-27 10:14:52'),
(13, 2, 'diubah', 5, 'Pesanan laundry diperbarui', '2023-05-27 10:15:04'),
(14, 3, 'diubah', 5, 'Pesanan laundry diperbarui', '2023-05-27 10:15:10'),
(15, 4, 'dibuat', 5, 'Pesanan laundry dibuat', '2023-05-27 14:47:43'),
(16, 4, 'diubah', 5, 'Pesanan laundry diperbarui', '2023-05-27 14:55:50'),
(17, 3, 'dicuci', 5, 'Status pesanan diubah dari diproses menjadi dicuci', '2023-05-27 15:16:51'),
(18, 3, 'siap diambil', 1, 'Status pesanan diubah dari dicuci menjadi siap diambil', '2023-05-31 20:46:24'),
(19, 3, 'sudah diambil', 1, 'Status pesanan diubah dari siap diambil menjadi sudah diambil', '2023-05-31 20:46:27'),
(20, 2, 'dicuci', 5, 'Status pesanan diubah dari diproses menjadi dicuci', '2023-05-31 22:22:21'),
(21, 5, 'dibuat', 2, 'Pesanan laundry dibuat', '2023-06-01 17:50:39'),
(22, 5, 'diproses', 2, 'Status pesanan diubah dari diterima menjadi diproses', '2023-06-01 17:51:09'),
(23, 5, 'dicuci', 5, 'Status pesanan diubah dari diproses menjadi dicuci', '2023-06-03 09:37:51'),
(24, 4, 'diproses', 5, 'Status pesanan diubah dari diterima menjadi diproses', '2023-06-03 09:58:03'),
(25, 6, 'dibuat', 3, 'Pesanan laundry dibuat', '2023-06-10 10:59:45'),
(26, 6, 'diproses', 3, 'Status pesanan diubah dari diterima menjadi diproses', '2023-06-10 10:59:49'),
(27, 6, 'dicuci', 3, 'Status pesanan diubah dari diproses menjadi dicuci', '2023-06-12 20:43:01'),
(28, 7, 'dibuat', 3, 'Pesanan laundry dibuat', '2023-09-08 16:21:56'),
(29, 7, 'diproses', 3, 'Status pesanan diubah dari diterima menjadi diproses', '2023-09-08 16:22:13'),
(30, 7, 'dicuci', 3, 'Status pesanan diubah dari diproses menjadi dicuci', '2023-09-08 16:22:36'),
(31, 4, 'dicuci', 5, 'Status pesanan diubah dari diproses menjadi dicuci', '2023-12-14 10:10:08'),
(32, 7, 'siap diambil', 5, 'Status pesanan diubah dari dicuci menjadi siap diambil', '2023-12-14 10:10:18'),
(33, 8, 'dibuat', 5, 'Pesanan laundry dibuat', '2024-06-03 09:45:03'),
(34, 8, 'diproses', 5, 'Status pesanan diubah dari diterima menjadi diproses', '2024-06-03 09:45:49'),
(35, 9, 'dibuat', 5, 'Pesanan laundry dibuat', '2024-07-03 10:00:53'),
(36, 9, 'diproses', 5, 'Status pesanan diubah dari diterima menjadi diproses', '2024-07-03 10:01:14'),
(37, 9, 'diubah', 5, 'Pesanan laundry diperbarui', '2024-07-03 10:03:21'),
(38, 9, 'dicuci', 5, 'Status pesanan diubah dari diproses menjadi dicuci', '2024-07-03 10:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `token` varchar(150) DEFAULT NULL,
  `expired` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `role` enum('Staff','Owner') NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone`, `email`, `username`, `password`, `token`, `expired`, `status`, `role`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Staff01', '00000000000', 'luthfi.ihdalhusnayain98@gmail.com', 'staff01', '$2y$10$x3YmY18bNKMEb2KmiZVy1ec27.OfpQKsCVy7DE738hOxSIf5kTaOK', 'cVhMazFoTE96RkNQYjQxd1EwUWVGZz09', '2023-09-08 05:31:52', 1, 'Staff', '/uploads/users/646bedde37687-23-05-22-sourcing.webp', '2023-05-22 15:14:11', '2023-09-08 05:27:17', NULL),
(2, 'Staff02', '0000000000000', '', 'staff02', '$2y$10$yRsQWE56b0c5DVKxXU.KBu4qduTPkU/h54WjRyKUrSN0aZ03keuzy', NULL, NULL, 1, 'Staff', NULL, '2023-05-22 22:10:43', '2023-05-22 22:10:43', NULL),
(3, 'Staff03', '0000000000000', '', 'staff03', '$2y$10$IX/edKtBCkJ01NK9ei8wN.YnI9goHQ2O9VlbXmTMVd.azwJgKqHhi', NULL, NULL, 1, 'Staff', NULL, '2023-05-22 22:11:50', '2023-05-22 22:11:50', NULL),
(4, 'Staff04', '00000000000000', '', 'staff04', '$2y$10$3Gxct4TaOJQxtDQxC7JZGOGV0EVw.7/2/31Ir0P8NyXaQ9tS8C/jy', NULL, NULL, 1, 'Staff', '/uploads/users/646be949ea09e-23-05-22-multiple-users-silhouette.webp', '2023-05-22 22:14:34', '2023-05-22 22:14:34', NULL),
(5, 'Owner', '0000000000000', '', 'owner', '$2y$10$JNIyYZTzDJaMI8.dlm33.uAeFi4XAFfjHkbJs69KWgTfDt22lxSzW', NULL, NULL, 1, 'Owner', NULL, '2023-05-24 06:20:47', '2023-05-24 06:20:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_details`
--
ALTER TABLE `service_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_details`
--
ALTER TABLE `service_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `service_details`
--
ALTER TABLE `service_details`
  ADD CONSTRAINT `service_details_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
