<?php
require '../models/UserModel.php';

// Khởi tạo UserModel
$userModel = new UserModel();

// Lấy dữ liệu từ POST
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';
$rePassword = $_POST['re-password'] ?? '';

// Mảng lưu trữ lỗi
$errors = [];

// Validate dữ liệu
if (empty($name)) {
    $errors['name'] = 'Họ và tên không được để trống.';
} elseif (strlen($name) < 5 || strlen($name) > 100) {
    $errors['name'] = 'Họ và tên phải có ít nhất 5 kí tự và không quá 100 kí tự.';
}

if (empty($phone)) {
    $errors['phone'] = 'Số điện thoại không được để trống.';
} elseif (!preg_match('/^(0[1-9][0-9]{8}|\\+84[1-9][0-9]{8})$/', $phone)) {
    $errors['phone'] = 'Số điện thoại không hợp lệ.';
}

if (empty($password)) {
    $errors['password'] = 'Mật khẩu không được để trống.';
} elseif (strlen($password) > 100) {
    $errors['password'] = 'Mật khẩu không được vượt quá 100 kí tự.';
}

if ($password !== $rePassword) {
    $errors['re-password'] = 'Mật khẩu và xác nhận mật khẩu không khớp.';
}

// Kiểm tra trùng số điện thoại
if (!$errors && $userModel->checkPhoneExists($phone)) {
    $errors['phone'] = 'Số điện thoại đã được sử dụng. Bạn có thể đăng nhập';
}

// Hiển thị lỗi hoặc tiến hành đăng ký
if (!empty($errors)) {
    // Hiển thị lỗi
    foreach ($errors as $key => $error) {
        echo "<div class='error' style='color: red;'>$error</div>";
    }
} else {
    // Đăng ký người dùng
    $userModel->register($name, $phone, $password);
    echo "<div hidden='hidden'>Đăng ký thành công!</div>";
}
?>