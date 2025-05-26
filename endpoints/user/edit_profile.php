
<?php
session_start();

$conn = require('../connection.php');

$fname = $_POST['fname'] ?? null;
$lname = $_POST['lname'] ?? null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$birthday = $_POST['date_of_birth'] ?? null;
$gender = $_POST['gender'] ?? null;
$password = $_POST['password'] ?? null;
$userId = $_SESSION['user']['user_id'] ?? null;

$profileImagePath = null;

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../../uploads/profile_images/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $tmpName = $_FILES['profile_image']['tmp_name'];
    $fileName = basename($_FILES['profile_image']['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileExt, $allowedExts)) {
        $newFileName = 'user_' . $userId . '_' . time() . '.' . $fileExt;
        $destination = $uploadDir . $newFileName;

        if (move_uploaded_file($tmpName, $destination)) {
            $profileImagePath = 'uploads/profile_images/' . $newFileName;
        } else {
            error_log("Failed to move uploaded file.");
        }
    } else {
        error_log("Unsupported file type uploaded.");
    }
}

try {
    if ($profileImagePath) {
        $stmt = $conn->prepare("
            UPDATE Users
            SET first_name = ?, last_name = ?, email = ?, date_of_birth = ?, gender = ?, password = ?, profile_image_path = ?
            WHERE user_id = ?;
        ");
        $stmt->bind_param("sssssssi", $fname, $lname, $email, $birthday, $gender, $password, $profileImagePath, $userId);
    } else {
        $stmt = $conn->prepare("
            UPDATE Users
            SET first_name = ?, last_name = ?, email = ?, date_of_birth = ?, gender = ?, password = ?
            WHERE user_id = ?;
        ");
        $stmt->bind_param("ssssssi", $fname, $lname, $email, $birthday, $gender, $password, $userId);
    }

    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id = ?;");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['user'] = $user;

    header("Location: ../../profile_page.php");
    exit();

} catch (Exception $e) {
    error_log("Update error: " . $e->getMessage());
}
?>

