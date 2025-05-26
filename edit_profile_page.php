<?php
session_start();
$user = $_SESSION['user'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Profile Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="css/global_styles.css" />
    <link rel="stylesheet" href="css/buttons.css" />
    <link rel="stylesheet" href="css/login_page.css" />
    <link rel="stylesheet" href="css/styles.css" />

    <!-- bs5 css -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <!-- bs5 icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="css/profile_page.css" />
  </head>
  <body class="d-flex flex-column min-vh-100">
    <!-- header -->
    <?php require("./header.php")?>
    <!-- end header  -->
    <!-- start profile container -->
    <div class="profile-container">
      <div class="container my-5 flex-grow-1 d-flex align-items-center">
        <div class="card shadow-sm w-100">
          <form action="./endpoints/user/edit_profile.php" method="post">
            <div class="row g-0 flex-column flex-md-row">
              <!-- Left Column -->
              <div
                class="col-12 col-md-4 text-center p-4 border-end border-md-end-0 border-bottom border-md-bottom-0"
              >
                <img
                  src="<?= htmlspecialchars($user['profile_image_path']) ?>"
                  class="img-fluid rounded-circle mb-3 profile-image"
                  alt="Profile Picture"
                />
                <h4><?= htmlspecialchars($user['first_name']) ?></h4>
                <h5 class="text-muted"></h5>
                <?= htmlspecialchars($user['last_name']) ?>
              </div>

              <!-- Right Column -->
              <div class="col-12 col-md-8 p-4">
                <!-- TODO: ADD the action -->
                <h3 class="mb-4">Profile Information</h3>
                <a href="#"
                  >l<span class="glyphicon glyphicon-pencil"></span
                ></a>

                <hr />
                <div class="row mb-3">
                  <div class="col-sm-4 fw-bold">First Name:</div>
                  <div class="col-sm-8">
                    <div class="col-auto">
                      <input
                        type="text"
                        class="form-control"
                        id="fname"
                        value="<?= htmlspecialchars($user['first_name']) ?>"
                        name="fname"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-4 fw-bold">Last Name:</div>
                  <div class="col-sm-8">
                    <div class="col-auto">
                      <input
                        type="text"
                        class="form-control"
                        id="lname"
                        value="<?= htmlspecialchars($user['last_name']) ?>"
                        name="lname"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-4 fw-bold">Username:</div>
                  <div class="col-sm-8">
                    <?= htmlspecialchars($user['username']) ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-4 fw-bold">Password:</div>
                  <div class="col-sm-8">
                    <!-- TODO: have a way to check if the input password is the same as the previous password -->
                    <div class="col-auto">
                      <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        value="<?= htmlspecialchars($user['password']) ?>"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-4 fw-bold">Email:</div>
                  <div class="col-sm-8">
                    <div class="col-auto">
                      <input
                        type="email"
                        class="form-control"
                        id="email"
                        value="<?= htmlspecialchars($user['email']) ?>"
                        name="email"
                      />
                    </div>
                  </div>
                </div>
                <!-- <div class="row mb-3"> -->
                <!--   <div class="col-sm-4 fw-bold">Password:</div> -->
                <!--   <div class="col-sm-8"> -->
                <!--     <?= htmlspecialchars($user['password']) ?> -->
                <!--   </div> -->
                <!-- </div> -->
                <div class="row mb-3">
                  <div class="col-sm-4 fw-bold">Birthday:</div>
                  <div class="col-sm-8">
                    <div class="col-auto">
                      <input
                        type="date"
                        class="form-control"
                        id="date_of_birth"
                        value="<?= htmlspecialchars($user['date_of_birth']) ?>"
                        name="date_of_birth"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-4 fw-bold">Gender:</div>
                  <div class="col-sm-8">
                    <div class="gender-options">
                      <div class="gender-option form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="gender"
                          id="male"
                          value="male"
                          required
                          <?= $user['gender'] == 'male' ? 'checked' : '' ?>
                        />
                        <label class="form-check-label" for="male">Male</label>
                      </div>
                      <div class="gender-option form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="gender"
                          id="female"
                          value="female"
                          required
                          <?= $user['gender'] == 'female' ? 'checked' : '' ?>
                        />
                        <label class="form-check-label" for="female"
                          >Female</label
                        >
                      </div>
                      <div class="gender-option form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="gender"
                          id="other"
                          value="prefer_not_to_say"
                          required
                          <?= $user['gender'] == 'undisclosed' ? 'checked' : '' ?>
                        />
                        <label class="form-check-label" for="other"
                          >Prefer not to say</label
                        >
                      </div>
                    </div>

                    <button
                      type="submit"
                      class="btn btn-primary w-100 submit-button mt-5"
                    >
                      Save Changes
                    </button>
                    <!-- <?= htmlspecialchars($user['gender']) ?> -->
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end of profile container -->

    <!-- footer   -->
    <?php require("./footer.php")?>
    <!-- end footer -->

    <!-- bs5 script -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
