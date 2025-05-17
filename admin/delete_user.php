<?php

$conn = require("../endpoints/connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);
    
    try {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}

header("Location: admin-dashboard.php");
exit();
