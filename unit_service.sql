-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th5 07, 2018 lúc 02:23 AM
-- Phiên bản máy phục vụ: 5.7.20
-- Phiên bản PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `htaccess_relation2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `export`
--

CREATE TABLE `export` (
  `id` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `export_category_id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `money` int(11) NOT NULL,
  `date` date NOT NULL,
  `money_first` int(11) NOT NULL,
  `debt` int(11) NOT NULL,
  `discount_type` smallint(4) NOT NULL,
  `discount` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `updater` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `export_categories`
--

CREATE TABLE `export_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `export_products`
--

CREATE TABLE `export_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price_import` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `export_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `export_services`
--

CREATE TABLE `export_services` (
  `id` int(11) NOT NULL,
  `export_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import`
--

CREATE TABLE `import` (
  `id` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `import_category_id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `money` int(11) NOT NULL,
  `date` text COLLATE utf8_unicode_ci NOT NULL,
  `money_first` int(11) NOT NULL,
  `debt` int(11) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `updater` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import_categories`
--

CREATE TABLE `import_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import_products`
--

CREATE TABLE `import_products` (
  `id` int(11) NOT NULL,
  `import_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_import` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `money` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_services`
--

CREATE TABLE `order_services` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `price_import` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `number_warning` int(11) NOT NULL,
  `price_sale` int(11) NOT NULL,
  `percent_sale` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_categories`
--

INSERT INTO `product_categories` (`id`, `code`, `name`, `status`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'CID0', 'Thức ăn cho chó', 1, 2, 0, 1525581697),
(2, 'CID2', 'Cá', 1, 3, 0, 1525539452),
(3, 'CID3', 'Mè', 1, 0, 0, 1525537332),
(4, 'CID4', 'Quả', 1, 3, 0, 1525539473),
(6, 'CID5', 'hải duy', 1, 3, 1525539465, 1525539486),
(7, 'CID6', 'beo', 1, 0, 1525539469, 1525539469),
(8, 'CID7', 'fat from cd', 1, 2, 1525539733, 1525539837),
(13, 'CID8', 'Tin tức', 1, 0, 1525586328, 1525586328),
(14, 'CID9', 'Fat ', 1, 13, 1525586342, 1525586378),
(16, 'CID10', 'nothing', 1, 0, 1525586635, 1525586635),
(17, 'CID11', 'cc', 1, 1, 1525586644, 1525586870);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_units`
--

CREATE TABLE `product_units` (
  `id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_units`
--

INSERT INTO `product_units` (`id`, `code`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'UID1', 'Chiếc', 1, 0, 0),
(2, 'UID2', 'Cái', 1, 0, 1525576096),
(3, 'UID3', 'dsa', 1, 1525576203, 1525576203),
(10, 'UID4', 'vai ca dai', 1, 1525576579, 1525582633),
(21, 'UID5', 'dsaxdddxxx', 1, 1525588433, 1525597368);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `code`, `name`, `price`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'SVID1', 'Lắp đặt camera', 30000, 1, 'nothing1', 0, 1525611849),
(7, 'SVID7', 'beos fat from cd ', 10000, 1, '', 1525628534, 1525628534);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `manager` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `creator` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `permission` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `code`, `username`, `password`, `name`, `image`, `gender`, `birthday`, `address`, `email`, `phone`, `status`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'AD0', 'admin', '123456', 'Nguyễn Hải Duy', '', 1, '1996-04-23', 'Hà Nội', 'admin@gmail.com', '', 1, 1, 1448950572, 1525510247),
(3, 'MN1', 'tutran', '132', 'Trần Anh Tú', '', 2, '2010-05-02', 'nhà tú chứ đâu', 'tu@gmail.com', '321321', 1, 2, 1458132295, 1525438284),
(21, 'AD2', 'fat', '197011', 'nguyen ha duy', '', 1, '1970-01-01', '3231', '', '', 1, 1, 1525452581, 1525454813),
(22, 'EM1', 'lam', '197011', 'Đỗ Tùng Lâm', '', 1, '1970-01-01', '', '', '', 1, 3, 1525488669, 1525488669),
(23, 'EM5', 'hieu', '197011', 'Phạm Văn Hiếu', '', 1, '1970-01-01', 'xxx', '', '', 1, 3, 1525488689, 1525536815),
(24, 'EM6', 'sac', '197011', 'Nguyễn Minh Sắc', '', 1, '1970-01-01', '', '', '', 1, 3, 1525488704, 1525499763),
(25, 'EM7', 'minh', '197011', 'Nguyễn Bình Minh', '', 1, '1970-01-01', '', '', '', 1, 3, 1525488723, 1525499776),
(26, 'EM8', 'quy', '197011', 'Nguyễn Văn Quy', '', 1, '1970-01-01', '', '', '', 1, 3, 1525488731, 1525499780),
(27, 'MN2', 'dung', '197011', 'Trần Anh Dũng', '', 1, '1970-01-01', '', '', '', 1, 2, 1525488745, 1525488745),
(28, 'EM2', 'anh', '197011', 'Đinh Tố Anh', '', 1, '1970-01-01', '', '', '', 1, 3, 1525488757, 1525488757);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `group_id` (`group_id`,`creator`),
  ADD KEY `creator` (`creator`);

--
-- Chỉ mục cho bảng `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `export`
--
ALTER TABLE `export`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `creator` (`creator`),
  ADD KEY `updater` (`updater`),
  ADD KEY `customer_id` (`customer_id`,`export_category_id`),
  ADD KEY `export_category_id` (`export_category_id`);

--
-- Chỉ mục cho bảng `export_categories`
--
ALTER TABLE `export_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `export_products`
--
ALTER TABLE `export_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `export_id` (`export_id`);

--
-- Chỉ mục cho bảng `export_services`
--
ALTER TABLE `export_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `export_id` (`export_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Chỉ mục cho bảng `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `creator` (`creator`,`supplier_id`,`import_category_id`,`updater`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `import_category_id` (`import_category_id`),
  ADD KEY `updater` (`updater`);

--
-- Chỉ mục cho bảng `import_categories`
--
ALTER TABLE `import_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `import_products`
--
ALTER TABLE `import_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `import_id` (`import_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`,`order_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `order_services`
--
ALTER TABLE `order_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`,`order_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `category_id` (`category_id`,`unit_id`,`creator`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Chỉ mục cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `product_units`
--
ALTER TABLE `product_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator` (`creator`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `export`
--
ALTER TABLE `export`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `export_categories`
--
ALTER TABLE `export_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `export_products`
--
ALTER TABLE `export_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `export_services`
--
ALTER TABLE `export_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `import`
--
ALTER TABLE `import`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `import_categories`
--
ALTER TABLE `import_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `import_products`
--
ALTER TABLE `import_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_services`
--
ALTER TABLE `order_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `product_units`
--
ALTER TABLE `product_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `customer_groups` (`id`),
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `export`
--
ALTER TABLE `export`
  ADD CONSTRAINT `export_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `export_ibfk_2` FOREIGN KEY (`updater`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `export_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `export_ibfk_4` FOREIGN KEY (`export_category_id`) REFERENCES `export_categories` (`id`);

--
-- Các ràng buộc cho bảng `export_products`
--
ALTER TABLE `export_products`
  ADD CONSTRAINT `export_products_ibfk_1` FOREIGN KEY (`export_id`) REFERENCES `export` (`id`),
  ADD CONSTRAINT `export_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `export_services`
--
ALTER TABLE `export_services`
  ADD CONSTRAINT `export_services_ibfk_1` FOREIGN KEY (`export_id`) REFERENCES `export` (`id`),
  ADD CONSTRAINT `export_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Các ràng buộc cho bảng `import`
--
ALTER TABLE `import`
  ADD CONSTRAINT `import_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `import_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `import_ibfk_3` FOREIGN KEY (`import_category_id`) REFERENCES `import_categories` (`id`),
  ADD CONSTRAINT `import_ibfk_4` FOREIGN KEY (`updater`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `import_products`
--
ALTER TABLE `import_products`
  ADD CONSTRAINT `import_products_ibfk_1` FOREIGN KEY (`import_id`) REFERENCES `import` (`id`),
  ADD CONSTRAINT `import_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `order_services`
--
ALTER TABLE `order_services`
  ADD CONSTRAINT `order_services_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `product_units` (`id`);

--
-- Các ràng buộc cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
