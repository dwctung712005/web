<?php
$host = "localhost";
$username = "root";
$password = ""; // Điền mật khẩu MySQL của bạn vào đây nếu có
$dbname = "web"; // Đã đổi tên chuẩn thành database web của bạn

// Kết nối bằng mysqli
$conn = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối database thất bại: " . $conn->connect_error);
}

// Đặt font chữ hiển thị tiếng Việt không bị lỗi font
$conn->set_charset("utf8mb4");
?>