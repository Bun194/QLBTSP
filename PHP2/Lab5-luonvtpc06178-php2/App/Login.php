<?php
namespace App;
use App\core\Database;
class Login
{
    public $EmployeeID = null;
    public $EmployeeName = null;
    public $Position = null;
    public $PhoneNumber = null;
    public $Email = null;
    public $Password = null;
    public function loginUser()
    {
        if (empty($this->Email) || empty($this->Password)) {
            header("location:/register?error =emptyInput");
            exit();
        }
        if (!filter_var($this->Email, FILTER_VALIDATE_EMAIL)) {
            header("location: /register?error= email");
            exit();
        }
        $this->getUser($this->Email, $this->Password);
    }
    protected function getUser($Email, $Password)
    {
        $error = '';

        if (empty($Password) || empty($Email)) {
            $error = "Vui lòng nhập thông tin!";
        } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email không hợp lệ!";
        } else {
            $db = new Database();
            $select = "SELECT * FROM employees WHERE Email = '$Email' AND Password =  '$Password' ";
            $result = $db->pdo_query_one($select);

            if ($result !== false) {
                $_SESSION['Employee'] = $result;
                header("location: /login");
                exit();
            } else {
                $error = "Tài khoản hoặc mật khẩu không đúng.";
            }
        }

        $_SESSION['error'] = $error;
        header('location:/login');
        exit();
    }
    public function logout()
    {
        ob_start();
        session_unset();
        session_destroy();
        header("location:/");
    }
    public function login()
    {
        session_start(); // Bắt đầu session
        if (isset($_SESSION['Employee'])) {
            $EmployeeID = $_SESSION['Employee']['EmployeeID'];
            $Email = $_SESSION['Employee']['Email'];
            return "{$EmployeeID} {$Email} <a href='/logout'>Logout</a>";
        } else {
            $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
            $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
            $error =  isset($_SESSION['error']) ? $_SESSION['error'] : '';
            if (isset($_POST['submit'])) {
                $this->getUser($Email, $Password);
            }
            if (empty($error)) {
                return '
            <form action="/login" method="post">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="Email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="Password" class="form-control">
                </div>
                <button type="submit" name="submit" class="btn btn-primary" value="submit">Submit</button>
                <a href="/" class="btn btn-primary">Trang chủ</a>
            </form>
            ';
            } else {
                $_SESSION['error'] = null;
                return '
            <form action="/login" method="post">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="Email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="Password" class="form-control">
                </div>
                ' . ($error ? '<div class="alert alert-danger" role="alert">' . $error . '</div>' : '') . '
                <button type="submit" name="submit" class="btn btn-primary" value="submit">Submit</button>
                <a href="/" class="btn btn-primary">Trang chủ</a>
            </form>
            ';
            }
        }
    }
}
