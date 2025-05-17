<?php
session_start();
$admin_user = $_SESSION['admin_user'];

$conn = require("../endpoints/connection.php");
$users = [];

try {
    $stmt = $conn->prepare(" SELECT * FROM Users; ");
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
    <title>Admin Dashboard</title>
  </head>
  <body>
    <!-- end of admin user panel -->
    <div class="container-fluid px-0">
      <div class="row g-0">
        <!-- navigation pane -->
        <div class="col-md-2 admin-navigation-pane p-4"><h2>TrooLife</h2><hr/></div>
        <!-- end of navigation pane -->
        <!-- dashboard -->
        <div class="col-md-10 admin-dashboard">
          <!-- admin user panel -->
          <div
            class="container-fluid admin-user-panel d-flex justify-content-between align-items-center p-2"
          >
            <h3 class="text-light">Hello, <?php echo htmlspecialchars($admin_user['first_name']); ?></h3>
            <a href="" class="text-light">Logout</a>
          </div>
          <h1 class="p-2">Dashboard</h1>
          <!-- card section; user count, active users -->
          <div class="card-section"></div>
          <!-- table section -->
          <div class="table-section px-3">
            <table class="table table-striped">
              <thead>
                Users
                <!-- <tr> -->
                <!--   <?php if (!empty($users)): ?> <?php foreach (array_keys($users[0]) as $column): ?> -->
                <!--   <th><?php echo htmlspecialchars($column); ?></th> -->
                <!--   <?php endforeach; ?> <?php else: ?> -->
                <!--   <th>No users found</th> -->
                <!--   <?php endif; ?> -->
                <!-- </tr> -->
              </thead>
              <tbody>
                <!-- <?php foreach ($users as $user): ?> -->
                <tr>
                  <td>
                    <!-- <div class="row align-items-center"> -->
                    <!--   <div class="col-md-9"> -->
                      <div class="d-flex">
                        <img
                          src="../<?php echo htmlspecialchars($user['profile_image_path']); ?>"
                          alt=""
                          class="user-profile-image"
                        />
                        <div class="d-flex flex-column p-2">
                          <div class="d-flex justify-content-center">
                            <span
                              ><?php echo htmlspecialchars($user["last_name"]); ?>, <?php echo htmlspecialchars($user["first_name"]); ?>
                            </span>
                          </div>
                          <span class="username">@<?php echo htmlspecialchars($user['username']); ?></span>
                        </div>
                      </div>
                      <!-- </div> -->
                      <!-- <div class="col-md-3"></div> -->
                    </div>
                  </td>
                </tr>

                <!-- <?php endforeach; ?> -->
                <!-- <?php foreach ($users as $user): ?> -->
                <!-- <tr> -->
                <!--   <?php foreach ($user as $value): ?> -->
                <!--   <td><?php echo htmlspecialchars($value); ?></td> -->
                <!--   <?php endforeach; ?> -->
                <!-- </tr> -->
                <!-- <?php endforeach; ?> -->

              </tbody>
            </table>
          </div>
        </div>
        <!-- end of dashboard -->
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
