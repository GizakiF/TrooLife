<?php
session_start();
require_once("../endpoints/connection.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_user'])) {
    header("Location: login.php");
    exit();
}

$admin_user = $_SESSION['admin_user'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords don't match";
    } elseif (strlen($new_password) < 8) {
        $error = "Password must be at least 8 characters";
    } else {
        // Verify current password
        $conn = require("../endpoints/connection.php");
        $stmt = $conn->prepare("SELECT password FROM Admins WHERE admin_id = ?");
        $stmt->bind_param("i", $admin_user['admin_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        if (password_verify($current_password, $admin['password'])) {
            // Update password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare("UPDATE Admins SET password = ? WHERE admin_id = ?");
            $update_stmt->bind_param("si", $hashed_password, $admin_user['admin_id']);

            if ($update_stmt->execute()) {
                $success = "Password changed successfully";
            } else {
                $error = "Failed to update password";
            }
        } else {
            $error = "Current password is incorrect";
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/admin-dashboard.css" />
    <link rel="stylesheet" href="../css/buttons.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Change Password</title>
  </head>
  <body>
    <div class="container-fluid px-0">
      <div class="row g-0">
        <!-- navigation pane -->
        <?php require("./admin-navigation-pane.php")?>

        <!-- dashboard -->
        <div class="col-md-10 admin-dashboard p-4">
          <!-- admin user panel -->
          <div class="container-fluid admin-user-panel d-flex justify-content-between align-items-center mb-4">
            <h3>Change Password</h3>
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
              
              <form method="POST" action="change_password.php">
                <div class="mb-3">
                  <label for="current_password" class="form-label">Current Password</label>
                  <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                
                <div class="mb-3">
                  <label for="new_password" class="form-label">New Password</label>
                  <input type="password" class="form-control" id="new_password" name="new_password" required>
                  <div class="form-text">Must be at least 8 characters long</div>
                </div>
                
                <div class="mb-3">
                  <label for="confirm_password" class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="default-button">Change Password</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap 5 -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
