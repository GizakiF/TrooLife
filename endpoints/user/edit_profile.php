<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$conn = require('../connection.php');

$fname = isset($_POST['fname']) ? $_POST['fname'] : null;
$lname = isset($_POST['lname']) ? $_POST['lname'] : null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$username = isset($_POST['username']) ? $_POST['username'] : null;
$birthday = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : null;
$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$userId = $_SESSION['user']['user_id'] ?? null;

try {
    $stmt = $conn->prepare("
    UPDATE users
    SET first_name = ?, last_name = ?,
    email = ?, username = ?,
    date_of_birth = ?, gender = ?, password = ?
    WHERE user_id = ?;
    ");
    $stmt->bind_param("sssssssi", $fname, $lname, $email, $username, $birthday, $gender, $password, $userId);
    $stmt->execute();

    $stmt = $conn->prepare("
    SELECT * FROM Users
    WHERE user_id = ?;
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $_SESSION['user'] = $user;


    header("Location: ../../profile_page.php");




} catch (Exception $e) {
    error_log("Update error: " . $e->getMessage());
}
