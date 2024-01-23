<?php

require_once "vendor/autoload.php";

use App\core\Form;
// bài tập thêm
use App\Models\User;
 echo "Bài tập thêm"."<br/>";
$user = new User('User');
$user -> getOne(1, 1);
$user -> getAll();
// $user -> create();
// $user -> update();
// $user -> delete();

$form = new Form();
$form->field('fieldName'); // Gọi phương thức field
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab3-luonvtpc06178</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    
    <div class="container">
        <h1 class="d-flex justify-content-center">REGISTER A NEW ACCOUNT</h1>
        <?php
        $form = Form::begin(" ", "post");
        ?>
        <div class="row">
            <div class="col">
                <?php echo $form->field('firstname'); ?>
            </div>
            <div class="col">
                <?php echo $form->field('lastname'); ?>
            </div>
        </div>
        <?php
        echo $form->field("email");
        ?>
        <?php
        echo $form->field("password")->passwordField();
        ?>
        <?php
        echo $form->field("confirm")->passwordField();
        ?>
        <button type="submit" name="them" class="btn btn-primary">
            Submit
        </button>
        <?php echo $form->end(); ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
