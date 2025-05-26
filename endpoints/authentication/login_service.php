<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = require('../connection.php');

$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if (!$email || !$password) {
    $_SESSION['login_errors'] = ["Missing email or password"];
    header("Location: ../../login_page.php");
    exit();
}

$sql = "SELECT * FROM Users WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    $_SESSION['login_errors'] = ["Server error. Please try again later."];
    header("Location: ../../login_page.php");
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || $password !== $user['password']) {
    $_SESSION['login_errors'] = ["Invalid email or password"];
    header("Location: ../../login_page.php");
    exit();
}

if ($user['is_active'] == 0) {
    $_SESSION['login_errors'] = ["Your account is not yet activated. Please contact support."];
    header("Location: ../../login_page.php");
    exit();
}

// Login success
$_SESSION['user'] = $user;
header("Location: ../../index.php");
exit();
