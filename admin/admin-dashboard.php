<?php
session_start();
$admin_user = $_SESSION['admin_user'];

$conn = require("../endpoints/connection.php");
$users = [];

try {
    $stmt = $conn->prepare("SELECT * FROM Users;");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} catch (Error $e) {
    error_log($e);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/admin-dashboard.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Admin Dashboard</title>
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
            <h3>Users</h3>
            <div>
              <span class="me-3">Hello, <?php echo htmlspecialchars($admin_user['first_name']); ?></span>
              <a href="logout.php" class="btn btn-outline-secondary btn-sm">Logout</a>
            </div>
          </div>

          <!-- Search Bar -->
          <div class="search-bar mb-4">
            <div class="input-group">
              <input
                type="text"
                id="searchInput"
                onkeyup="searchUsers()"
                class="form-control"
                placeholder="Search for users..."
              />
              <button class="btn button-search" type="button">
                <i class="bi bi-search"></i> Search
              </button>
            </div>
          </div>

          <!-- User Table -->
          <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
              <table class="table table-hover align-middle mb-0" id="userTable">
                <thead class="table-light">
                  <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Date Joined</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $user): ?>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img
                          src="../<?php echo htmlspecialchars($user['profile_image_path']); ?>"
                          alt=""
                          class="user-profile-image me-3"
                        />
                        <div>
                          <strong><?php echo htmlspecialchars($user["first_name"] . " " . $user["last_name"]); ?></strong>
                        </div>
                      </div>
                    </td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>@<?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['date_created']); ?></td>
                    <td>
                      <form method="POST" action="../endpoints/admin/update_user_status.php">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>" />
                        <?php if ($user['is_active']): ?>
                          <button type="submit" class="btn btn-sm btn-outline-danger">Deactivate</button>
                        <?php else: ?>
                          <button type="submit" class="btn btn-sm btn-outline-success">Activate</button>
                        <?php endif; ?>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

              <?php if (empty($users)): ?>
              <div class="p-4 text-center text-muted">No users found.</div>
              <?php endif; ?>
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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

    <!-- Search Script -->
    <script>
      function searchUsers() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll("#userTable tbody tr");

        rows.forEach((row) => {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(filter) ? "" : "none";
        });
      }
    </script>
  </body>
</html>
