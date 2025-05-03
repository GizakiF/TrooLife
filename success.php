<?php
session_start();
?>
<?php
$conn = require('./endpoints/connection.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requiredFields = ['username', 'email', 'password', 'fname', 'lname', 'birthday', 'Gender'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            die("Error: All fields are required.");
        }
    }

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
        die("Error: Profile picture is required.");
    }

    // Sanitize input
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $gender = htmlspecialchars($_POST['Gender']);

    // Handle image upload
    $uploadDir = 'uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uniqueName = uniqid() . "_" . basename($_FILES['image']['name']);
    $targetPath = $uploadDir . $uniqueName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        die("Error uploading image.");
    }

    $imagePath = $targetPath;

    $newUser = [
       "username" => $username,
       "email" => $email,
       "password" => $password,
       "first_name" => $fname,
       "last_name" => $lname,
       "date_of_birth" => $birthday,
       "gender" => $gender,
       "profile_picture" => $imagePath
    ];


    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = [];
    }

    $stmt = $conn->prepare("INSERT INTO Users(first_name, last_name, username, 
              email, date_of_birth, gender
              profile_image_path, role_id, password)
            VALUES (?????????)
    ");
    $stmt->bind_param("sssssssis", $fname, $lname, $username, $email, $birthday, $gender, $imagePath, 2, $password);
    $stmt->execute();

    $_SESSION['users'][] = $newUser;

    //TODO: double check
    // $_SESSION['user'] = $newUser;

} else {
    header("Location: register.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/styles.css" />
<link rel="stylesheet" href="css/global_styles.css" />
<head>
  <meta charset="UTF-8" />
  <title>Registration Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<?php include "header.php"; ?>
<div style="height: 80px;"></div>

<body class="bg-light">
  <div class="container py-5">
    <div class="card shadow-lg rounded-4 mx-auto" style="max-width: 600px;">
      <div class="card-body">
        <h2 class="text-center mb-4">Registration Details</h2>
        <ul class="list-group">
          <li class="list-group-item"><strong>Username:</strong> <?= $username ?></li>
          <li class="list-group-item"><strong>Email:</strong> <?= $email ?></li>
          <li class="list-group-item"><strong>First Name:</strong> <?= $fname ?></li>
          <li class="list-group-item"><strong>Last Name:</strong> <?= $lname ?></li>
          <li class="list-group-item"><strong>Birthday:</strong> <?= $birthday ?></li>
          <li class="list-group-item"><strong>Gender:</strong> <?= ucfirst($gender) ?></li>
          <li class="list-group-item">
            <strong>Profile Picture:</strong><br>
            <img src="<?= $imagePath ?>" alt="Profile Picture" class="img-thumbnail mt-2" style="max-width: 150px;">
          </li>
        </ul>
        <div class="text-center mt-4">
          <a href="register.php" class="btn btn-outline-primary">← Back to Registration</a>
        </div>
      </div>
    </div>
  </div>
  <?php include "footer.php"; ?>
</body>
</html>
