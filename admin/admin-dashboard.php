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
              <a href="../endpoints/admin/admin-logout.php" class="btn btn-outline-secondary btn-sm">Logout</a>
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
                  <tr class="user-row <?php echo $user['is_active'] ? '' : 'inactive'; ?>">
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
                      <form class="status-form" data-user-id="<?php echo htmlspecialchars($user['user_id']); ?>">
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

              <!-- pagination control -->
              <div id="pagination-controls" class="d-flex justify-content-center my-3"></div>

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

    <!-- pagination -->
    <script>
      const rowsPerPage = 7;
      let currentPage = 1;
      let allRows = [];

        function paginateTable(filteredRows = null) {
          const rows = filteredRows || allRows;
          const totalPages = Math.ceil(rows.length / rowsPerPage);

          rows.forEach((row, index) => {
            row.style.display = (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) ? "" : "none";
          });

          renderPaginationControls(totalPages, rows);
        }

        function renderPaginationControls(totalPages, visibleRows) {
          const container = document.getElementById("pagination-controls");
          container.innerHTML = "";

          for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.className = `btn btn-sm mx-1 ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'}`;
            btn.onclick = () => {
              currentPage = i;
              paginateTable(visibleRows);
            };
            container.appendChild(btn);
          }
        }

      function searchUsers() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const all = Array.from(document.querySelectorAll("#userTable tbody tr"));

        const filtered = all.filter(row => row.textContent.toLowerCase().includes(filter));

        all.forEach(row => row.style.display = "none");

        currentPage = 1;
        paginateTable(filtered);
      }

      document.addEventListener("DOMContentLoaded", () => {
        allRows = Array.from(document.querySelectorAll("#userTable tbody tr"));
        paginateTable();
      });
    </script>

    <!-- ajax -->
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".status-form").forEach((form) => {
          form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const button = form.querySelector("button[type='submit']");
            const userId = form.dataset.userId;

            const formData = new FormData();
            formData.append("user_id", userId);

            try {
              const response = await fetch("../endpoints/admin/update_user_status.php", {
                method: "POST",
                body: formData,
              });

              const result = await response.json();

              if (result.success) {
                // alert(result.message);
                const row = button.closest("tr");
                if (result.new_status === 1) {
                  button.textContent = "Deactivate";
                  button.classList.remove("btn-outline-success");
                  button.classList.add("btn-outline-danger");
                  row.classList.remove("inactive");
                } else {
                  button.textContent = "Activate";
                  button.classList.remove("btn-outline-danger");
                  button.classList.add("btn-outline-success");
                  row.classList.add("inactive");
                }
              } else {
                alert(result.message || "Something went wrong.");
              }
            } catch (error) {
              alert("Error updating user status.");
            }
          });
        });
      });
    </script>

  </body>
</html>
