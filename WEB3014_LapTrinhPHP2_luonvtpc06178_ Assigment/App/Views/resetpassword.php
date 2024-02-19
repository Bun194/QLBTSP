<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
      <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
        <div class="card col-lg-4 mx-auto">
          <div class="card-body px-5 py-5">
            <h3 class="card-title text-left mb-3">Đặt lại mật khẩu</h3>
            <form method="POST" action="<?php ROOT_URL ?>?url=ResetPasswordController/handleResetPassword">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control p_input" name="Email">
              </div>
              <?php echo (isset($_SESSION['validation_errors']['Email']) ? '<div class="text-danger">' . $_SESSION['validation_errors']['Email'] . '</div>' : ''); ?>
              <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control p_input" name="NewPassword">
              </div>
              <?php echo (isset($_SESSION['validation_errors']['NewPassword']) ? '<div class="text-danger">' . $_SESSION['validation_errors']['NewPassword'] . '</div>' : ''); ?>
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn" name="submit" value="submit">Xác nhận</button>
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