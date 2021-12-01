<?php
    //connection details
    $mysql_addr = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_db = "tutor_booking_system";
    function retrieveCourse($course_code){
        //function to retrieve the information of a course
        //return an associated array
        global $mysql_addr, $mysql_user, $mysql_password, $mysql_db;

        $conn = mysqli_connect($mysql_addr, $mysql_user, $mysql_password, $mysql_db);
        $query_str = sprintf("SELECT * FROM courses WHERE course_code = '%s'", $course_code);
        $query = mysqli_query($conn, $query_str);

        if (!$query){
            echo "<script>alert('Error executing query: " . mysqli_error($conn) . "')</script>";
            return NULL;
        }
        
        $course = mysqli_fetch_assoc($query);
        $course["schedule"] = json_decode($course["schedule"], true);

        return $course;
    }
    function retrieveTutor($tutor_id){
        //function to retrieve info about a tutor
        //retur an associated array
        global $mysql_addr, $mysql_user, $mysql_password, $mysql_db;
        
        $conn = mysqli_connect($mysql_addr, $mysql_user, $mysql_password, $mysql_db);
        $query_str = sprintf("SELECT * FROM users WHERE user_id = %s", $tutor_id);
        $query = mysqli_query($conn, $query_str);

        if (!$query){
            echo "<script>alert('Error executing query: " . mysqli_error($conn) . "')</script>";
            return NULL;
        }
    
        return mysqli_fetch_assoc($query);
    }
?>


<?php
    if (!isset($_GET["code"])){
        echo "<script>alert('Course code must be specified.')</script>";
        exit;
    }

    //retrieve the course
    $course = retrieveCourse($_GET["code"]);

    if (is_null($course)){
        echo "<script>alert('Cannot find the given course.')</script>";
        exit;
    }

    //retrive the tutor
    $tutor = retrieveTutor($course["tutor_id"]);
    
    if (is_null($tutor)){
        echo "<script>alert('Cannot find the given tutor.')</script>";
        exit;
    }

    session_start();
    $is_logged_in = isset($_SESSION["user_id"]);

?>



