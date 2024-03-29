<?php 
    session_start();
    $direct = 'home';

    require_once dirname(__FILE__) . '/../BackEnd/config.php';

    if(isset($_GET['page']))
    {
        $direct = $_GET['page'];
    }
    else if(isset($_POST['page']))
    {
        $direct = $_POST['page'];
    }
    $direct = htmlspecialchars($direct, ENT_QUOTES, 'UTF-8');

    require_once dirname(__FILE__) . "/titles.php";
    require_once dirname(__FILE__) . "/script.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A tutor booking system helps you find a suitable tutor and prepare you for your upcoming test. Our company includes the best teachers from the country with no doubt can help you achieve your dream.">
        <meta name="robots" content="index, follow">

        <link rel="icon" href="./assets/images/LOGO.png" type="image/x-icon" />
        <link rel="stylesheet" href="./assets/css/base.css">
        <link rel="stylesheet" href="./assets/css/main.css">
        <link rel="stylesheet" href="./assets/css/responsive.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"  rel="stylesheet"/>
        <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.0.0-beta2-web/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"  rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>
	    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    
    <body>
        <div class="app">
            <?php
                if($direct == "login" || $direct == "logout") {
                    echo "<script>location.replace('$direct.php')</script>";
                }
                else {
                    include "header.php";
                    include "$direct.php";
                    include "footer.php";
                }
            ?>
        </div>
    </body>
</html>
