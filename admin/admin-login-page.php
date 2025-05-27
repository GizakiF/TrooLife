<?php
session_start();
$errors = $_SESSION['login_errors'] ?? [];
unset($_SESSION['login_errors']);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/admin-login-page.css" />
    <!-- bs5 icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <title>Admin Login Page</title>
  </head>
  <body class="body-bg">
    <div class="container-fluid">
      <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow admin-login-card">
          <img src="../assets/images/nature.jpg" alt="" class="card-img-top" />
          <div class="card-body admin-login-card-body">
            <div class="card-title fw-bold fs-2 mb-3">Login</div>
            <?php if (!empty($errors)): ?>
              <div class="alert alert-danger">
                <ul class="mb-0">
                  <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
            <!-- login form -->
            <form
              class="admin-login-form"
              action="../endpoints/authentication/admin-login-service.php"
              method="POST"
            >
              <!-- email form -->
              <div class="mb-3 input-group">
                <span class="input-group-text">
                  <i class="bi bi-envelope"></i
                ></span>
                <input
                  placeholder="Email"
                  type="email"
                  class="form-control"
                  id="admin-email"
                  name="admin-email"
                />
              </div>

              <!-- password form -->
              <div class="mb-3 input-group">
                <span class="input-group-text">
                  <i class="bi bi-lock"></i
                ></span>
                <input
                  placeholder="Password"
                  type="password"
                  class="form-control"
                  id="admin-password"
                  name="admin-password"
                />
              </div>

              <!-- submit buttong -->
              <div class="d-flex justify-content-center">
                <button
                  type="submit"
                  class="submit-button btn btn-primary w-100"
                >
                  Submit
                </button>
              </div>
            </form>
            <!-- end of login form -->
          </div>
        </div>
      </div>
    </div>
    <!-- bs5 script -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
