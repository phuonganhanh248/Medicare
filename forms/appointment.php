<?php
// Kiểm tra xem có phải là POST request không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $date = htmlspecialchars($_POST['date']);
    $department = htmlspecialchars($_POST['department']);
    $doctor = htmlspecialchars($_POST['doctor']);
    $message = htmlspecialchars($_POST['message']);

    // Hiển thị popup với thông tin
    echo "<script>alert('Thông tin đặt lịch:\\nTên: $name\\nEmail: $email\\nSố điện thoại: $phone\\nNgày hẹn: $date\\nPhòng khám: $department\\nBác sĩ: $doctor\\nLời nhắn: $message');</script>";
    echo "<script>window.location.href = 'index.php';</script>"; // Redirect về trang chủ hoặc trang cụ thể
} else {
    // Nếu không phải POST request, redirect người dùng
    header("Location: index.php"); // Thay đổi 'index.php' thành trang bạn muốn redirect
    exit();
}
?>