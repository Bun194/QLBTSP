<?php
ob_start();
session_start();
require_once "vendor/autoload.php";

use App\core\Route as Router;
use App\Home;
use App\Invoices;

$router = new Router();
$router 
    ->get('/', [App\Home::class,'index'])
    ->post('/upload', [App\Home::class,'upload'])
    ->get('/login', [App\Login::class,'login'])
    ->post('/login', [App\Login::class,'login'])
    ->get('/logout', [App\Login::class,'logout']);
echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab5-luonvtpc06178</title>
</head>

<body>
    <h1>Lab5-luonvtpc06178</h1>
</body>

</html>
<?php
ob_end_flush();
?>