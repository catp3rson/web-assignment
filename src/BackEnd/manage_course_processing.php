<?php
    require_once dirname(__FILE__) . '/config.php';

    $add_successful = false;
    $remove_successful = false;

    if(isset($_POST["action"])) {
        if($_POST["action"] == "add") {
            $can_query = false;
            $course_schedule = '{';
            if(isset($_POST['monday'])) { $can_query = true; $course_schedule = $course_schedule . '"Monday": ["' . $_POST['course_schedule_monday'] . '-' . $_POST['course_schedule_monday2'] . '"], '; }
            if(isset($_POST['tuesday'])) { $can_query = true; $course_schedule = $course_schedule . '"Tuesday": ["' . $_POST['course_schedule_tuesday'] . '-' . $_POST['course_schedule_tuesday2'] . '"], '; }
            if(isset($_POST['wednesday'])) { $can_query = true; $course_schedule = $course_schedule . '"Wednesday": ["' . $_POST['course_schedule_wednesday'] . '-' . $_POST['course_schedule_wednesday2'] . '"], '; }
            if(isset($_POST['thursday'])) { $can_query = true; $course_schedule = $course_schedule . '"Thursday": ["' . $_POST['course_schedule_thursday'] . '-' . $_POST['course_schedule_thursday2'] . '"], '; }
            if(isset($_POST['friday'])) { $can_query = true; $course_schedule = $course_schedule . '"Friday": ["' . $_POST['course_schedule_friday'] . '-' . $_POST['course_schedule_friday2'] . '"], '; }
            if(isset($_POST['saturday'])) { $can_query = true; $course_schedule = $course_schedule . '"Saturday": ["' . $_POST['course_schedule_saturday'] . '-' . $_POST['course_schedule_saturday2'] . '"], '; }
            if(isset($_POST['sunday'])) { $can_query = true; $course_schedule = $course_schedule . '"Sunday": ["' . $_POST['course_schedule_sunday'] . '-' . $_POST['course_schedule_sunday2'] . '"], '; }
            if($can_query) {
                $course_schedule = substr($course_schedule, 0, -2) . '}';
                $course_schedule = mysqli_real_escape_string($conn, $course_schedule);
                $sql = "INSERT INTO courses (`course_code`, `course_name`, `course_category`, `tutor_id`, `brief`, `description`, `course_fee`, `schedule`, `start_date`, `end_date`) VALUES
                ('".$_POST['course_code']."', '".$_POST['course_name']."', '".$_POST['category']."', ".$_POST['tutor_id'].", '".$_POST['course_brief']."', '".$_POST['course_description']."', ".$_POST['course_fee'].", '$course_schedule', '".$_POST['start_date']."', '".$_POST['end_date']."');";
                $add_successful = true;
                if (!$result = $conn->query($sql)) {
                    $add_successful = false;
                }
            }
            else {
                echo("Can't query");
            }
        }
        else if($_POST["action"] == "remove") {
            $code = mysqli_real_escape_string($conn, $_POST["code"]);
            $sql = "DELETE FROM courses WHERE course_code = '$code';";
            $remove_successful = true;
            if (!$result = $conn->query($sql)) {
                $remove_successful = false;
            }
        }
    }
?>