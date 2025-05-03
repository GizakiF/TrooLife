<?php
session_start();

// Database connection settings
$servername = "localhost";
$dbUsername = "root";       // Default XAMPP username
$dbPassword = "";           // Default XAMPP password is blank
$dbName = "troolifedb";        // Replace with your actual DB name

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user input
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['Gender'];

    // Handle image upload
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imageName = uniqid() . "_" . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;
        } else {
            echo "Failed to upload image.";


        }
    }

    // Insert into DB
    $sql = "INSERT INTO users (first_name, last_name, username, email, password, date_of_birth, gender, profile_image_path)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $fname, $lname, $username, $email, $password, $birthday, $gender, $imagePath);

    if ($stmt->execute()) {
        echo "Account created successfully!";
        // Redirect or show success message
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
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

    $stmt = $conn->prepare("INSERT INTO Users (
    first_name, last_name, username,
    email, date_of_birth, gender,
    profile_image_path, role_id, password) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");

    $roleId = 2;
    $stmt->bind_param("sssssssis", $fname, $lname, $username, $email, $birthday, $gender, $imagePath, $roleId, $password);
    $stmt->execute();

    $_SESSION['users'][] = $newUser;

    //TODO: double check
    $_SESSION['user'] = $newUser;

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
          <a href="login_page.php" class="btn btn-outline-primary">← Back to Login</a>
        </div>
      </div>
    </div>
  </div>
  <?php include "footer.php"; ?>
</body>
</html>
