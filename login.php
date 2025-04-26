<?php
session_start();
$conn = require('./endpoints/connection.php');
$url = "http://localhost:8000/endpoints/authentication/login.php";
$users = $_SESSION['users'] ?? [
    [
        "username" => "John",
        "email" => "johndoe123@gmail.com",
        "password" => "johndoe123",
        "first_name" => "John",
        "last_name" => "Doe",
        "date_of_birth" => "1990-05-15",
        "gender" => "Male",
        "profile_picture" => "./uploads/blank-profile-picture.png"
    ],
    [
        "username" => "Jane",
        "email" => "janedoe123@gmail.com",
        "password" => "janedoe123",
        "first_name" => "Jane",
        "last_name" => "Smith",
        "date_of_birth" => "1992-08-22",
        "gender" => "Female",
        "profile_picture" => "./uploads/blank-profile-picture.png"
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    $errors = [];

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        $authenticatedUser = null;

        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                $authenticatedUser = $user;
                break;
            }
        }

        print_r('this is running');
        if ($authenticatedUser) {
            $_SESSION['user'] = $authenticatedUser;
            $_SESSION['user_loggedin'] = true;

            header('Location: ../TrooLife/index.php');
            exit();
        } else {
            $errors[] = "Invalid email or password";
        }
    }

    $_SESSION['login_errors'] = $errors;
    header('Location: login_page.php');
    exit();
} else {
    header('Location: login_page.php');
    exit();
}
?>