<!DOCTYPE html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"  rel="stylesheet"/>
        <!-- ********************************************************************************************************** -->

        <script type="text/javascript" src="scripts.js"></script>
        <link rel="icon" href="./assets/images/LOGO.png" type="image/x-icon" />
        <link rel="stylesheet" href="./assets/css/base.css">
        <link rel="stylesheet" href="./assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="tutor.css"/>
        <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.0.0-beta2-web/css/all.css">
        <link rel="stylesheet" href="./assets/css/responsive.css">
    </head>


    <body>
        <!-- navigation bar -->
        <?php include "./header.php" ?>


        <div id="main-container" class="container">
            <!-- The course name -->
            <div class="row">
                <h2 id="course-name"><?= $course["course_name"] ?></h2>
            </div>

            <!-- The course's brief description and tutor's name -->
            <div class="row description">
                <p>
                    <?= str_replace("\n", "<br>", $course["brief"]) ?>
                    <br><br>
                    Tutor: <a href="#"><?= $tutor["full_name"]?></a>
                </p>
            </div>


            <!-- the course deatils -->
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-12 mx-auto pl-0 pr-0">
                    <!-- smooth scroll to scroll to a section -->
                    <nav id="section-navbar" class="navbar navbar-expand navbar-light">
                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav smooth-scroll">
                                <li class="nav-item">
                                    <a class="nav-link" href="#course-description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#schedule-section">Schedule</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tutor-profile">About Tutor</Section></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    
                    <div id="course-description" class="container">
                        <!-- Course description -->
                        <div class="row">
                            <h5>Course description</h5>
                        </div>
                        <div class="row">
                            <p>
                                <?= str_replace("\n", "<br>", $course["description"]) ?>
                            </p>
                        </div>
                    </div>


                    <div id="schedule-section" class="container">
                        <!-- Course schedule  -->
                        <div id="schedule-title" class="row">
                            <h5 class="rounded p-1">Schedule</h5>
                        </div>
                        <?php
                            $card = '
                            <div id="accordion-%d" class="schedule-item row">
                                <div class = "col-lg-12 col-md-12 col-sm-12 col-12 pl-0 pr-0">
                                    <div class="card">
                                        <div class="card-header" id="heading-%d">
                                            <h6 style="font-size: 16px;">
                                                <div data-toggle="collapse" data-target="#collapse-%d" aria-expanded="true" aria-controls="collapse-%d">
                                                    %s<i class="fa fa-caret-down"></i>
                                                </div>
                                            </h6>
                                        </div>

                                        <div id="collapse-%d" class="collapse show" aria-labelledby="heading-%d" data-parent="#accordion-%d">
                                            <div class="card-body">
                                                <i class="fa fa-circle-o"></i>&nbsp;&nbsp;%s
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                        
                            $dates = array_keys($course["schedule"]);

                            for($i = 0; $i < count($dates); $i++){
                                $date = $dates[$i];
                                $times = $course["schedule"][$date];

                                foreach($times as $time){
                                    $tmp = str_replace("%d", strval($i), $card);
                                    $tmp = sprintf($tmp, $date, $time);

                                    echo $tmp;
                                }
                            }
                        ?>
                    </div>

                    <div id="tutor-profile" class="container">
                        <div class="row">
                            <h5>Tutor's profile</h5>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-4 mx-auto">
                                <img src="favicon.ico" alt="<?= $tutor["full_name"] ?>">
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-8 mx-auto">
                                <h4><?= $tutor["full_name"] ?></h4>
                                <!-- <p>
                                    <i class="fa fa-birthday-cake" aria-hidden="true"></i>&nbsp;&nbsp;Born on <?= date("d-m-Y", strtotime($tutor["birthday"])) ?>
                                </p> -->
                                <p>
                                    <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;<?= $tutor["phone"] ?>
                                </p>
                                <p><?= str_replace("\n", "<br>", $tutor["description"]) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- section for registration -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 mx-auto">
                    <div id="register-container" class="container rounded">
                        <div class="row">
                            <h4 class="mx-auto">Register now for</h4>
                        </div>
                        <div class="row">
                            <h3 class="mx-auto">
                                <?= number_format($course["course_fee"], 0) ?>
                                <span>Vnd</span>
                            </h3>
                        </div>
                        <div class="row">
                            <button type="button" id="trial-btn" class="btn mx-auto"
                                data-toggle="modal" data-target="#free-trial">
                                Try now for free
                            </button>
                        </div>
                        <div class="row">
                            <button type="button" id="register-btn" class="btn mx-auto"
                                data-toggle="modal" data-target="#register-form">
                                Register now
                            </button>
                        </div>
                    </div>
                    <div id="timeline-container" class="container">
                        <div>
                            <p><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Course's timeline:</p>
                            <ul>
                                <li>Start date: <?= date("d-m-Y", strtotime($course["start_date"])) ?></li>
                                <li>End date: <?= date("d-m-Y", strtotime($course["end_date"])) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                

                <!--registration modal -->
                <div class="modal fade" id="free-trial" tabindex="-1" role="dialog" aria-labelledby="free-trial-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <!-- header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="free-trial-label">Free Trial Registration</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <!-- body -->
                            <div class="modal-body">
                                <div class="container">
                                    <?php
                                        if (!$is_logged_in){
                                            //user not logged in
                                            echo '
                                            <div class="row">
                                                <h5 id="trial-modal-description">Please login to continue</h5>
                                            </div>
                                            <div class="row">
                                                <div id="trial-login-btn" class="col-md-8 col-sm-8 col-8 offset-md-2 offset-sm-2 offset-2">
                                                    <a href="index.php?page=login">
                                                        <button type="button" class="btn">
                                                            Login
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            ';
                                        }else{
                                            echo '
                                            <div class="row">
                                                <h5 id="trial-modal-description">Do you want to register for a free trial?</h5>
                                            </div>
                                            <form action="index.php" method="get">
                                                <div class="row">
                                                    <div id="trial-register-btn" class="col-md-8 col-sm-8 col-8 offset-md-2 offset-sm-2 offset-2">
                                                        <input type="submit" class="btn" value="Yes, sign me up!">
                                                        <input type="hidden" name="page" value="register_success">
                                                    </div>
                                                </div>
                                            </form>
                                            ';
                                        }
                                    ?>
                                </div>>
                            </div>
                            
                            <!-- footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Cancel
                                </button>
                                <a href="<?= $is_logged_in? 'index.php?page=register_success': 'index.php?page=login'?>">
                                    <button id="trial-login-btn-footer" type="button" class="btn btn-primary">
                                        <?= $is_logged_in? 'Register': 'Login'?>
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal fade" id="register-form" tabindex="-1" role="dialog" aria-labelledby="register-form-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <!-- header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="register-form-label">Course Registration</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <!-- body -->
                            <div class="modal-body">
                                <div class="container">
                                    <?php
                                        if (!$is_logged_in){
                                            //user not logged in
                                            echo '
                                            <div class="row">
                                                <h5 id="trial-modal-description">Please login to continue</h5>
                                            </div>
                                            <div class="row">
                                                <div id="trial-login-btn" class="col-md-8 col-sm-8 col-8 offset-md-2 offset-sm-2 offset-2">
                                                    <a href="index.php?page=login">
                                                        <button type="button" class="btn">
                                                            Login
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            ';
                                        }else{
                                            echo '
                                            <div class="row">
                                                <h5 id="trial-modal-description">Do you want to register for this course?</h5>
                                            </div>
                                            <form action="index.php" method="get">
                                                <div class="row">
                                                    <div id="trial-register-btn" class="col-md-8 col-sm-8 col-8 offset-md-2 offset-sm-2 offset-2">
                                                        <input type="submit" class="btn" value="Yes, sign me up!">
                                                        <input type="hidden" name="page" value="register_success">
                                                    </div>
                                                </div>
                                            </form>
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <!-- footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Cancel
                                </button>
                                <a href="<?= $is_logged_in? 'index.php?page=register_success': 'index.php?page=login'?>">
                                    <button id="trial-login-btn-footer" type="button" class="btn btn-primary">
                                        <?= $is_logged_in? 'Register': 'Login'?>
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
        <?php include "footer.php"; ?>

    </body>
</html>