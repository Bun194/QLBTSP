<?php

require_once "vendor/autoload.php";

use App\core\Route as Router;
use App\Home;
use App\Invoices;

// $router = new Router();
// $router->register(
//     '/',
//     function () {
//         echo "Home";
//     }
// );

$router = new Router();
$router ->register('/', [App\Home::class,'index'])
        ->register('/invoices', [App\Invoices::class,'index'])
        ->register('/invoices/create', [App\Invoices::class,'create']);
        echo $router->resolve($_SERVER['REQUEST_URI']);
        // $router->resolve($_SERVER['REQUEST_URI']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab4-luonvtpc06178</title>
</head>

<body>
    <h1>Lab4-luonvtpc06178</h1>
</body>

</html>
