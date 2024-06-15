<?php
require '../models/AuthModel.php';

// Khởi tạo AuthModel
$authModel = new AuthModel();

// loginService.php
session_start();
$phone = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';

$errors = [];

// Validate dữ liệu
if (empty($phone)) {
    $errors['phone'] = 'Số điện thoại không được để trống.';
}

if (empty($password)) {
    $errors['password'] = 'Mật khẩu không được để trống.';
}

// Kiểm tra đăng nhập và xử lý kết quả
if (empty($errors)) {
    if ($authModel->login($phone, $password)) {
        $_SESSION['user_phone'] = $phone;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Số điện thoại hoặc mật khẩu không chính xác']);
    }
} else {
    echo json_encode(['success' => false, 'errors' => $errors]);
}
?>