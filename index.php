<?php
session_start();
?>
<!-- TODO: add underline to the 'mission' or the active link -->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/global_styles.css" />
    <link rel="stylesheet" href="css/buttons.css" />

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
    <!-- TODO: navbar -->
    <!-- TODO: fix overlapping of elements when resized -->

    <!-- header -->
    <?php require("./header.php")?>
    <!-- end header -->

    <!-- info bar -->
    <div
      class="info-bar container-fluid mt-3 pt-5 me-5"
      style="margin-top: 30px !important"
    >
      <div
        class="info-bar d-flex align-items-center justify-content-between py-2 px-4"
      >
        <!-- Left Side: Profile -->

        <?php if (isset($_SESSION['user'])): ?>
        <div class="d-flex align-items-center">
          <a href="profile_page.php" style="text-decoration: none; color: inherit">
            <img
              src="<?= $_SESSION['user']['profile_image_path'] ?>"
              alt="Profile"
              class="profile-pic me-3"
            />
            <span class="fw-bold" style="font-size: 14px">
              <?= $_SESSION['user']['first_name'] . ' ' .
              $_SESSION['user']['last_name'] ?>
            </span>
          </a>
        </div>
        <?php else: ?>
        <div class="d-flex align-items-center">
          <a
            href="login_page.php"
            style="text-decoration: none; color: inherit"
          >
            <img
              src="./uploads/blank-profile-picture.png"
              alt="Guest"
              class="profile-pic me-3"
            />
            <span class="fw-bold" style="font-size: 14px">Guest User (Click to Login)</span>
          </a>
        </div>
        <?php endif; ?>

        <!-- Right Side: Icons and logout-->
        <div class="d-flex align-items-center gap-3">
            <!-- TODO: soon enough move me to the header instead of here -->
          <?php if (isset($_SESSION['user'])): ?>
              <a class="info-bar-logout-button" href="logout.php">Logout</a>
            <?php endif; ?>
          <img class="call-image" src="assets/images/call.svg" alt="Call" />
          <img
            class="message-image"
            src="assets/images/message.svg"
            alt="Message"
          />
        </div>
      </div>
    </div>

    <!-- TODO: fix video size when on md devices -->
    <!-- video and overlay text -->
    <div class="video-container">
      <video autoplay loop muted class="home-video">
        <source src="assets/videos/home_video.mp4" type="video/mp4" />
      </video>

      <!-- TODO: fix the text when on md devices -->
      <div class="overlay overlay-text">
        <h1 class="">
          <span>Tr<u>oo</u>Life </span>
          <span>
            is dedicated to enhancing the quality and longevity of lives.
          </span>
        </h1>
        <br />

        <img
          class="btn button-custom"
          src="assets/images/custom_button.svg"
          alt=""
        />
      </div>

      <div
        class="position-absolute bottom-0 end-0 me-lg-4 me-md-2 mb-3 text-white btn"
      >
        <span>SOUND </span>
        <span class="off-yellow-text">OFF</span>
        <img class="mb-1 ms-1" src="assets/images/sound.svg" alt="" />
      </div>
    </div>

    <!-- our mission -->
    <div class="my-5 p-3 container text-center" id="mission">
      <h1 class="mt-4 mb-2 fw-semibold">Our Mission</h1>
      <hr class="header-underline mx-auto" />
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <p class="fw-normal mt-3">
            Our TrooLife mission is to empower Members to make a true difference
            in their own personal health, wellness, and longevity. For them to
            enhance their own quality of life, and then to inspire a better
            quality of life for their family, friends, and associates.
          </p>
        </div>
      </div>
    </div>

    <!-- things you do -->
    <div class="row align-items-center" id="to-do">
      <div class="col-md-6 col-auto order-2 order-md-1">
        <div class="col-custom mw-custom mx-auto">
          <h4 class="mt-4">
            <u class="topic-underline topic-underline-yellow"
              >The things you consistently do</u
            >
          </h4>
          <br />
          <p class="mw-10 text-justify">
            to enhance your mind, your body, your relationships and your
            finances – will enhance your quality of life - and the quality of
            your extended life.
          </p>
          <p class="text-justify">
            Also be aware that the things that you do not bother to do for your
            mind, body, relationships and finances – will reduce your quality of
            life.
          </p>
        </div>
      </div>
      <div class="col-md-6 col-auto ms-auto order-1 order-md-2">
        <img class="img-fluid rounded-left" src="assets/images/jogging.png" />
      </div>
    </div>

    <!-- health expert says -->
    <div class="row align-items-center" id="health-experts">
      <div class="col-md-6 col-auto me-auto">
        <img
          class="img-fluid rounded-right"
          src="assets/images/happy_couple_cooking.png"
          alt=""
        />
      </div>
      <div class="col-md-6 col-auto">
        <div class="col-custom mw-custom mx-auto">
          <h4 class="mt-3">
            <u class="topic-underline yellow">Health experts say</u>
          </h4>
          <br />
          <p>
            we should have five servings or fresh fruits and vegetables every
            day, however this is not practical or possible for most active
            adults. This is why these same experts recommend supplementing your
            diet with high-quality vitamins, minerals, antioxidants and amino
            acids to help provide optimal health, vitality and mental clarity.
          </p>
        </div>
      </div>
    </div>

    <!-- lifeline program -->
    <div class="row align-items-center" id="lifeline-program">
      <div class="col-md-6 col-auto order-2 order-md-1">
        <div class="col-custom mw-custom mx-auto">
          <h4 class="mt-4">
            <u class="topic-underline yellow">Through our LifeLine program, </u>
          </h4>
          <br />
          <p>
            TrooLife will act as your personal wellness coach, encouraging you
            to eat well, to maintain a healthy activity level and to help you
            de-stress from your work and family pressures. LifeLine will also
            advise you on how to optimize your important personal relationships
            with your family, friends and associates, to enhance your own life,
            and theirs.
          </p>
        </div>
      </div>
      <div class="col-md-6 col-auto ms-auto order-1 order-md-2">
        <img
          class="img-fluid rounded-left w-100"
          src="assets/images/group_class_exercise.png"
          alt=""
        />
      </div>
    </div>

    <!-- troolife is commited -->
    <div class="row align-items-center" id="troolife-commited">
      <div class="col-md-6 col-auto me-auto">
        <img
          class="img-fluid rounded-right"
          src="assets/images/friends.png"
          alt=""
        />
      </div>

      <div class="col-md-6 col-auto">
        <div class="col-custom mw-custom mx-auto">
          <h4 class="mt-3">
            <u class="topic-underline yellow">TrooLife is also committed</u>
          </h4>
          <br />
          <p>
            to providing you excellent product quality and value, with the means
            to receive your nutritional supplements and wellness coaching for
            free, from a few simple referrals. Please take a few minutes to find
            out how.
          </p>
        </div>
      </div>
    </div>

    <!-- custom button dark -->
    <div class="position-absolute start-50 translate-middle">
      <img class="btn" src="assets/images/custom_button_dark.svg" alt="" />
    </div>

    <div class="tlp">
      <div class="container">
        <div class="row">
          <div class="col-md-12 sectionheader">
            <h2>Realize Your True Life Potential</h2>
            <div class="tlp-under"></div>
          </div>
          <div class="col-md-4 icon-container">
            <div class="inner-container">
              <img src="assets/images/coaching.png" alt="coaching" />
              <h3 class="potential-title">LifeLine Wellness Coaching</h3>
              <img src="assets/images/learnmore.png" />
            </div>
          </div>
          <div class="col-md-4 icon-container">
            <div class="inner-container">
              <img src="assets/images/healthcare.png" alt="coaching" />
              <h3 class="potential-title">Nutritional Health</h3>
              <img src="assets/images/learnmore.png" />
            </div>
          </div>
          <div class="col-md-4 icon-container">
            <div class="inner-container">
              <img src="assets/images/benefits.png" alt="coaching" />
              <h3 class="potential-title">Referral<br />Benefits</h3>
              <img src="assets/images/learnmore.png" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- footer  -->
    <?php require("./footer.php")?>
    <!--  end footer -->

    <!-- bs5 script -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
