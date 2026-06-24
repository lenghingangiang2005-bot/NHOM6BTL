<?php

include "config.php";

$ma_cn = isset($_GET['ma_cn'])
    ? (int)$_GET['ma_cn']
    : 0;

$nhanvien = [];
$ban = [];

/* NHÂN VIÊN THEO CHI NHÁNH */

$sqlNV = mysqli_query(
    $conn,
    "SELECT ma_nv, ten_nv
     FROM nhan_vien
     WHERE ma_cn=$ma_cn
     ORDER BY ten_nv"
);

while($row = mysqli_fetch_assoc($sqlNV))
{
    $nhanvien[] = $row;
}


/* BÀN TRỐNG THEO CHI NHÁNH */

$sqlBan = mysqli_query(
    $conn,
    "SELECT ma_ban, ten_ban
     FROM ban
     WHERE ma_cn=$ma_cn
     AND trang_thai='Trong'
     ORDER BY ten_ban"
);

while($row = mysqli_fetch_assoc($sqlBan))
{
    $ban[] = $row;
}

echo json_encode([
    "nhanvien" => $nhanvien,
    "ban" => $ban
]);