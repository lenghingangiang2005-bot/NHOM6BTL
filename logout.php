<?php

session_start();

// Xóa toàn bộ session
$_SESSION = array();

session_destroy();

// Quay lại trang đăng nhập
header("Location: login.php");
exit();

?>