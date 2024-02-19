<?php
    ob_start();
    session_start();
    // use App\Models\User;

    // require_once 'vendor/autoload.php';

    // $user = new User('User');
    
    // $user -> getOne(1, 1);
    //============================================================//

    require_once 'vendor/autoload.php';
    // define ("ROOT_URL", "127.0.0.1:5000");
    define ("ROOT_URL", "http://localhost:8000/");
    // use App\Controllers\BaseController;
    use App\Controllers\HomeController;
    use App\Core\Route;
    use App\Models\User;
    // new BaseController();

    // new HomeController();
    $userModel = new User();
    // var_dump($userModel->getOneUser(2));
    new Route;
?>
<?php
ob_end_flush();
?>