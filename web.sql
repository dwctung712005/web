-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 02, 2026 lúc 12:44 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `created_at`) VALUES
(1, 'Nguyễn Văn Anh', 'vananh@gmail.com', '2026-07-01 20:48:00'),
(2, 'Trần Thị Bình', 'thibinh@gmail.com', '2026-07-01 20:48:00'),
(3, 'Lê Hoàng Cường', 'hoangcuong@gmail.com', '2026-07-01 20:48:00'),
(4, 'Phạm Minh Đức', 'minhduc@gmail.com', '2026-07-01 20:48:00'),
(5, 'Vũ Thu Thảo', 'thuthao@gmail.com', '2026-07-01 20:48:00'),
(6, 'Hoàng Đình Hải', 'dinhhai@gmail.com', '2026-07-01 20:48:00'),
(7, 'Đặng Hồng Nhung', 'hongnhung@gmail.com', '2026-07-01 20:48:00'),
(8, 'Bùi Quang Huy', 'quanghuy@gmail.com', '2026-07-01 20:48:00'),
(9, 'Đỗ Thúy Vy', 'thuyvy@gmail.com', '2026-07-01 20:48:00'),
(10, 'Ngô Tiến Dũng', 'tiendung@gmail.com', '2026-07-01 20:48:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
