<?php
session_start();
$conn = require("../connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    $stmt = $conn->prepare("SELECT is_active FROM Users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $new_status = $user['is_active'] == 1 ? 0 : 1;

        $updateStmt = $conn->prepare("UPDATE Users SET is_active = ? WHERE user_id = ?");
        $updateStmt->bind_param("ii", $new_status, $user_id);
        $updateStmt->execute();

        header("Location: ../../admin/admin-dashboard.php");
        exit();
    }
}
?>

