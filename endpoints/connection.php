<?php

session_start();

$serverName = "localhost";
$userName = "root";
$password = "";
$db = "troolifedb";

try {
    $conn = new mysqli($serverName, $userName, $password, $db);
    return $conn;
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
