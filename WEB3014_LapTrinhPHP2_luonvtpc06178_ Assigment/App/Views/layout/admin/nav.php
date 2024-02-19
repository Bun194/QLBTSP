<div class="container-scroller">
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="<?= ROOT_URL ?>?url=HomeController">
        <h3 style="color: white;">Bảo trì sản phẩm</h3>
      </a>
      <a class="sidebar-brand brand-logo-mini" href="<?= ROOT_URL ?>?url=HomeController">
        <h1 style="color: white;">B</h1>
      </a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="Public/assets/images/faces/img-user.png" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">
                <?php
                // Kiểm tra xem người dùng đã đăng nhập chưa
                if (!isset($_SESSION['user'])) {
                  // Nếu không, chuyển hướng về trang đăng nhập
                  header('Location: ?url=LoginController/loginPage');
                  exit;
                }
                // Hiển thị tên người đăng nhập
                echo 'Xin chào ' . $_SESSION['user']['EmployeeName']; // Thay 'Username' bằng trường dữ liệu thích hợp trong bảng người dùng của bạn
                ?>
              </h5>
              <span>Admin</span>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="<?= ROOT_URL ?>?url=HomeController">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Bảng điều khiển</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="<?= ROOT_URL ?>?url=ProductController/ProductPage">
          <span class="menu-icon">
            <i class="mdi mdi-receipt"></i>
          </span>
          <span class="menu-title">Sản phẩm</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="<?= ROOT_URL ?>?url=StaffController/StaffPage">
          <span class="menu-icon">
            <i class="mdi mdi-account-multiple"></i>
          </span>
          <span class="menu-title">Người dùng</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="<?= ROOT_URL ?>?url=MaintenanceController/MaintenancePage">
          <span class="menu-icon">
            <i class="mdi mdi-note"></i>
          </span>
          <span class="menu-title">Phiếu bảo trì</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="index.php?page=home">
          <h1 style="color: white;">B</h1>
        </a>
      </div>
      <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav w-100">
          <li class="nav-item w-100">
            <form id="searchForm" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="<?= ROOT_URL ?>?url=MaintenanceController/Search" method="post">
              <input id="searchInput" type="text" class="form-control" name="keyword" placeholder="Tìm kiếm phiếu bảo trì">
              <button type="submit" class="btn btn-primary"><i class="mdi mdi mdi-yeast"></i></button>
            </form>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
              <div class="navbar-profile">
                <img class="img-xs rounded-circle" src="Public/assets/images/faces/img-user.png" alt="">
                <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php
                                                                      // Kiểm tra xem người dùng đã đăng nhập chưa
                                                                      if (!isset($_SESSION['user'])) {
                                                                        // Nếu không, chuyển hướng về trang đăng nhập
                                                                        header('Location: ?url=LoginController/loginPage');
                                                                        exit;
                                                                      }
                                                                      // Hiển thị tên người đăng nhập
                                                                      echo 'Xin chào ' . $_SESSION['user']['EmployeeName']; // Thay 'Username' bằng trường dữ liệu thích hợp trong bảng người dùng của bạn
                                                                      ?></p>
                <i class="mdi mdi-menu-down d-none d-sm-block"></i>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
              <h6 class="p-3 mb-0">Thông tin</h6>
              <div class="dropdown-divider"></div>
              <div class="dropdown-divider"></div>
              <a href="?url=LoginController/logout" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-logout text-danger"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject mb-1">Đăng xuất</p>
                </div>
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-format-line-spacing"></span>
        </button>
      </div>
    </nav>