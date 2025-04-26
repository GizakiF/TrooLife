<?php

class Permission
{
    public static function createTable(mysqli $conn): void
    {

        $stmt = "
          CREATE TABLE `Permissions` (
            `permission_id` int NOT NULL,
            `permission_name` varchar(50) DEFAULT NULL,
            `description` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`permission_id`)
          );
        ";
        mysqli_query($conn, $stmt);
    }

}
