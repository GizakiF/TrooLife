<?php

header("Content-Type: application/json");
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

        $updateStmt = $conn->prepare("UPDATE users SET is_active = ? WHERE user_id = ?");
        $updateStmt->bind_param("ii", $new_status, $user_id);
        $success = $updateStmt->execute();

        if ($success) {
            echo json_encode([
                "success" => true,
                "message" => "User status updated successfully.",
                "new_status" => $new_status
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Failed to update user status."
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "message" => "User not found."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request."
    ]);
}
