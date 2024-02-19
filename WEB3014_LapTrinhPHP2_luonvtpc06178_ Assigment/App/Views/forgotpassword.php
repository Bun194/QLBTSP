<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
      <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
        <div class="card col-lg-4 mx-auto">
          <div class="card-body px-5 py-5">
            <h3 class="card-title text-left mb-3">Quên mật khẩu</h3>
            <form method="POST" action="<?php ROOT_URL ?>?url=ForgotPasswordController/forgotPassword">
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control p_input" name="Email" id="Email">
              </div>
              <?php echo (isset($_SESSION['login_error']) ? '<div class="text-danger">' . $_SESSION['login_error'] . '</div>' : ''); ?>
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn" name="submit" value="submit">Đăng nhập</button>
              </div>
              <div id="error-message" style="display: none;" class="alert alert-danger" role="alert">
                <!-- Nội dung thông báo lỗi sẽ được thay đổi bằng JavaScript -->
              </div>
              <p class="sign-up text-center">Bạn có sẵn tài khoản?<a href="?url=LoginController/loginPage"> Đăng nhập </a></p>
            </form>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- row ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
