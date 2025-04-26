<?php
session_start();
$url = "http://localhost:8000/endpoints/authentication/login.php";
$errors = $_SESSION['login_errors'] ?? [];
unset($_SESSION['login_errors']);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <title>TrooLife</title>
  </head>
  <body>
    <!-- header -->
    <?php require("./header.php")?>
    <!-- end header  -->

    <!-- login content -->
    <div class="container-fluid px-0 position-relative vh-100">
      <!-- video background -->
      <video autoplay loop muted class="position-absolute w-100 h-100">
        <source src="assets/videos/home_video.mp4" type="video/mp4" />
      </video>

      <!-- login form -->
      <div class="login-container">
        <div
          class="card p-4 bg-light bg-opacity-90"
          style="width: 400px; max-width: 90vw"
        >
          <h1 class="text-center mb-4">Login</h1>

          <!-- display errorrs -->
          <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">
            <ul class="mb-0">
              <?php foreach ($errors as $error): ?>
              <li><?= htmlspecialchars($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php endif; ?>

          <form action="<?= $url ?>" method="post">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                type="email"
                class="form-control"
                id="email"
                placeholder="Enter email"
                name="email"
              />
            </div>
            <div class="mb-5">
              <label for="pwd" class="form-label">Password</label>
              <input
                type="password"
                class="form-control"
                id="pwd"
                placeholder="Enter password"
                name="password"
              />
            </div>
            <!-- <div class="form-check mb-5"> -->
            <!--   <label class="form-check-label"> -->
            <!--     <input -->
            <!--       class="form-check-input" -->
            <!--       type="checkbox" -->
            <!--       name="remember" -->
            <!--     /> -->
            <!--     Remember me -->
            <!--   </label> -->
            <!-- </div> -->
            <div class="mb-5 mt-5" style="color:white;">.</div>

            <div class="mt-5 mb-3 text-center">
              Don't Have an Account?
              <a class="register-here" href="register.php">Register here!</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 submit-button">
              Submit
            </button>
          </form>
        </div>
      </div>

      <!-- Quotes Section - Desktop Only -->
      <div class="quotes-container d-none d-lg-block">
        <div class="quote-card bg-light bg-opacity-90 p-4">
          <blockquote class="quote-text">
            "The journey of a thousand miles begins with a single step."
            <footer class="quote-author">- Lao Tzu</footer>
          </blockquote>
          <blockquote class="quote-text mt-4">
            "Life is what happens when you're busy making other plans."
            <footer class="quote-author">- John Lennon</footer>
          </blockquote>
          <blockquote class="quote-text mt-4">
            "The purpose of our lives is to be happy."
            <footer class="quote-author">- Dalai Lama</footer>
          </blockquote>
        </div>
      </div>
    </div>
    <!-- end login content -->

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
