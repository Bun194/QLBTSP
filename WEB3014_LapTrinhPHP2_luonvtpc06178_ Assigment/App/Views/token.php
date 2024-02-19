<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-left mb-3">Nhập mã xác nhận</h3>
                        <form method="POST" action="<?php ROOT_URL ?>?url=TokenController/tokenComfirm">
                            <div class="form-group">
                                <label>Mã xác nhận</label>
                                <input type="text" class="form-control p_input" name="token" id="token">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block enter-btn" name="submit" value="submit">Xác nhận</button>
                            </div>
                            <?php
                            // Hiển thị thông báo lỗi nếu có
                            if (isset($_SESSION['reset_error'])) {
                                echo "<div class='alert alert-danger' role='alert'>{$_SESSION['reset_error']}</div>";
                                unset($_SESSION['reset_error']);
                            }
                            ?>
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