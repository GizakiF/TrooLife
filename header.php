<nav
  class="position-relative navbar navbar-expand-xl navbar-dark fixed-top"
  style="
    position: fixed !important;
    top: 0 !important;
    width: 100% !important;
    z-index: 1030 !important;
  "
>
  <div class="justify-content-start container-fluid px-xl-5 px-md-1 gap-3">
    <!-- navbar toggle button -->
    <button
      class="navbar-toggler border border-0 ps-1 pe-1 ms-2 me-3"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#main-nav"
    >
      <!-- toggler icon -->
      <div class="align-items-center">
        <img class="menu-icon" src="assets/images/menu.svg" alt="" />
      </div>
      <!-- <span class="navbar-toggler-icon"></span> -->
    </button>

    <!-- navbar brand, title -->
    <a href="index.php" class="navbar-brand"
      ><img src="assets/images/troolife logo 1.svg" alt=""
    /></a>

    <!-- non collapsible elements -->
    <div class="d-xl-none d-flex align-items-center order-xl-2 ms-auto">
      <!-- cart item -->
      <a href="" class="cart-image text-white nav-link mb-1"
        ><img src="assets/images/cart.svg" alt=""
      /></a>

      <!-- languages dropdown -->
      <div class="dropdown align-items-center">
        <img src="assets/images/globe.svg" class="globe-image" alt="" />
        <button
          type="button"
          class="btn ps-2 dropdown-toggle text-white"
          data-bs-toggle="dropdown"
        >
          <span>English</span>
          <!-- <i class="bi bi-chevron-down"></i> -->
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">English</a></li>
          <li><a class="dropdown-item" href="#">中国</a></li>
        </ul>
      </div>
    </div>

    <!-- collapsible elements -->
    <div
      class="collapse navbar-collapse justify-content-end order-xl-1"
      id="main-nav"
    >
      <ul class="navbar-nav">
        <!-- left list -->
        <div
          class="left-list d-xl-flex align-items-center gap-3 me-xxl-3 me-lg-1"
        >
          <li class="nav-item">
            <a href="index.php" class="text-white nav-link navlink-underline">Mission</a>
          </li>
          <li class="nav-item">
            <a href="" class="text-white nav-link">LifeLine</a>
          </li>
          <li class="nav-item">
            <a href="" class="text-white nav-link">Nutrition</a>
          </li>
          <li class="nav-item">
            <a href="" class="text-white nav-link">Free by Referral</a>
          </li>
          <li class="nav-item">
            <a href="" class="text-white nav-link">Public Relations</a>
          </li>
          <li class="nav-item">
            <a href="" class="text-white nav-link">Company</a>
          </li>
          <li class="nav-item">
            <a href="aboutus.php" class="text-white nav-link">About Us</a>
          </li>
        </div>

        <!-- right list -->
        <div
          class="ms-xxl-5 ms-lg-2 right-list d-xl-flex align-items-center gap-xxl-3 gap-lg-2 gap-md-1"
        >
          <!-- cart item -->
          <a
            href=""
            class="cart-image text-white nav-link mb-1 d-none d-xl-block"
            ><img src="assets/images/cart.svg" alt=""
          /></a>

          <!-- vertical bar -->
          <!-- TODO: make the vertical bar dissapear and wont take space once lg breakpoint is triggered; try d-lg-none -->
          <span class="text-white d-none d-xl-block">|</span>

          <!-- my office, user image -->
          <a href="" class="user-image text-white nav-link"
            ><img src="assets/images/user.svg" alt="" class="me-2" /><span
              >My Office</span
            ></a
          >

          <!-- languages dropdown -->
          <div class="dropdown align-items-center d-none d-xl-block">
            <img src="assets/images/globe.svg" alt="" />
            <button
              type="button"
              class="btn ps-2 dropdown-toggle text-white"
              data-bs-toggle="dropdown"
            >
              <span>English</span>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">English</a></li>
              <li><a class="dropdown-item" href="#">中国</a></li>
            </ul>
          </div>
        </div>
      </ul>
    </div>
  </div>
</nav>
