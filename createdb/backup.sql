-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2019 lúc 03:37 PM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ltk` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `ltk`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Thu Hà', 'cb1@gmail.com', 'user.jpg', 'quanly', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(2, 'Nguyễn Văn Nam', 'cb2@gmail.com', 'user.jpg', 'quanly', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(3, 'Lê Thanh Bình', 'cb3@gmail.com', 'user.jpg', 'quanly', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(4, 'Bùi Thị Thu', 'cb4@gmail.com', 'user.jpg', 'quanly', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(5, 'admin', 'admin@gmail.com', 'user.jpg', 'admin', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(6, 'hung', 'hung@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, '2019-07-08 02:53:18', '2019-07-08 03:28:59'),
(7, 'Sinh vien 1', 'sv1@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(8, 'Sinh vien 2', 'sv2@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(9, 'Sinh vien 3', 'sv3@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(10, 'Sinh vien 4', 'sv4@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(11, 'Sinh vien 5', 'sv5@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(12, 'Trần Thu Huyền', 'huyen@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$cEDLdFzpJXSaj7HI0HC.eeZY5rxyfF/RFREFBrrwU4VZRfscX6bFO', NULL, '2019-07-08 03:58:56', '2019-07-08 03:58:56');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
