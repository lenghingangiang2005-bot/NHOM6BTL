-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th6 24, 2026 lúc 08:39 PM
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
-- Cơ sở dữ liệu: `cafe_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ban`
--

CREATE TABLE `ban` (
  `ma_ban` int(11) NOT NULL,
  `ten_ban` varchar(50) NOT NULL,
  `ma_cn` int(11) DEFAULT NULL,
  `trang_thai` enum('Trong','Dang phuc vu','Da dat') DEFAULT 'Trong'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ban`
--

INSERT INTO `ban` (`ma_ban`, `ten_ban`, `ma_cn`, `trang_thai`) VALUES
(1, 'Bàn 01', 1, 'Trong'),
(2, 'Bàn 02', 1, 'Trong'),
(3, 'Bàn 03', 1, 'Trong'),
(4, 'Bàn 04', 1, 'Trong'),
(5, 'Bàn 05', 1, 'Trong'),
(6, 'Bàn 06', 1, 'Trong'),
(7, 'Bàn 07', 1, 'Trong'),
(8, 'Bàn 08', 1, 'Trong'),
(9, 'Bàn 09', 1, 'Trong'),
(10, 'Bàn 10', 1, 'Trong'),
(11, 'Bàn 11', 1, 'Trong'),
(12, 'Bàn 12', 1, 'Trong'),
(13, 'Bàn 13', 1, 'Trong'),
(14, 'Bàn 14', 1, 'Trong'),
(15, 'Bàn 15', 1, 'Trong'),
(16, 'Bàn 01', 2, 'Trong'),
(17, 'Bàn 02', 2, 'Trong'),
(18, 'Bàn 03', 2, 'Trong'),
(19, 'Bàn 04', 2, 'Trong'),
(20, 'Bàn 05', 2, 'Trong'),
(21, 'Bàn 06', 2, 'Trong'),
(22, 'Bàn 07', 2, 'Trong'),
(23, 'Bàn 08', 2, 'Trong'),
(24, 'Bàn 09', 2, 'Trong'),
(25, 'Bàn 10', 2, 'Trong'),
(26, 'Bàn 11', 2, 'Trong'),
(27, 'Bàn 12', 2, 'Trong'),
(28, 'Bàn 13', 2, 'Trong'),
(29, 'Bàn 14', 2, 'Trong'),
(30, 'Bàn 15', 2, 'Trong'),
(31, 'Bàn 01', 3, 'Trong'),
(32, 'Bàn 02', 3, 'Trong'),
(33, 'Bàn 03', 3, 'Trong'),
(34, 'Bàn 04', 3, 'Trong'),
(35, 'Bàn 05', 3, 'Trong'),
(36, 'Bàn 06', 3, 'Trong'),
(37, 'Bàn 07', 3, 'Trong'),
(38, 'Bàn 08', 3, 'Trong'),
(39, 'Bàn 09', 3, 'Trong'),
(40, 'Bàn 10', 3, 'Trong'),
(41, 'Bàn 11', 3, 'Trong'),
(42, 'Bàn 12', 3, 'Trong'),
(43, 'Bàn 13', 3, 'Trong'),
(44, 'Bàn 14', 3, 'Trong'),
(45, 'Bàn 15', 3, 'Trong'),
(46, 'Bàn 01', 4, 'Trong'),
(47, 'Bàn 02', 4, 'Trong'),
(48, 'Bàn 03', 4, 'Trong'),
(49, 'Bàn 04', 4, 'Trong'),
(50, 'Bàn 05', 4, 'Trong'),
(51, 'Bàn 06', 4, 'Trong'),
(52, 'Bàn 07', 4, 'Trong'),
(53, 'Bàn 08', 4, 'Trong'),
(54, 'Bàn 09', 4, 'Trong'),
(55, 'Bàn 10', 4, 'Trong'),
(56, 'Bàn 11', 4, 'Trong'),
(57, 'Bàn 12', 4, 'Trong'),
(58, 'Bàn 13', 4, 'Trong'),
(59, 'Bàn 14', 4, 'Trong'),
(60, 'Bàn 15', 4, 'Trong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_nhanh`
--

CREATE TABLE `chi_nhanh` (
  `ma_cn` int(11) NOT NULL,
  `ten_cn` varchar(100) NOT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `trang_thai` enum('Hoat dong','Tam dung') DEFAULT 'Hoat dong'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_nhanh`
--

INSERT INTO `chi_nhanh` (`ma_cn`, `ten_cn`, `dia_chi`, `sdt`, `trang_thai`) VALUES
(1, 'Bloom Cafe Hoan Kiem', '12 Dinh Tien Hoang, Ha Noi', '0901111111', 'Hoat dong'),
(2, 'Bloom Cafe Cau Giay', '55 Xuan Thuy, Ha Noi', '090222222', 'Hoat dong'),
(3, 'Bloom Cafe Dong Da', '88 Ton Duc Thang, Ha Noi', '0903333333', 'Hoat dong'),
(4, 'Bloom Cafe Hai Ba Trung', '25 Dai Co Viet, Ha Noi', '0904444444', 'Hoat dong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `ma_cthd` int(11) NOT NULL,
  `ma_hd` int(11) NOT NULL,
  `ma_mon` int(11) NOT NULL,
  `ma_size` int(11) DEFAULT NULL,
  `so_luong` int(11) NOT NULL DEFAULT 1,
  `don_gia` decimal(12,2) NOT NULL,
  `thanh_tien` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_hoa_don`
--

INSERT INTO `chi_tiet_hoa_don` (`ma_cthd`, `ma_hd`, `ma_mon`, `ma_size`, `so_luong`, `don_gia`, `thanh_tien`) VALUES
(25, 26, 29, 1, 1, 45000.00, 45000.00),
(26, 28, 5, 1, 1, 50000.00, 50000.00),
(27, 28, 5, 2, 2, 55000.00, 110000.00),
(28, 29, 9, 1, 1, 38000.00, 38000.00),
(29, 29, 29, 2, 1, 50000.00, 50000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_nhap_kho`
--

CREATE TABLE `chi_tiet_nhap_kho` (
  `ma_ctnk` int(11) NOT NULL,
  `ma_nhap` int(11) NOT NULL,
  `ma_nl` int(11) NOT NULL,
  `so_luong` decimal(10,2) NOT NULL,
  `gia_nhap` decimal(12,2) NOT NULL,
  `thanh_tien` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_nhap_kho`
--

INSERT INTO `chi_tiet_nhap_kho` (`ma_ctnk`, `ma_nhap`, `ma_nl`, `so_luong`, `gia_nhap`, `thanh_tien`) VALUES
(16, 11, 1, 20.00, 100000.00, 2000000.00),
(17, 11, 10, 40.00, 4999.99, 199999.60),
(18, 12, 3, 20.00, 20000.00, 400000.00),
(19, 12, 8, 10.00, 50000.00, 500000.00),
(20, 12, 10, 20.00, 15000.00, 300000.00),
(21, 13, 20, 50.00, 10000.00, 500000.00),
(22, 13, 15, 30.00, 40000.00, 1200000.00),
(23, 13, 2, 30.00, 30000.00, 900000.00),
(36, 14, 1, 10.00, 100000.00, 1000000.00),
(37, 14, 3, 10.00, 50000.00, 500000.00),
(38, 15, 2, 20.00, 60000.00, 1200000.00),
(39, 15, 5, 10.00, 100000.00, 1000000.00),
(40, 16, 4, 15.00, 80000.00, 1200000.00),
(41, 16, 7, 10.00, 60000.00, 600000.00),
(42, 17, 1, 20.00, 100000.00, 2000000.00),
(43, 17, 3, 10.00, 50000.00, 500000.00),
(44, 18, 2, 30.00, 60000.00, 1800000.00),
(45, 18, 5, 20.00, 70000.00, 1400000.00),
(46, 19, 4, 15.00, 80000.00, 1200000.00),
(47, 19, 7, 10.00, 60000.00, 600000.00),
(48, 20, 8, 10.00, 90000.00, 900000.00),
(49, 20, 6, 15.00, 80000.00, 1200000.00);

--
-- Bẫy `chi_tiet_nhap_kho`
--
DELIMITER $$
CREATE TRIGGER `trg_nhap_kho_ai` AFTER INSERT ON `chi_tiet_nhap_kho` FOR EACH ROW BEGIN
    DECLARE v_cn INT;

    SELECT ma_cn INTO v_cn
    FROM nhap_kho
    WHERE ma_nhap = NEW.ma_nhap;

    INSERT INTO ton_kho_chi_nhanh (ma_cn, ma_nl, so_luong)
    VALUES (v_cn, NEW.ma_nl, NEW.so_luong)
    ON DUPLICATE KEY UPDATE so_luong = so_luong + NEW.so_luong;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_xuat_kho`
--

CREATE TABLE `chi_tiet_xuat_kho` (
  `ma_ctxk` int(11) NOT NULL,
  `ma_xuat` int(11) DEFAULT NULL,
  `ma_nl` int(11) DEFAULT NULL,
  `so_luong` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_xuat_kho`
--

INSERT INTO `chi_tiet_xuat_kho` (`ma_ctxk`, `ma_xuat`, `ma_nl`, `so_luong`) VALUES
(12, 4, 1, 2.50),
(13, 4, 3, 1.00),
(14, 5, 2, 3.00),
(15, 5, 5, 2.00),
(16, 6, 7, 1.50),
(17, 6, 28, 0.50),
(18, 7, 1, 2.50),
(19, 7, 3, 1.00),
(20, 8, 2, 3.00),
(21, 8, 5, 2.00),
(22, 9, 4, 1.50),
(23, 9, 7, 0.50),
(24, 10, 6, 1.00),
(25, 10, 8, 0.80);

--
-- Bẫy `chi_tiet_xuat_kho`
--
DELIMITER $$
CREATE TRIGGER `trg_xuat_kho_ai` AFTER INSERT ON `chi_tiet_xuat_kho` FOR EACH ROW BEGIN
    DECLARE v_cn INT;

    SELECT ma_cn INTO v_cn
    FROM xuat_kho
    WHERE ma_xuat = NEW.ma_xuat;

    UPDATE ton_kho_chi_nhanh
    SET so_luong = so_luong - NEW.so_luong
    WHERE ma_cn = v_cn AND ma_nl = NEW.ma_nl;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cong_thuc_mon`
--

CREATE TABLE `cong_thuc_mon` (
  `ma_ct` int(11) NOT NULL,
  `ma_mon` int(11) NOT NULL,
  `ma_nl` int(11) NOT NULL,
  `so_luong` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cong_thuc_mon`
--

INSERT INTO `cong_thuc_mon` (`ma_ct`, `ma_mon`, `ma_nl`, `so_luong`) VALUES
(1, 1, 1, 0.05),
(2, 1, 3, 0.01),
(3, 2, 1, 0.05),
(4, 2, 2, 0.03),
(5, 3, 1, 0.04),
(6, 3, 2, 0.05),
(7, 4, 4, 0.05),
(8, 4, 3, 0.02),
(9, 5, 5, 0.05),
(10, 5, 2, 0.04),
(11, 6, 6, 0.05),
(12, 6, 2, 0.03),
(13, 7, 7, 0.03),
(14, 7, 28, 0.02),
(15, 8, 7, 0.05),
(16, 8, 28, 0.02),
(17, 9, 1, 0.06),
(18, 10, 1, 0.04),
(19, 10, 2, 0.05),
(20, 11, 1, 0.04),
(21, 11, 2, 0.04),
(22, 11, 28, 0.01),
(23, 12, 1, 0.07),
(24, 13, 11, 0.05),
(25, 13, 15, 0.03),
(26, 13, 3, 0.01),
(27, 14, 12, 0.04),
(28, 14, 15, 0.03),
(29, 14, 3, 0.01),
(30, 15, 14, 0.04),
(31, 15, 10, 0.03),
(32, 15, 13, 0.03),
(33, 16, 4, 0.05),
(34, 16, 13, 0.03),
(35, 17, 14, 0.04),
(36, 17, 2, 0.04),
(37, 17, 5, 0.03),
(38, 18, 6, 0.04),
(39, 18, 2, 0.04),
(40, 18, 5, 0.03),
(41, 19, 21, 0.05),
(42, 19, 2, 0.04),
(43, 19, 5, 0.03),
(44, 20, 15, 0.04),
(45, 20, 2, 0.04),
(46, 20, 5, 0.03),
(47, 21, 22, 0.05),
(48, 21, 2, 0.04),
(49, 21, 9, 0.03),
(50, 22, 23, 0.05),
(51, 22, 2, 0.04),
(52, 23, 1, 0.03),
(53, 23, 23, 0.03),
(54, 23, 2, 0.04),
(55, 24, 24, 0.04),
(56, 24, 2, 0.04),
(57, 25, 23, 0.04),
(58, 26, 30, 0.04),
(59, 26, 28, 0.02),
(60, 27, 28, 0.03),
(61, 28, 29, 0.03),
(62, 28, 28, 0.02),
(63, 29, 10, 0.10),
(64, 30, 20, 0.10),
(65, 31, 19, 0.10),
(66, 32, 17, 0.08),
(67, 32, 2, 0.03),
(68, 33, 16, 0.08),
(69, 33, 2, 0.03),
(70, 34, 18, 0.08),
(71, 34, 2, 0.03),
(72, 35, 26, 0.05),
(73, 35, 7, 0.02),
(74, 36, 25, 0.06),
(75, 37, 27, 1.00),
(76, 37, 7, 0.02),
(77, 38, 1, 0.05),
(78, 38, 3, 0.01),
(79, 38, 7, 0.03),
(80, 38, 28, 0.02),
(81, 39, 2, 0.04),
(82, 39, 5, 0.03),
(83, 39, 7, 0.03),
(84, 40, 1, 0.10),
(85, 40, 2, 0.08),
(86, 40, 5, 0.05),
(87, 40, 7, 0.05);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

CREATE TABLE `danh_muc` (
  `ma_dm` int(11) NOT NULL,
  `ten_dm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`ma_dm`, `ten_dm`) VALUES
(5, 'Banh Ngot'),
(1, 'Cafe'),
(11, 'Combo'),
(4, 'Da Xay'),
(10, 'Do An Nhe'),
(13, 'Mon Theo Mua'),
(6, 'Nuoc Ep'),
(12, 'Nuoc Ngot'),
(7, 'Sinh To'),
(9, 'Topping'),
(3, 'Tra'),
(2, 'Tra Sua'),
(8, 'Yogurt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `ma_hd` int(11) NOT NULL,
  `ngay_lap` datetime DEFAULT current_timestamp(),
  `tong_tien` decimal(12,2) DEFAULT 0.00,
  `tien_giam` decimal(12,2) DEFAULT 0.00,
  `thanh_toan` decimal(12,2) DEFAULT 0.00,
  `ma_nv` int(11) NOT NULL,
  `ma_kh` int(11) DEFAULT NULL,
  `ma_ban` int(11) DEFAULT NULL,
  `ma_voucher` int(11) DEFAULT NULL,
  `phuong_thuc_tt` enum('Tien mat','Chuyen khoan','The') DEFAULT 'Tien mat',
  `trang_thai` enum('Chua thanh toan','Da thanh toan') DEFAULT 'Chua thanh toan',
  `ma_cn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`ma_hd`, `ngay_lap`, `tong_tien`, `tien_giam`, `thanh_toan`, `ma_nv`, `ma_kh`, `ma_ban`, `ma_voucher`, `phuong_thuc_tt`, `trang_thai`, `ma_cn`) VALUES
(26, '2026-06-11 00:27:42', 45000.00, 0.00, 45000.00, 27, 33, 16, NULL, 'Tien mat', 'Da thanh toan', 2),
(28, '2026-06-11 01:28:37', 160000.00, 20000.00, 140000.00, 26, 35, 28, 4, 'Tien mat', 'Da thanh toan', 2),
(29, '2026-06-11 01:35:00', 88000.00, 0.00, 88000.00, 8, 36, 52, NULL, 'Tien mat', 'Da thanh toan', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_kh` int(11) NOT NULL,
  `ten_kh` varchar(100) NOT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `diem_tich_luy` int(11) DEFAULT 0,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`ma_kh`, `ten_kh`, `sdt`, `email`, `diem_tich_luy`, `ngay_tao`) VALUES
(33, 'Giang', '0111222333', NULL, 4, '2026-06-10 17:27:42'),
(35, 'Thư', '0999778667', NULL, 14, '2026-06-10 18:28:37'),
(36, 'Huyền', '0444578889', NULL, 8, '2026-06-10 18:35:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho_nguyen_lieu`
--

CREATE TABLE `kho_nguyen_lieu` (
  `ma_nl` int(11) NOT NULL,
  `ten_nl` varchar(100) NOT NULL,
  `don_vi` varchar(20) DEFAULT NULL,
  `muc_toi_thieu` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kho_nguyen_lieu`
--

INSERT INTO `kho_nguyen_lieu` (`ma_nl`, `ten_nl`, `don_vi`, `muc_toi_thieu`) VALUES
(1, 'Hat Cafe', 'kg', 10.00),
(2, 'Sua Dac', 'hop', 20.00),
(3, 'Duong', 'kg', 15.00),
(4, 'Tra Dao', 'kg', 5.00),
(5, 'Tran Chau', 'kg', 5.00),
(6, 'Matcha', 'kg', 3.00),
(7, 'Pho Mai', 'kg', 2.00),
(8, 'Bot Cacao', 'kg', 5.00),
(9, 'Kem Tuoi', 'lit', 5.00),
(10, 'Cam Tuoi', 'kg', 10.00),
(11, 'Vai', 'kg', 5.00),
(12, 'Chanh', 'kg', 5.00),
(13, 'Dao Ngam', 'hop', 10.00),
(14, 'Tra O Long', 'kg', 5.00),
(15, 'Hong Tra', 'kg', 5.00),
(16, 'Xoai', 'kg', 8.00),
(17, 'Bo', 'kg', 8.00),
(18, 'Dau Tay', 'kg', 8.00),
(19, 'Tao', 'kg', 8.00),
(20, 'Dua Hau', 'kg', 10.00),
(21, 'Bot Khoai Mon', 'kg', 5.00),
(22, 'Banh Quy Oreo', 'kg', 5.00),
(23, 'Socola', 'kg', 5.00),
(24, 'Caramel', 'lit', 3.00),
(25, 'Xuc Xich', 'kg', 5.00),
(26, 'Kho Ga', 'kg', 5.00),
(27, 'Banh Mi', 'cai', 20.00),
(28, 'Whipping Cream', 'lit', 5.00),
(29, 'Trung Muoi', 'kg', 3.00),
(30, 'Chanh Day', 'kg', 5.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_diem`
--

CREATE TABLE `lich_su_diem` (
  `ma_ls` int(11) NOT NULL,
  `ma_kh` int(11) NOT NULL,
  `diem_thay_doi` int(11) NOT NULL,
  `ly_do` varchar(255) DEFAULT NULL,
  `ngay_tao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lich_su_diem`
--

INSERT INTO `lich_su_diem` (`ma_ls`, `ma_kh`, `diem_thay_doi`, `ly_do`, `ngay_tao`) VALUES
(13, 33, 4, 'Thanh toán hóa đơn #26', '2026-06-11 01:21:12'),
(14, 35, 14, 'Thanh toán hóa đơn #28', '2026-06-11 01:33:09'),
(15, 36, 8, 'Thanh toán hóa đơn #29', '2026-06-11 01:36:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon`
--

CREATE TABLE `mon` (
  `ma_mon` int(11) NOT NULL,
  `ten_mon` varchar(100) NOT NULL,
  `gia` decimal(12,2) NOT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `ma_dm` int(11) DEFAULT NULL,
  `trang_thai` enum('Con ban','Ngung ban') DEFAULT 'Con ban',
  `gia_von` decimal(12,2) DEFAULT 0.00,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mon`
--

INSERT INTO `mon` (`ma_mon`, `ten_mon`, `gia`, `hinh_anh`, `mo_ta`, `ma_dm`, `trang_thai`, `gia_von`, `ngay_tao`) VALUES
(1, 'Ca Phe Den', 30000.00, 'https://order.hannacoffee.com.vn/wp-content/uploads/2025/07/6879861203123.jpg', 'Cafe den da', 1, 'Con ban', 12000.00, '2026-06-04 07:10:48'),
(2, 'Ca Phe Sua', 35000.00, 'https://giacaphe.com/wp-content/uploads/2023/03/ca-phe-sua-da-2-800x625.jpg', 'Cafe sua da', 1, 'Con ban', 15000.00, '2026-06-04 07:10:48'),
(3, 'Bac Xiu', 40000.00, 'https://kingcoffee.com.vn/wp-content/uploads/2026/01/ca-phe-bac-xiu-1024x683.jpg', 'Bac xiu truyen thong', 1, 'Con ban', 18000.00, '2026-06-04 07:10:48'),
(4, 'Tra Dao Cam Sa', 45000.00, 'https://cdn.tgdd.vn/2020/07/CookRecipe/GalleryStep/thanh-pham-273.jpg', 'Tra dao tuoi', 3, 'Con ban', 20000.00, '2026-06-04 07:10:48'),
(5, 'Tra Sua Tran Chau', 50000.00, 'https://bizweb.dktcdn.net/100/519/595/files/1-180559f8-1ce7-43b7-83ce-a37eac803791.jpg?v=1744966178923', 'Tra sua dac biet', 2, 'Con ban', 22000.00, '2026-06-04 07:10:48'),
(6, 'Matcha Da Xay', 55000.00, 'https://cdn.tgdd.vn/2021/05/CookRecipe/GalleryStep/hoan-thanh-322.jpg', 'Matcha nguyen chat', 4, 'Con ban', 25000.00, '2026-06-04 07:10:48'),
(7, 'Tiramisu', 35000.00, 'https://shop.annam-gourmet.com/pub/media/magefan_blog/Tiramisu.jpeg', 'Banh tiramisu', 5, 'Con ban', 15000.00, '2026-06-04 07:10:48'),
(8, 'Cheese Cake', 40000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQT68Hnnj8piUyYSkAdqgqUmI01xYBYT8ESfg&s', 'Banh pho mai', 5, 'Con ban', 18000.00, '2026-06-04 07:10:48'),
(9, 'Americano', 38000.00, 'https://myeverydaytable.com/wp-content/uploads/AmericanoHotandIced-3.jpg', 'Cafe Americano', 1, 'Con ban', 16000.00, '2026-06-06 12:52:31'),
(10, 'Latte', 50000.00, 'https://upload.wikimedia.org/wikipedia/commons/d/d8/Caffe_Latte_at_Pulse_Cafe.jpg', 'Latte nong', 1, 'Con ban', 22000.00, '2026-06-06 12:52:31'),
(11, 'Cappuccino', 52000.00, 'https://www.tasteofhome.com/wp-content/uploads/2017/09/Cappuccino-Punch_EXPS_HPBZ16_19462_D05_24_2b.jpg', 'Cappuccino y', 1, 'Con ban', 23000.00, '2026-06-06 12:52:31'),
(12, 'Espresso', 35000.00, 'https://www.gaggia.com/app/uploads/2021/10/780x520-2.jpg', 'Espresso dam vi', 1, 'Con ban', 14000.00, '2026-06-06 12:52:31'),
(13, 'Tra Vai', 45000.00, 'https://beemedic.vn/wp-content/uploads/2026/04/dd441c2c83a04d719660165e6d0088f1.jpg', 'Tra vai tuoi', 3, 'Con ban', 18000.00, '2026-06-06 12:52:31'),
(14, 'Tra Chanh Mat Ong', 42000.00, 'https://cdn.shopify.com/s/files/1/0617/2497/files/tra-chanh-mat-ong-ottogi_480x480.jpg?v=1611218093', 'Tra chanh mat ong', 3, 'Con ban', 17000.00, '2026-06-06 12:52:31'),
(15, 'Tra O Long Cam Dao', 48000.00, 'https://tianlong.vn/Upload/Products/071224115501.jpg', 'Tra o long dac biet', 3, 'Con ban', 20000.00, '2026-06-06 12:52:31'),
(16, 'Tra Dau Do', 45000.00, 'https://img.mservice.com.vn/common/u/2e02fb5fe4f64fb55bc713540643c6f8eae702d101cea8c59afc49cfc505fc37/b8f5db09-e9fb-4f29-96af-edceb7d7df34j7xetfrb.jpeg', 'Tra dau do tuoi', 3, 'Con ban', 19000.00, '2026-06-06 12:52:31'),
(17, 'Tra Sua O Long', 55000.00, 'https://eggyolk.vn/wp-content/uploads/2024/08/Cach-lam-tra-sua-bang-tra-o-long-tea-plus-don-gian-tai-nha.jpg', 'Tra sua o long', 2, 'Con ban', 24000.00, '2026-06-06 12:52:31'),
(18, 'Tra Sua Matcha', 58000.00, 'https://amivietnam.com/wp-content/uploads/2024/03/tra-sua-matcha.jpg', 'Tra sua matcha', 2, 'Con ban', 25000.00, '2026-06-06 12:52:31'),
(19, 'Tra Sua Khoai Mon', 60000.00, 'https://file.hstatic.net/200000538679/file/tra-sua-khoai-mon__2__3d8987df6b8a44aab040015839787cc7_grande.png', 'Tra sua khoai mon', 2, 'Con ban', 27000.00, '2026-06-06 12:52:31'),
(20, 'Hong Tra Sua', 52000.00, 'https://cdn2.fptshop.com.vn/unsafe/Uploads/images/tin-tuc/164673/Originals/hong-tra-sua-9.jpg', 'Hong tra sua', 2, 'Con ban', 23000.00, '2026-06-06 12:52:31'),
(21, 'Cookie Da Xay', 60000.00, 'https://vietblend.vn/wp-content/uploads/2018/12/cach-lam-cookie-da-xay.jpg', 'Cookie da xay kem tuoi', 4, 'Con ban', 28000.00, '2026-06-06 12:52:31'),
(22, 'Chocolate Da Xay', 62000.00, 'https://nguyencoffee.vn/uploads/source/sp/menu/ice/choco-da-xay.jpg', 'Chocolate da xay', 4, 'Con ban', 29000.00, '2026-06-06 12:52:31'),
(23, 'Mocha Da Xay', 65000.00, 'https://cafedidong.vn/wp-content/uploads/2018/07/CAFEDIDONG-MOCHA-%C4%90%C3%81-XAY-5.jpg', 'Mocha da xay', 4, 'Con ban', 30000.00, '2026-06-06 12:52:31'),
(24, 'Caramel Da Xay', 65000.00, 'https://sieuthimaycaphe.vn/wp-content/uploads/2021/09/cach-lam-ca-phe-da-xay.jpg', 'Caramel da xay', 4, 'Con ban', 30000.00, '2026-06-06 12:52:31'),
(25, 'Brownie', 35000.00, 'https://daylambanh.edu.vn/wp-content/uploads/2015/06/brownie-kem-chocolate-sieu-ngon-600x400.jpg', 'Banh brownie socola', 5, 'Con ban', 15000.00, '2026-06-06 12:52:31'),
(26, 'Mousse Chanh Day', 38000.00, 'https://origato.com.vn/wp-content/uploads/2020/08/IMG_5867-Copy.jpg', 'Mousse chanh day', 5, 'Con ban', 16000.00, '2026-06-06 12:52:31'),
(27, 'Banh Su Kem', 30000.00, 'https://eggyolk.vn/wp-content/uploads/2024/08/Cach-lam-nhan-banh-su-kem-bang-whipping.jpg', 'Banh su kem tuoi', 5, 'Con ban', 12000.00, '2026-06-06 12:52:31'),
(28, 'Banh Bong Lan Trung Muoi', 45000.00, 'https://www.cet.edu.vn/wp-content/uploads/2019/11/banh-bong-lan-trung-muoi.jpg', 'Banh bong lan', 5, 'Con ban', 20000.00, '2026-06-06 12:52:31'),
(29, 'Nuoc Cam Ep', 45000.00, 'https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2023/11/7/uong-nuoc-cam-16993504421751885406385.jpg', 'Cam tuoi nguyen chat', 6, 'Con ban', 18000.00, '2026-06-06 12:52:31'),
(30, 'Nuoc Dua Hau Ep', 45000.00, 'https://bizweb.dktcdn.net/thumb/grande/100/479/802/products/nuoc-ep-dua-hau-giup-no-nhanh-va-giam-luong-hap-thu-thuc-an-vao-co-the.jpg?v=1707231685070', 'Dua hau tuoi', 6, 'Con ban', 17000.00, '2026-06-06 12:52:31'),
(31, 'Nuoc Tao Ep', 50000.00, 'https://tandoorvietnam.com/wp-content/uploads/2020/06/Apple-juice1.jpg', 'Tao ep tuoi', 6, 'Con ban', 22000.00, '2026-06-06 12:52:31'),
(32, 'Sinh To Bo', 55000.00, 'https://beptruong.edu.vn/wp-content/uploads/2021/03/sinh-to-bo-dua.jpg', 'Sinh to bo tuoi', 7, 'Con ban', 24000.00, '2026-06-06 12:52:31'),
(33, 'Sinh To Xoai', 52000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtvXuw3k9b3atqnGceEF20xs4RZDfYVNJ0sw&s', 'Sinh to xoai', 7, 'Con ban', 22000.00, '2026-06-06 12:52:31'),
(34, 'Sinh To Dau', 50000.00, 'https://i0.wp.com/berryland.vn/wp-content/uploads/2024/04/Sinh-to-dau-tay.jpg?fit=640%2C800&ssl=1', 'Sinh to dau tay', 7, 'Con ban', 21000.00, '2026-06-06 12:52:31'),
(35, 'Kho Ga Pho Mai', 40000.00, 'https://giavihanhphuc.com/files/folder_1409/images/kho-ga-pho-mai-xi-muoi-bxQ000.png', 'Kho ga chien gion', 10, 'Con ban', 18000.00, '2026-06-06 12:52:31'),
(36, 'Xuc Xich Nuong', 35000.00, 'https://khosifafood.vn/uploads/images/info/xuc-xich-nuong-da-hcm.png', 'Xuc xich nuong', 10, 'Con ban', 15000.00, '2026-06-06 12:52:31'),
(37, 'Banh Mi Bo', 45000.00, 'https://www.huongnghiepaau.com/wp-content/uploads/2019/01/mon-banh-gion-thom.jpg', 'Banh mi bo nuong', 10, 'Con ban', 20000.00, '2026-06-06 12:52:31'),
(38, 'Combo Cafe + Tiramisu', 60000.00, 'https://lygiavien.com/cdn/shop/articles/banh-tiramisu-trai-nghiem-mon-trang-mieng-y-ngon-kho-quen.webp?v=1724305946', 'Combo tiet kiem', 11, 'Con ban', 27000.00, '2026-06-06 12:52:31'),
(39, 'Combo Tra Sua + Banh', 75000.00, 'https://lh3.googleusercontent.com/wySwKYT9Jq-Dzst-IU9BUtD_Nfh80huGB8a3DFffyII4lkYwhDaEjFqRZ_e2ZM4ap2PsOWJPdROxcnbCswpCSCgwtQovfxazPw=rw-w1902', 'Combo an nhe', 11, 'Con ban', 33000.00, '2026-06-06 12:52:31'),
(40, 'Combo Cap Doi', 120000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZeQZk0O7xZuEuKvVP2wQuIvDU9d1tcB30JQ&s', 'Combo cho 2 nguoi', 11, 'Ngung ban', 55000.00, '2026-06-06 12:52:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `ma_nv` int(11) NOT NULL,
  `ten_nv` varchar(100) NOT NULL,
  `gioi_tinh` enum('Nam','Nu','Khac') DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `luong` decimal(12,2) DEFAULT 0.00,
  `ma_cn` int(11) DEFAULT NULL,
  `trang_thai` enum('Dang lam','Da nghi') DEFAULT 'Dang lam',
  `chuc_vu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_vien`
--

INSERT INTO `nhan_vien` (`ma_nv`, `ten_nv`, `gioi_tinh`, `ngay_sinh`, `sdt`, `email`, `dia_chi`, `luong`, `ma_cn`, `trang_thai`, `chuc_vu`) VALUES
(1, 'Nguyen Van A', 'Nam', '2004-10-11', '0234567281', 'rduhjamex@gmail.com', 'Cầu Giấy', 7000000.00, 2, 'Dang lam', 'Nhan vien'),
(2, 'Tran Thi B', 'Nu', '2000-01-30', '0123456767', 'rfhdbjcb@gmai.com', 'Hồ Tùng Mậu', 10000000.00, 1, 'Dang lam', 'Quan ly'),
(3, 'Le Thanh C', 'Nam', '2005-04-12', '0765876345', 'gfsdhajrmiafdu@gmail.com', 'Cầu Giấy', 7200000.00, 1, 'Dang lam', 'Nhan vien'),
(4, 'Pham Thu Ha', 'Nu', '2001-11-02', '0911111114', 'ha@bloomcafe.vn', 'Ha Noi', 7500000.00, 2, 'Dang lam', 'Nhan vien phuc vu'),
(5, 'Do Quang Huy', 'Nam', '1997-07-18', '0911111115', 'huy@bloomcafe.vn', 'Ha Noi', 13000000.00, 3, 'Dang lam', 'Quan ly'),
(6, 'Nguyen Thi Lan', 'Nu', '2002-01-25', '0911111116', 'lan@bloomcafe.vn', 'Ha Noi', 8000000.00, 3, 'Dang lam', 'Pha che'),
(7, 'Vu Tuan Kiet', 'Nam', '1998-12-10', '0911111117', 'kiet@bloomcafe.vn', 'Ha Noi', 9000000.00, 4, 'Dang lam', 'Thu ngan'),
(8, 'Dang Mai Linh', 'Nu', '2001-06-05', '0911111118', 'linh@bloomcafe.vn', 'Ha Noi', 7800000.00, 4, 'Dang lam', 'Nhan vien phuc vu'),
(21, 'Hoang Minh Duc', 'Nam', '1999-03-15', '0912000001', 'duc.cn1@bloomcafe.vn', 'Ha Noi', 8500000.00, 1, 'Dang lam', 'Thu ngan'),
(22, 'Nguyen Thu Trang', 'Nu', '2002-08-21', '0912000002', 'trang.cn1@bloomcafe.vn', 'Ha Noi', 7800000.00, 1, 'Dang lam', 'Pha che'),
(23, 'Pham Gia Bao', 'Nam', '2003-05-10', '0912000003', 'bao.cn1@bloomcafe.vn', 'Ha Noi', 7200000.00, 1, 'Dang lam', 'Nhan vien phuc vu'),
(24, 'Tran Mai Anh', 'Nu', '2004-01-18', '0912000004', 'maianh.cn1@bloomcafe.vn', 'Ha Noi', 7200000.00, 1, 'Dang lam', 'Nhan vien phuc vu'),
(25, 'Le Quoc Viet', 'Nam', '1998-11-02', '0912000005', 'viet.cn2@bloomcafe.vn', 'Ha Noi', 12500000.00, 2, 'Dang lam', 'Quan ly'),
(26, 'Dang Thu Huong', 'Nu', '2001-06-12', '0912000006', 'huong.cn2@bloomcafe.vn', 'Ha Noi', 8000000.00, 2, 'Dang lam', 'Pha che'),
(27, 'Bui Anh Tuan', 'Nam', '2003-04-28', '0912000007', 'tuan.cn2@bloomcafe.vn', 'Ha Noi', 7200000.00, 2, 'Dang lam', 'Nhan vien phuc vu'),
(28, 'Do Ngoc Linh', 'Nu', '2004-09-07', '0912000008', 'linh.cn2@bloomcafe.vn', 'Ha Noi', 7200000.00, 2, 'Dang lam', 'Nhan vien phuc vu'),
(29, 'Nguyen Van Son', 'Nam', '2000-02-14', '0912000009', 'son.cn3@bloomcafe.vn', 'Ha Noi', 9000000.00, 3, 'Dang lam', 'Thu ngan'),
(30, 'Tran Thi Yen', 'Nu', '2002-12-30', '0912000010', 'yen.cn3@bloomcafe.vn', 'Ha Noi', 7800000.00, 3, 'Dang lam', 'Pha che'),
(31, 'Phan Duc Anh', 'Nam', '2003-07-11', '0912000011', 'ducanh.cn3@bloomcafe.vn', 'Ha Noi', 7200000.00, 3, 'Dang lam', 'Nhan vien phuc vu'),
(32, 'Vu Ngoc Ha', 'Nu', '2004-05-20', '0912000012', 'ha.cn3@bloomcafe.vn', 'Ha Noi', 7200000.00, 3, 'Dang lam', 'Nhan vien phuc vu'),
(33, 'Nguyen Thanh Dat', 'Nam', '1999-10-09', '0912000013', 'dat.cn4@bloomcafe.vn', 'Ha Noi', 8000000.00, 4, 'Dang lam', 'Pha che'),
(34, 'Le Bao Chau', 'Nu', '2001-03-25', '0912000014', 'chau.cn4@bloomcafe.vn', 'Ha Noi', 7200000.00, 4, 'Dang lam', 'Nhan vien phuc vu'),
(35, 'Tran Quang Hieu', 'Nam', '2003-01-17', '0912000015', 'hieu.cn4@bloomcafe.vn', 'Ha Noi', 7200000.00, 4, 'Dang lam', 'Nhan vien phuc vu'),
(36, 'Do Thi Ngoc', 'Nu', '2002-11-05', '0912000016', 'ngoc.cn4@bloomcafe.vn', 'Ha Noi', 7200000.00, 4, 'Dang lam', 'Nhan vien phuc vu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhap_kho`
--

CREATE TABLE `nhap_kho` (
  `ma_nhap` int(11) NOT NULL,
  `ngay_nhap` datetime DEFAULT current_timestamp(),
  `tong_tien` decimal(12,2) DEFAULT 0.00,
  `ghi_chu` text DEFAULT NULL,
  `ma_cn` int(11) NOT NULL,
  `trang_thai` enum('Cho duyet','Da nhap') DEFAULT 'Da nhap'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhap_kho`
--

INSERT INTO `nhap_kho` (`ma_nhap`, `ngay_nhap`, `tong_tien`, `ghi_chu`, `ma_cn`, `trang_thai`) VALUES
(11, '2026-06-08 15:47:08', 2199999.60, NULL, 4, 'Da nhap'),
(12, '2026-06-08 22:56:29', 1200000.00, NULL, 2, 'Da nhap'),
(13, '2026-06-08 22:57:58', 2600000.00, NULL, 1, 'Da nhap'),
(14, '2026-06-08 09:00:00', 1500000.00, 'Nhap nguyen lieu ca phe', 1, 'Da nhap'),
(15, '2026-06-08 10:30:00', 2200000.00, 'Nhap sua + duong', 2, 'Da nhap'),
(16, '2026-06-08 14:00:00', 1800000.00, 'Nhap tra + topping', 3, 'Da nhap'),
(17, '2026-06-08 08:00:00', 2500000.00, 'Nhap cafe + duong', 1, 'Da nhap'),
(18, '2026-06-08 09:30:00', 3200000.00, 'Nhap sua + topping', 2, 'Da nhap'),
(19, '2026-06-08 11:00:00', 1800000.00, 'Nhap tra + hoa qua', 3, 'Da nhap'),
(20, '2026-06-08 13:00:00', 2200000.00, 'Nhap nguyen lieu banh', 4, 'Da nhap');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhat_ky_he_thong`
--

CREATE TABLE `nhat_ky_he_thong` (
  `ma_log` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hanh_dong` varchar(255) NOT NULL,
  `bang_tac_dong` varchar(100) DEFAULT NULL,
  `ma_ban_ghi` int(11) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `thoi_gian` datetime DEFAULT current_timestamp(),
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhat_ky_he_thong`
--

INSERT INTO `nhat_ky_he_thong` (`ma_log`, `user_id`, `hanh_dong`, `bang_tac_dong`, `ma_ban_ghi`, `mo_ta`, `thoi_gian`, `ip_address`) VALUES
(1, 1, 'Them', 'mon', 15, 'Them mon Bac Xiu', '2026-06-04 13:45:18', NULL),
(2, 1, 'Them mon', 'chi_tiet_hoa_don', 6, 'Thêm món vào hóa đơn', '2026-06-08 12:47:28', '::1'),
(3, 1, 'Them mon', 'chi_tiet_hoa_don', 6, 'Thêm món vào hóa đơn', '2026-06-08 12:47:54', '::1'),
(4, 1, 'Them mon', 'chi_tiet_hoa_don', 6, 'Thêm món vào hóa đơn', '2026-06-08 12:48:04', '::1'),
(5, 1, 'Them mon', 'chi_tiet_hoa_don', 6, 'Thêm món vào hóa đơn', '2026-06-08 12:48:46', '::1'),
(6, 1, 'Them mon', 'chi_tiet_hoa_don', 6, 'Thêm món vào hóa đơn', '2026-06-08 12:48:55', '::1'),
(7, 1, 'Them mon', 'chi_tiet_hoa_don', 6, 'Thêm món vào hóa đơn', '2026-06-08 12:49:01', '::1'),
(8, 1, 'Nhap kho', 'nhap_kho', 7, 'Tạo phiếu nhập', '2026-06-08 13:54:03', NULL),
(9, 1, 'Nhap kho', 'nhap_kho', 8, 'Tạo phiếu nhập', '2026-06-08 13:54:43', NULL),
(10, 1, 'Nhap kho', 'nhap_kho', 10, 'Tạo phiếu nhập', '2026-06-08 14:12:16', NULL),
(11, 1, 'Xuat kho', 'xuat_kho', 2, 'Tạo phiếu xuất kho', '2026-06-08 14:31:53', NULL),
(12, 1, 'Nhap kho', 'nhap_kho', 11, 'Tạo phiếu nhập', '2026-06-08 15:47:08', NULL),
(13, 1, 'Them mon', 'chi_tiet_hoa_don', 7, 'Thêm món vào hóa đơn', '2026-06-08 15:57:40', '::1'),
(14, 1, 'Them mon', 'chi_tiet_hoa_don', 7, 'Thêm món vào hóa đơn', '2026-06-08 15:57:48', '::1'),
(15, 1, 'Them mon', 'chi_tiet_hoa_don', 7, 'Thêm món vào hóa đơn', '2026-06-08 15:57:52', '::1'),
(16, 1, 'Thanh toan', 'hoa_don', 7, 'Thanh toán hóa đơn', '2026-06-08 16:06:13', '::1'),
(17, 1, 'Them mon', 'chi_tiet_hoa_don', 8, 'Thêm món vào hóa đơn', '2026-06-08 17:00:35', '::1'),
(18, 1, 'Them mon', 'chi_tiet_hoa_don', 8, 'Thêm món vào hóa đơn', '2026-06-08 17:00:47', '::1'),
(19, 1, 'Thanh toan', 'hoa_don', 8, 'Thanh toán hóa đơn', '2026-06-08 17:01:52', '::1'),
(20, 1, 'Nhap kho', 'nhap_kho', 12, 'Tạo phiếu nhập', '2026-06-08 22:56:29', NULL),
(21, 1, 'Nhap kho', 'nhap_kho', 13, 'Tạo phiếu nhập', '2026-06-08 22:57:58', NULL),
(22, 1, 'Xuat kho', 'xuat_kho', 3, 'Tạo phiếu xuất kho', '2026-06-08 22:59:47', NULL),
(23, 1, 'Them mon', 'chi_tiet_hoa_don', 15, 'Thêm món vào hóa đơn', '2026-06-09 00:04:53', '::1'),
(24, 1, 'Thanh toan', 'hoa_don', 15, 'Thanh toán hóa đơn', '2026-06-09 00:06:35', '::1'),
(25, 1, 'Them mon', 'chi_tiet_hoa_don', 16, 'Thêm món vào hóa đơn', '2026-06-09 00:11:56', '::1'),
(26, 1, 'Them mon', 'chi_tiet_hoa_don', 16, 'Thêm món vào hóa đơn', '2026-06-09 00:20:07', '::1'),
(27, 1, 'Them mon', 'chi_tiet_hoa_don', 16, 'Thêm món vào hóa đơn', '2026-06-09 00:20:11', '::1'),
(28, 1, 'Them mon', 'chi_tiet_hoa_don', 19, 'Thêm món vào hóa đơn', '2026-06-09 00:49:48', '::1'),
(29, 1, 'Them mon', 'chi_tiet_hoa_don', 19, 'Thêm món vào hóa đơn', '2026-06-09 00:50:19', '::1'),
(30, 1, 'Thanh toan', 'hoa_don', 19, 'Thanh toán hóa đơn', '2026-06-09 00:50:25', '::1'),
(31, 1, 'Them mon', 'chi_tiet_hoa_don', 20, 'Thêm món vào hóa đơn', '2026-06-09 00:51:50', '::1'),
(32, 1, 'Thanh toan', 'hoa_don', 20, 'Thanh toán hóa đơn', '2026-06-09 00:52:15', '::1'),
(33, 1, 'Them mon', 'chi_tiet_hoa_don', 21, 'Thêm món vào hóa đơn', '2026-06-09 01:09:41', '::1'),
(34, 1, 'Thanh toan', 'hoa_don', 21, 'Thanh toán hóa đơn', '2026-06-09 01:13:17', '::1'),
(35, 1, 'Them mon', 'chi_tiet_hoa_don', 22, 'Thêm món vào hóa đơn', '2026-06-09 01:15:31', '::1'),
(36, 1, 'Them mon', 'chi_tiet_hoa_don', 23, 'Thêm món vào hóa đơn', '2026-06-09 22:47:23', '::1'),
(37, 1, 'Them mon', 'chi_tiet_hoa_don', 23, 'Thêm món vào hóa đơn', '2026-06-09 22:47:28', '::1'),
(38, 1, 'Thanh toan', 'hoa_don', 23, 'Thanh toán hóa đơn', '2026-06-09 22:49:24', '::1'),
(39, 1, 'Them mon', 'chi_tiet_hoa_don', 24, 'Thêm món vào hóa đơn', '2026-06-09 22:53:35', '::1'),
(40, 1, 'Thanh toan', 'hoa_don', 24, 'Thanh toán hóa đơn', '2026-06-09 22:53:51', '::1'),
(41, 1, 'Them mon', 'chi_tiet_hoa_don', 25, 'Thêm món vào hóa đơn', '2026-06-09 22:54:59', '::1'),
(42, 1, 'Them mon', 'chi_tiet_hoa_don', 26, 'Thêm món vào hóa đơn', '2026-06-11 00:28:52', '::1'),
(43, 1, 'Thanh toan', 'hoa_don', 26, 'Thanh toán hóa đơn', '2026-06-11 01:21:12', '::1'),
(44, 1, 'Them mon', 'chi_tiet_hoa_don', 28, 'Thêm món vào hóa đơn', '2026-06-11 01:29:32', '::1'),
(45, 1, 'Them mon', 'chi_tiet_hoa_don', 28, 'Thêm món vào hóa đơn', '2026-06-11 01:30:02', '::1'),
(46, 1, 'Thanh toan', 'hoa_don', 28, 'Thanh toán hóa đơn', '2026-06-11 01:33:09', '::1'),
(47, 1, 'Them mon', 'chi_tiet_hoa_don', 29, 'Thêm món vào hóa đơn', '2026-06-11 01:35:05', '::1'),
(48, 1, 'Them mon', 'chi_tiet_hoa_don', 29, 'Thêm món vào hóa đơn', '2026-06-11 01:35:12', '::1'),
(49, 1, 'Thanh toan', 'hoa_don', 29, 'Thanh toán hóa đơn', '2026-06-11 01:36:12', '::1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size_mon`
--

CREATE TABLE `size_mon` (
  `ma_size` int(11) NOT NULL,
  `ten_size` varchar(20) NOT NULL,
  `gia_them` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `size_mon`
--

INSERT INTO `size_mon` (`ma_size`, `ten_size`, `gia_them`) VALUES
(1, 'M', 0.00),
(2, 'L', 5000.00),
(3, 'XL', 10000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ton_kho_chi_nhanh`
--

CREATE TABLE `ton_kho_chi_nhanh` (
  `ma_ton` int(11) NOT NULL,
  `ma_cn` int(11) NOT NULL,
  `ma_nl` int(11) NOT NULL,
  `so_luong` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ton_kho_chi_nhanh`
--

INSERT INTO `ton_kho_chi_nhanh` (`ma_ton`, `ma_cn`, `ma_nl`, `so_luong`) VALUES
(25, 1, 1, 25.00),
(26, 1, 2, 30.00),
(27, 1, 3, 18.00),
(28, 1, 15, 30.00),
(29, 1, 20, 50.00),
(30, 2, 2, 43.76),
(31, 2, 3, 20.00),
(32, 2, 5, 25.70),
(33, 2, 8, 10.00),
(34, 2, 10, 19.80),
(35, 3, 4, 28.50),
(36, 3, 7, 18.00),
(37, 4, 1, 19.88),
(38, 4, 6, 14.00),
(39, 4, 8, 9.20),
(40, 4, 10, 39.80);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('admin','manager','staff','customer') NOT NULL,
  `ma_nv` int(11) DEFAULT NULL,
  `ma_cn` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `ma_nv`, `ma_cn`, `created_at`) VALUES
(1, 'admin', '$2y$10$WX900S0ZWtmZix845aQ/U.Wbhtq.sbkw5dW0TnC4Lp5n/26L/dkk2', 'admin@gmail.com', 'admin', NULL, NULL, '2026-06-01 06:43:40'),
(2, 'manager1', '$2y$10$IHAJ3J3NkjKCvsQLJBwDBuxH6cvNfVyRBEAyH9rsPPDkVYvD1DbNy', 'manager@gmail.com', 'manager', 1, 1, '2026-06-04 07:10:48'),
(3, 'staff1', '$2y$10$6l0tJhqFYp4FLZjgQG2Y6eN05XR1GNoH6PEhRA8KZZ4gAXHY9W9je', 'staff@gmail.com', 'staff', 2, 1, '2026-06-04 07:10:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `ma_voucher` int(11) NOT NULL,
  `ten_voucher` varchar(100) DEFAULT NULL,
  `gia_tri` decimal(12,2) DEFAULT NULL,
  `ngay_bat_dau` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `so_luong` int(11) DEFAULT 0,
  `trang_thai` enum('Hoat dong','Het han') DEFAULT 'Hoat dong',
  `loai_giam` enum('Tien','Phan tram') DEFAULT 'Tien',
  `don_hang_toi_thieu` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`ma_voucher`, `ten_voucher`, `gia_tri`, `ngay_bat_dau`, `ngay_ket_thuc`, `so_luong`, `trang_thai`, `loai_giam`, `don_hang_toi_thieu`) VALUES
(4, 'GIAM20K', 20000.00, '2026-06-01', '2026-06-30', 99, 'Hoat dong', 'Tien', 100000.00),
(5, 'GIAM50K', 50000.00, '2026-06-01', '2026-07-15', 50, 'Hoat dong', 'Tien', 250000.00),
(6, 'SUMMER10', 10.00, '2026-06-01', '2026-08-31', 200, 'Hoat dong', 'Phan tram', 150000.00),
(7, 'SUMMER20', 20.00, '2026-06-01', '2026-08-31', 100, 'Hoat dong', 'Phan tram', 300000.00),
(8, 'KHAITRUONG', 30000.00, '2026-01-01', '2026-03-31', 100, 'Het han', 'Tien', 100000.00),
(9, 'VIP15', 15.00, '2026-06-01', '2026-12-31', 30, 'Hoat dong', 'Phan tram', 500000.00),
(10, 'FREEDRINK', 10000.00, '2026-06-01', '2026-12-31', 499, 'Hoat dong', 'Tien', 50000.00),
(11, 'COFFEE25', 25.00, '2026-06-10', '2026-07-10', 80, 'Hoat dong', 'Phan tram', 200000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xuat_kho`
--

CREATE TABLE `xuat_kho` (
  `ma_xuat` int(11) NOT NULL,
  `ngay_xuat` datetime DEFAULT current_timestamp(),
  `ghi_chu` text DEFAULT NULL,
  `ma_cn` int(11) NOT NULL,
  `ma_nv` int(11) NOT NULL,
  `trang_thai` enum('Cho duyet','Da xuat') DEFAULT 'Da xuat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `xuat_kho`
--

INSERT INTO `xuat_kho` (`ma_xuat`, `ngay_xuat`, `ghi_chu`, `ma_cn`, `ma_nv`, `trang_thai`) VALUES
(4, '2026-06-08 12:00:00', 'Xuat nguyen lieu ban hang sang ca sang', 1, 1, 'Da xuat'),
(5, '2026-06-08 15:00:00', 'Xuat pha che ca phe', 2, 3, 'Da xuat'),
(6, '2026-06-08 18:00:00', 'Xuat banh ngot va topping', 3, 2, 'Da xuat'),
(7, '2026-06-08 10:00:00', 'Xuat nguyen lieu pha che ca phe', 1, 1, 'Da xuat'),
(8, '2026-06-08 12:00:00', 'Xuat sua + duong cho ca lam viec', 2, 3, 'Da xuat'),
(9, '2026-06-08 15:00:00', 'Xuat tra va topping', 3, 2, 'Da xuat'),
(10, '2026-06-08 17:00:00', 'Xuat nguyen lieu banh va combo', 4, 5, 'Da xuat');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`ma_ban`),
  ADD KEY `ma_cn` (`ma_cn`);

--
-- Chỉ mục cho bảng `chi_nhanh`
--
ALTER TABLE `chi_nhanh`
  ADD PRIMARY KEY (`ma_cn`);

--
-- Chỉ mục cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`ma_cthd`),
  ADD UNIQUE KEY `uq_hd_mon_size` (`ma_hd`,`ma_mon`,`ma_size`),
  ADD KEY `ma_mon` (`ma_mon`),
  ADD KEY `fk_cthd_size` (`ma_size`);

--
-- Chỉ mục cho bảng `chi_tiet_nhap_kho`
--
ALTER TABLE `chi_tiet_nhap_kho`
  ADD PRIMARY KEY (`ma_ctnk`),
  ADD KEY `ma_nhap` (`ma_nhap`),
  ADD KEY `idx_nl_nhap` (`ma_nl`);

--
-- Chỉ mục cho bảng `chi_tiet_xuat_kho`
--
ALTER TABLE `chi_tiet_xuat_kho`
  ADD PRIMARY KEY (`ma_ctxk`),
  ADD KEY `ma_xuat` (`ma_xuat`),
  ADD KEY `ma_nl` (`ma_nl`);

--
-- Chỉ mục cho bảng `cong_thuc_mon`
--
ALTER TABLE `cong_thuc_mon`
  ADD PRIMARY KEY (`ma_ct`),
  ADD UNIQUE KEY `uq_mon_nguyenlieu` (`ma_mon`,`ma_nl`),
  ADD KEY `ma_nl` (`ma_nl`);

--
-- Chỉ mục cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`ma_dm`),
  ADD UNIQUE KEY `ten_dm` (`ten_dm`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`ma_hd`),
  ADD KEY `ma_nv` (`ma_nv`),
  ADD KEY `ma_kh` (`ma_kh`),
  ADD KEY `ma_ban` (`ma_ban`),
  ADD KEY `ma_voucher` (`ma_voucher`),
  ADD KEY `fk_hoadon_cn` (`ma_cn`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_kh`),
  ADD UNIQUE KEY `sdt` (`sdt`);

--
-- Chỉ mục cho bảng `kho_nguyen_lieu`
--
ALTER TABLE `kho_nguyen_lieu`
  ADD PRIMARY KEY (`ma_nl`);

--
-- Chỉ mục cho bảng `lich_su_diem`
--
ALTER TABLE `lich_su_diem`
  ADD PRIMARY KEY (`ma_ls`),
  ADD KEY `fk_lsdiem_kh` (`ma_kh`);

--
-- Chỉ mục cho bảng `mon`
--
ALTER TABLE `mon`
  ADD PRIMARY KEY (`ma_mon`),
  ADD KEY `ma_dm` (`ma_dm`),
  ADD KEY `idx_ten_mon` (`ten_mon`);

--
-- Chỉ mục cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`ma_nv`),
  ADD KEY `ma_cn` (`ma_cn`);

--
-- Chỉ mục cho bảng `nhap_kho`
--
ALTER TABLE `nhap_kho`
  ADD PRIMARY KEY (`ma_nhap`),
  ADD KEY `fk_nhapkho_cn` (`ma_cn`);

--
-- Chỉ mục cho bảng `nhat_ky_he_thong`
--
ALTER TABLE `nhat_ky_he_thong`
  ADD PRIMARY KEY (`ma_log`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `size_mon`
--
ALTER TABLE `size_mon`
  ADD PRIMARY KEY (`ma_size`);

--
-- Chỉ mục cho bảng `ton_kho_chi_nhanh`
--
ALTER TABLE `ton_kho_chi_nhanh`
  ADD PRIMARY KEY (`ma_ton`),
  ADD UNIQUE KEY `uq_cn_nl` (`ma_cn`,`ma_nl`),
  ADD UNIQUE KEY `uk_cn_nl` (`ma_cn`,`ma_nl`),
  ADD KEY `fk_tonkho_nl` (`ma_nl`),
  ADD KEY `idx_cn_nl` (`ma_cn`,`ma_nl`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `ma_nv` (`ma_nv`),
  ADD KEY `fk_users_chinhanh` (`ma_cn`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`ma_voucher`);

--
-- Chỉ mục cho bảng `xuat_kho`
--
ALTER TABLE `xuat_kho`
  ADD PRIMARY KEY (`ma_xuat`),
  ADD KEY `fk_xuatkho_cn` (`ma_cn`),
  ADD KEY `fk_xuatkho_nv` (`ma_nv`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ban`
--
ALTER TABLE `ban`
  MODIFY `ma_ban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `chi_nhanh`
--
ALTER TABLE `chi_nhanh`
  MODIFY `ma_cn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  MODIFY `ma_cthd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_nhap_kho`
--
ALTER TABLE `chi_tiet_nhap_kho`
  MODIFY `ma_ctnk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_xuat_kho`
--
ALTER TABLE `chi_tiet_xuat_kho`
  MODIFY `ma_ctxk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `cong_thuc_mon`
--
ALTER TABLE `cong_thuc_mon`
  MODIFY `ma_ct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `ma_dm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `ma_hd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `ma_kh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `kho_nguyen_lieu`
--
ALTER TABLE `kho_nguyen_lieu`
  MODIFY `ma_nl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `lich_su_diem`
--
ALTER TABLE `lich_su_diem`
  MODIFY `ma_ls` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `mon`
--
ALTER TABLE `mon`
  MODIFY `ma_mon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  MODIFY `ma_nv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `nhap_kho`
--
ALTER TABLE `nhap_kho`
  MODIFY `ma_nhap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `nhat_ky_he_thong`
--
ALTER TABLE `nhat_ky_he_thong`
  MODIFY `ma_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `size_mon`
--
ALTER TABLE `size_mon`
  MODIFY `ma_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `ton_kho_chi_nhanh`
--
ALTER TABLE `ton_kho_chi_nhanh`
  MODIFY `ma_ton` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `voucher`
--
ALTER TABLE `voucher`
  MODIFY `ma_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `xuat_kho`
--
ALTER TABLE `xuat_kho`
  MODIFY `ma_xuat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ban`
--
ALTER TABLE `ban`
  ADD CONSTRAINT `ban_ibfk_1` FOREIGN KEY (`ma_cn`) REFERENCES `chi_nhanh` (`ma_cn`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD CONSTRAINT `chi_tiet_hoa_don_ibfk_1` FOREIGN KEY (`ma_hd`) REFERENCES `hoa_don` (`ma_hd`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_hoa_don_ibfk_2` FOREIGN KEY (`ma_mon`) REFERENCES `mon` (`ma_mon`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cthd_size` FOREIGN KEY (`ma_size`) REFERENCES `size_mon` (`ma_size`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `chi_tiet_nhap_kho`
--
ALTER TABLE `chi_tiet_nhap_kho`
  ADD CONSTRAINT `chi_tiet_nhap_kho_ibfk_1` FOREIGN KEY (`ma_nhap`) REFERENCES `nhap_kho` (`ma_nhap`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_nhap_kho_ibfk_2` FOREIGN KEY (`ma_nl`) REFERENCES `kho_nguyen_lieu` (`ma_nl`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chi_tiet_xuat_kho`
--
ALTER TABLE `chi_tiet_xuat_kho`
  ADD CONSTRAINT `chi_tiet_xuat_kho_ibfk_1` FOREIGN KEY (`ma_xuat`) REFERENCES `xuat_kho` (`ma_xuat`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_xuat_kho_ibfk_2` FOREIGN KEY (`ma_nl`) REFERENCES `kho_nguyen_lieu` (`ma_nl`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cong_thuc_mon`
--
ALTER TABLE `cong_thuc_mon`
  ADD CONSTRAINT `cong_thuc_mon_ibfk_1` FOREIGN KEY (`ma_mon`) REFERENCES `mon` (`ma_mon`) ON DELETE CASCADE,
  ADD CONSTRAINT `cong_thuc_mon_ibfk_2` FOREIGN KEY (`ma_nl`) REFERENCES `kho_nguyen_lieu` (`ma_nl`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `fk_hoadon_cn` FOREIGN KEY (`ma_cn`) REFERENCES `chi_nhanh` (`ma_cn`),
  ADD CONSTRAINT `hoa_don_ibfk_1` FOREIGN KEY (`ma_nv`) REFERENCES `nhan_vien` (`ma_nv`),
  ADD CONSTRAINT `hoa_don_ibfk_2` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`) ON DELETE SET NULL,
  ADD CONSTRAINT `hoa_don_ibfk_3` FOREIGN KEY (`ma_ban`) REFERENCES `ban` (`ma_ban`) ON DELETE SET NULL,
  ADD CONSTRAINT `hoa_don_ibfk_4` FOREIGN KEY (`ma_voucher`) REFERENCES `voucher` (`ma_voucher`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `lich_su_diem`
--
ALTER TABLE `lich_su_diem`
  ADD CONSTRAINT `fk_lsdiem_kh` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `mon`
--
ALTER TABLE `mon`
  ADD CONSTRAINT `mon_ibfk_1` FOREIGN KEY (`ma_dm`) REFERENCES `danh_muc` (`ma_dm`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `nhan_vien_ibfk_1` FOREIGN KEY (`ma_cn`) REFERENCES `chi_nhanh` (`ma_cn`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `nhap_kho`
--
ALTER TABLE `nhap_kho`
  ADD CONSTRAINT `fk_nhapkho_cn` FOREIGN KEY (`ma_cn`) REFERENCES `chi_nhanh` (`ma_cn`);

--
-- Các ràng buộc cho bảng `nhat_ky_he_thong`
--
ALTER TABLE `nhat_ky_he_thong`
  ADD CONSTRAINT `nhat_ky_he_thong_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `ton_kho_chi_nhanh`
--
ALTER TABLE `ton_kho_chi_nhanh`
  ADD CONSTRAINT `fk_tonkho_cn` FOREIGN KEY (`ma_cn`) REFERENCES `chi_nhanh` (`ma_cn`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tonkho_nl` FOREIGN KEY (`ma_nl`) REFERENCES `kho_nguyen_lieu` (`ma_nl`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_chinhanh` FOREIGN KEY (`ma_cn`) REFERENCES `chi_nhanh` (`ma_cn`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ma_nv`) REFERENCES `nhan_vien` (`ma_nv`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `xuat_kho`
--
ALTER TABLE `xuat_kho`
  ADD CONSTRAINT `fk_xuatkho_cn` FOREIGN KEY (`ma_cn`) REFERENCES `chi_nhanh` (`ma_cn`),
  ADD CONSTRAINT `fk_xuatkho_nv` FOREIGN KEY (`ma_nv`) REFERENCES `nhan_vien` (`ma_nv`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
