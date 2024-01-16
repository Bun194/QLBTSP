<?php
    include "App/Views/header.php";
    include "App/Views/nav.php";
    $page =  "login";
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        switch ($page) {
            case 'login':
                include "App/Views/login.php";
                break;
            case 'home':
                include "App/Views/home.php";
                break;
            case 'products':
                include "App/Views/products.php";
                break;
            case 'add-products':
                include "App/Views/add-products.php";
                break;
            case 'update-products':
                include "App/Views/update-products.php";
                break;
            case 'staff':
                include "App/Views/staff.php";
                break;
            case 'add-staff':
                include "App/Views/add-staff.php";
                break;
            case 'update-staff':
                include "App/Views/update-staff.php";
                break;
            case 'maintenance':
                include "App/Views/maintenance.php";
                break;
            case 'add-maintenance':
                include "App/Views/add-maintenance.php";
                break;
            case 'update-maintenance':
                include "App/Views/update-maintenance.php";
                break;
            
        }
    }else{
        include "App/Views/home.php";
    }

    include "App/Views/footer.php";
?>