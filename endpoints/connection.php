<?php

$serverName = "localhost";
$userName = "root";
$password = "";

try {
    $conn = new mysqli($serverName, $userName, $password);
    return $conn;
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
