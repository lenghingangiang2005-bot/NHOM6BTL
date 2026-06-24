<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "cafe_management";
$port = 3307;

// Kết nối database
$conn = mysqli_connect(
    $host,
    $user,
    $pass,
    $db,
    $port
);

// Kiểm tra kết nối
if(!$conn)
{
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Thiết lập UTF8
mysqli_set_charset($conn, "utf8");
?>