<?php

$conn = require('../connection.php');

$fname = isset($_POST['fname']) ? $_POST['fname'] : null;
$lname = isset($_POST['lname']) ? $_POST['lname'] : null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$username = isset($_POST['username']) ? $_POST['username'] : null;
$birthday = isset($_POST['birthday']) ? $_POST['birthday'] : null;
$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$userId = $_SESSION['user']['user_id'] ?? null;

try {
    $stmt = $conn->prepare("
    UPDATE Users
    SET first_name = ?, last_name = ?,
    email = ?, username = ?,
    birthday = ?, gender = ?, password = ?
    WHERE user_id = ?
    ");
    $stmt->bind_param("sssssssi", $fname, $lname, $email, $username, $birthday, $gender, $password);
    $stmt->execute();


} catch (Exception $e) {

}
