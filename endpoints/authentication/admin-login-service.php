<?php

session_start();

$conn = require('../connection.php');

$email = isset($_POST['admin-email']) ? trim($_POST['admin-email']) : null;
$password = isset($_POST['admin-password']) ? $_POST['admin-password'] : null;

if (!$email || !$password) {
    $_SESSION['login_errors'] = ['Missing email or password'];
    header('Location: ../../admin/admin-login-page.php');
    exit();
}

$sql = "SELECT * FROM Admins WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    $_SESSION['login_errors'] = ['Failed to prepare statement'];
    header('Location: ../../admin/admin-login-page.php');
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['login_errors'] = ['Invalid email or password'];
    header('Location: ../../admin/admin-login-page.php');
    exit();
}

// unset($user['password']);

$_SESSION['admin_user'] = $user;
header('Location: ../../admin/admin-dashboard.php');
exit();
