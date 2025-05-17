<?php


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
    echo json_encode(["success" => false, "message" => "Missing email or password"]);
    exit();
}

$sql = "SELECT * FROM users WHERE email = ?";

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

if ($password !== $user['password']) {
    echo json_encode(["success" => false, "message" => "Invalid email or password"]);
    exit();
}

// unset($user['password']);

echo json_encode(["success" => true, "message" => "Login successful", "user" => $user]);


$_SESSION['user'] = $user;
print_r($_SESSION['user']);
header('Location: ../../index.php');
exit();

?>

