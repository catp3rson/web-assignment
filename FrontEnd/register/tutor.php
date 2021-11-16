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


    // $course = array(
    //     "course_code" => 0,
	//     "course_name" => "English course for kids",
	//     "tutor_id" => 1,
	//     "description" => "Best English course for kids. Suitable for kids aged 5 to 10. Interactive lessons, supportive and experienced tutor.\nEarly birds will get a special gift!",
	//     "course_fee" => 5000000,
	//     "schedule" => array(
    //         'Monday'=> ['12:00-14:00'],
    //         'Friday'=> ['12:00-14:00']
    //     ),
	//     "start_date" =>  '2021-10-22',
	//     "end_date"=> '2021-12-22'  
    // );

    // $tutor = array(
    //     "username" => "math123",
    //     "email" => "math123@email.com",
    //     "full_name" => "Nguyen Van A",
    //     "birthday" => '1998-22-10',
    //     "phone"  => "01234567890",              
    //     "description" => "Graduated from the Ho Chi Minh city University of Teachnology. I've been working as an English teacher since graduation.",
    // );
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

        <link rel="stylesheet" type="text/css" href="tutor.css"/>
    </head>


    <body>
        <!-- navigation bar -->
        <nav id="top" class="navbar navbar-expand-lg fixed-top">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-supported-content" aria-controls="navbar-supported-content" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbar-supported-content">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacts</a>
                    </li>
                </ul>
            </div>
        </nav>


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
                                            <h6>
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
                            <button type="button" id="trial-btn" class="btn btn-primary mx-auto">
                                Try now for free
                            </button>
                        </div>
                        <div class="row">
                            <button type="button" id="register-btn" class="btn btn-primary mx-auto">
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
            </div>
        </div>
    </body>
</html>