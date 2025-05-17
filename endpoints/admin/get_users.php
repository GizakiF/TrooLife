<?php

header('Content-Type: application/json');

$conn = require("../connection.php");

try {
    $stmt = $conn->prepare("
    SELECT * FROM Users;
    ");
    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} catch (Error $e) {
    error_log($e);
}

function getUsers(mysqli $conn)
{

}
