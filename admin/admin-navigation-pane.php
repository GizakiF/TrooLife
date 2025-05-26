<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="col-md-2 admin-navigation-pane p-4 bg-white">
  <h2 class="mb-4">TrooLife</h2>
  <hr />
  <ul class="nav flex-column">
    <li class="nav-item mb-2">
      <a class="nav-link <?php echo ($current_page === 'admin-dashboard.php') ? 'active' : ''; ?>" href="admin-dashboard.php">Users</a>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link <?php echo ($current_page === 'change_password.php') ? 'active' : ''; ?>" href="change_password.php">Change Password</a>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link <?php echo ($current_page === 'admin-creation.php') ? 'active' : ''; ?>" href="admin-creation.php">Admin Creation</a>
    </li>
  </ul>
</div>

