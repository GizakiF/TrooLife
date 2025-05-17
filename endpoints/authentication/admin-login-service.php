<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = require('../connection.php');

$email = isset($_POST['admin-email']) ? trim($_POST['admin-email']) : null;
$password = isset($_POST['admin-password']) ? $_POST['admin-password'] : null;

if (!$email || !$password) {
    echo json_encode(["success" => false, "message" => "Missing email or password"]);
    exit();
}

$sql = "SELECT * FROM Admins WHERE email = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Failed to prepare statement"]);
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(["success" => false, "message" => "Invalid email or password"]);
    exit();
}

if (!password_verify($password, $user['password'])) {
    echo json_encode(["success" => false, "message" => "Invalid email or password"]);
    exit();
}

// unset($user['password']);

echo json_encode(["success" => true, "message" => "Login successful", "user" => $user]);


$_SESSION['admin_user'] = $user;
print_r($_SESSION['admin_user']);
header('Location: ../../admin/admin-dashboard.php');
exit();


