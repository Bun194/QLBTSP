-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th1 14, 2024 lúc 10:41 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlbaotri`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int NOT NULL,
  `EmployeeName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Position` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PhoneNumber` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`EmployeeID`, `EmployeeName`, `Position`, `PhoneNumber`, `Username`, `Password`) VALUES
(1, 'Van A', 'Kỹ sư phần mềm', '111-222-3333', 'vana', 'hashed_password_4'),
(2, 'Van B', 'Kỹ thuật viên điện thoại', '444-555-6666', 'vanb', 'hashed_password_5'),
(3, 'Van C', 'Chuyên gia về pin', '777-888-9999', 'vanc', 'hashed_password_6');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `maintenance`
--

CREATE TABLE `maintenance` (
  `MaintenanceID` int NOT NULL,
  `ProductsID` int DEFAULT NULL,
  `EmployeeID` int DEFAULT NULL,
  `MaintenanceDate` date DEFAULT NULL,
  `Description` text COLLATE utf8mb4_general_ci,
  `MaintenanceCost` decimal(10,2) DEFAULT NULL,
  `CompletionStatus` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `maintenance`
--

INSERT INTO `maintenance` (`MaintenanceID`, `ProductsID`, `EmployeeID`, `MaintenanceDate`, `Description`, `MaintenanceCost`, `CompletionStatus`) VALUES
(1, 1, 1, '2024-04-02', 'Tối ưu hóa phần mềm và sửa lỗi', 30.00, 'Hoàn thành'),
(2, 2, 2, '2024-05-10', 'Thay thế mô-đun máy ảnh', 60.00, 'Đang sửa chửa'),
(3, 3, 3, '2024-06-20', 'Hiệu chuẩn pin', 40.00, 'Chưa hoàn thành');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ProductsID` int NOT NULL,
  `ProductsName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ProductsImage` blob,
  `Description` text COLLATE utf8mb4_general_ci,
  `PurchaseDate` date DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  `Status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ProductsID`, `ProductsName`, `ProductsImage`, `Description`, `PurchaseDate`, `Quantity`, `Status`) VALUES
(1, 'Samsung Galaxy S22', NULL, 'Điện thoại thông minh hàng đầu mới nhất với các tính năng tiên tiến', '2024-01-01', 15, 'Trong kho'),
(2, 'iPhone 14 Pro', NULL, 'Model sắp ra mắt với camera và hiệu suất được cải thiện', '2024-02-10', 10, 'Trong kho'),
(3, 'OnePlus 10', NULL, 'Thiết bị Android thế hệ tiếp theo với công nghệ tiên tiến', '2024-03-15', 8, 'Có sẵn');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Chỉ mục cho bảng `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`MaintenanceID`),
  ADD KEY `maintenance_ibfk_1` (`ProductsID`),
  ADD KEY `maintenance_ibfk_2` (`EmployeeID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductsID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `MaintenanceID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ProductsID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`ProductsID`) REFERENCES `products` (`ProductsID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `maintenance_ibfk_2` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
