<?php
session_start();
$conn = require("../endpoints/connection.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin-login-page.php");
    exit();
}

$admin_user = $_SESSION['admin_user'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role_id = 1;

    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    } else {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT * FROM Admins WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username or email already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $created_at = date("Y-m-d H:i:s");
            $is_active = 1;

            $insert_stmt = $conn->prepare("INSERT INTO Admins (first_name, last_name, username, email, password, date_created, is_active, role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("ssssssii", $first_name, $last_name, $username, $email, $hashed_password, $created_at, $is_active, $role_id);

            if ($insert_stmt->execute()) {
                $success = "Admin account created successfully.";
            } else {
                $error = "Failed to create admin account.";
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/admin-dashboard.css" />
    <link rel="stylesheet" href="../css/buttons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <title>Create Admin</title>
  </head>
  <body>
    <div class="container-fluid px-0">
      <div class="row g-0">
        <!-- navigation pane -->
        <?php require("./admin-navigation-pane.php")?>

        <!-- main content -->
        <div class="col-md-10 admin-dashboard p-4">
          <div class="container-fluid admin-user-panel d-flex justify-content-between align-items-center mb-4">
            <h3>Create Admin</h3>
            <div>
              <span class="me-3">Hello, <?php echo htmlspecialchars($admin_user['first_name']); ?></span>
              <a href="admin-login-page.php" class="btn btn-outline-secondary btn-sm">Logout</a>
            </div>
          </div>

          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
              <?php endif; ?>
              <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
              <?php endif; ?>

              <form method="POST" action="admin-creation.php">
                <div class="mb-3">
                  <label for="first_name" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" required />
                </div>

                <div class="mb-3">
                  <label for="last_name" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" required />
                </div>

                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" required />
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required />
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required />
                  <div class="form-text">Must be at least 8 characters long</div>
                </div>


                <button type="submit" class="default-button">Create Admin</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
