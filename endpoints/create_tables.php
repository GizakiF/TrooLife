<?php


$conn = require('connection.php');
// require("/classes/user.php");
// require('/classes/role.php');
// require('/classes/permission.php');
// require('/classes/role_permission.php');
try {
    // User::createTable($conn);
    // Role::createTable($conn);
    // Permission::createTable($conn);
    // RolePermission::createTable($conn);
    $stmt = "
          CREATE TABLE Users (
            user_id int PRIMARY KEY,
            first_name varchar(255),
            last_name varchar(255),
            username varchar(255) UNIQUE NOT NULL,
            email varchar(255) UNIQUE NOT NULL,
            password varchar(255) NOT NULL,
            date_of_birth DATE,
            gender ENUM('male', 'female', 'undisclosed'),
            profile_image_path varchar(255),
            date_created TIMESTAMP,
            is_active boolean,
            last_login DATETIME,
            role_id int
          );
        ";
    mysqli_query($conn, $stmt);
    $stmt = "
          CREATE TABLE `Roles` (
            `role_id` int NOT NULL,
            `role_name` varchar(50) DEFAULT NULL,
            PRIMARY KEY (`role_id`)
          );
        ";
    mysqli_query($conn, $stmt);
    $stmt = "
          CREATE TABLE `Permissions` (
            `permission_id` int NOT NULL,
            `permission_name` varchar(50) DEFAULT NULL,
            `description` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`permission_id`)
          );
        ";
    mysqli_query($conn, $stmt);
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




} catch (Exception $e) {
    echo "Creation failed: " . $e->getMessage();
}
