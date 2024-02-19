<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\BaseRender;
use App\Models\User;
use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPasswordController extends BaseController
{

    private $_renderBase;

    /**
     * Thuốc trị đau lưng
     * Copy lại là hết đau lưng
     * 
     */
    function __construct()
    {
        parent::__construct();
        $this->_renderBase = new BaseRender();
        $this->ForgotPasswordController();

        // Load các biến môi trường từ file .env
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }
    function ForgotPasswordController()
    {
        $this->forgetpasswordPage();
    }
    function forgetpasswordPage()
    {
        // dữ liệu ở đây lấy từ repositories hoặc model
        // $data = [
        //     "products" => [
        //         [
        //             "id" => 1,
        //             "name" => "Sản phẩm"
        //         ]
        //     ]
        // ];

        $this->_renderBase->renderAdminHeader();
        $this->load->render('forgotpassword');
        // $this->_renderBase->renderAdminFooter();
    }
    public function forgotPassword()
    {
        // Xử lý khi form gửi đi
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra xem email đã được gửi chưa
            if (isset($_POST['Email'])) {
                $Email = $_POST['Email'];

                // Kiểm tra xem email có tồn tại trong CSDL không
                $userModel = new User(); // Giả sử bạn có một model để làm việc với người dùng

                // Kiểm tra xem email có được nhập vào không
                if (empty($Email)) {
                    $_SESSION['login_error'] = "Vui lòng nhập địa chỉ email.";
                    echo '<script>showError("' . $_SESSION['login_error'] . '");</script>';
                } else {
                    $user = $userModel->checkUserExist($Email);

                    if ($user) {
                        // Tạo token reset mật khẩu
                        $token = random_int(100000, 999999); // Tạo số ngẫu nhiên từ 100000 đến 999999 (bao gồm cả hai số này)

                        // Gửi email chứa link reset mật khẩu
                        if ($this->sendResetEmail($Email, $token)) {
                            // Lưu token vào CSDL hoặc session
                            $_SESSION['reset_token'] = $token;
                            $_SESSION['reset_email'] = $Email;

                            // Redirect hoặc hiển thị thông báo thành công
                            header('location: ?url=TokenController');
                            exit();
                        } else {
                            // Xử lý lỗi gửi email
                            $_SESSION['login_error'] = "Gửi Email lỗi!";
                            echo '<script>showError("' . $_SESSION['login_error'] . '");</script>';
                        }
                    } else {
                        // Xử lý khi email không có trong csdl
                        $_SESSION['login_error'] = "Email không tồn tại!";
                        echo '<script>showError("' . $_SESSION['login_error'] . '");</script>';
                    }
                }
            }
        } else {
            // Hiển thị form forgot password
            // Ví dụ:
            // $this->view('forgot_password');
        }
    }
    function sendResetEmail($Email, $token)
    {
        // $dotenv = Dotenv::createImmutable(__DIR__);
        // $dotenv->load();
        $mail = new PHPMailer(true);
        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host       = $_ENV["SMTP_HOST"]; // SMTP server
            $mail->CharSet = 'utf-8';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV["SMTP_USERNAME"]; // SMTP username
            $mail->Password   = $_ENV["SMTP_PASSWORD"]; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $_ENV["SMTP_PORT"];

            // Thiết lập các thông tin email
            $mail->setFrom($_ENV["SMTP_USERNAME"], 'Bảo trì thiết bị');
            $mail->addAddress($Email);
            $mail->isHTML(true);
            $mail->Subject = 'Đặt lại mật khẩu';
            $mail->Body    = 'Mã xác nhận của bạn là: ' . $token;

            // Gửi email
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
