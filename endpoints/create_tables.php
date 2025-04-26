<?php

require("./classes/user.php");
require('./classes/role.php');
require('./classes/permission.php');
require('./classes/role_permission.php');
$conn = require('./connection.php');
try {
    User::createTable($conn);
    Role::createTable($conn);
    Permission::createTable($conn);
    RolePermission::createTable($conn);


} catch (Exception $e) {
    echo "Creation failed: " . $e->getMessage();
}
