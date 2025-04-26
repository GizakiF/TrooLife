<?php

class Role
{
    public static function createTable(mysqli $conn): void
    {
        $stmt = "
          CREATE TABLE `Roles` (
            `role_id` int NOT NULL,
            `role_name` varchar(50) DEFAULT NULL,
            PRIMARY KEY (`role_id`)
          );
        ";
        mysqli_query($conn, $stmt);
    }
}
