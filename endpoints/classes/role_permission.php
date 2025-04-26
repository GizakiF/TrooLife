<?php

class RolePermission
{
    public static function createTable(mysqli $conn): void
    {
        $stmt = "
          CREATE TABLE `RolePermissions` (
            `role_id` int DEFAULT NULL,
            `permission_id` int DEFAULT NULL,
            KEY `fk_role_id1` (`role_id`),
            KEY `fk_permission_id` (`permission_id`),
            CONSTRAINT `fk_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `Permissions` (`permission_id`),
            CONSTRAINT `fk_role_id1` FOREIGN KEY (`role_id`) REFERENCES `Roles` (`role_id`)
          ); 
        ";
        mysqli_query($conn, $stmt);

    }
}
