<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
      <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
        <div class="card col-lg-4 mx-auto">
          <div class="card-body px-5 py-5">
            <h3 class="card-title text-left mb-3">Đăng nhập</h3>
            <form method="POST" action="<?php ROOT_URL ?>?url=LoginController/HandleLogin">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control p_input" name="Email">
              </div>
              <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control p_input" name="Password">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn" name="submit" value="submit">Đăng nhập</button>
              </div>
              <?php if (isset($_SESSION['login_error'])) : ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $_SESSION['login_error']; ?>
                </div>
                <?php unset($_SESSION['login_error']); ?>
              <?php endif; ?>
              <div class="text-center">
                <a href="<?php ROOT_URL ?>?url=ForgotPasswordController" class="forgot-pass">Quên mật khẩu?</a>
              </div>
              <p class="sign-up text-center">Bạn chưa có sẵn tài khoản?<a href="?url=RegisterController"> Đăng ký </a></p>
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