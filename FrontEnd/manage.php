<?php
    if($_SESSION["role"] != 0) {
        die("Wrong role!");
    }
    if(isset($_GET["action"]) or isset($_POST["action"])) {
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
                $sql = "INSERT INTO tutor_booking_system.courses (`course_code`, `course_name`, `course_category`, `tutor_id`, `brief`, `description`, `course_fee`, `schedule`, `start_date`, `end_date`) VALUES
                ('".$_POST['course_code']."', '".$_POST['course_name']."', '".$_POST['category']."', ".$_POST['tutor_id'].", '".$_POST['course_brief']."', '".$_POST['course_description']."', ".$_POST['course_fee'].", '$course_schedule', '".$_POST['start_date']."', '".$_POST['end_date']."');";
                if (!$result = $conn->query($sql)) {
                    echo("Error description: " . $result -> error);
                }
            }
            else {
                echo("Can't query");
            }
        }
        else if($_GET["action"] == "remove") {
            $code = $_GET["code"];
            $sql = "DELETE FROM tutor_booking_system.courses WHERE course_code = '$code';";
            $result = $conn->query($sql);
            if (!$result = $conn->query($sql)) {
                echo("Error description: " . $result -> error);
            }
        }
        else {
            die("Invalid action");
        }
        echo "<script>window.history.pushState('', '', 'index.php?page=manage');</script>";
    }
?>
<div class="body">
    <h1 style="font-size: 50px; text-align: center">Manage courses</h1>
    <hr style="width: 80%; margin: 20px auto;">
    <table id="table">
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>Tutor ID</th>
            <th>Remove</th>
        </tr>
        <?php
            $sql = "SELECT course_code, course_name, course_category, tutor_id, course_fee FROM tutor_booking_system.courses;";
            $result = $conn->query($sql);
            if (!$result = $conn->query($sql)) {
                echo("Error description: " . $result -> error);
            }
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>".$row['course_code']."</td>
                            <td>".$row['course_name']."</td>
                            <td>".$row['course_category']."</td>
                            <td>".$row['tutor_id']."</td>
                            ";
                            echo "<td><button><a class='no-style-hyperlink' href='index.php?page=manage&code=".$row['course_code']."&action=remove'>
                            Remove</a></button></td>";
                        echo "</tr>
                    ";
                }
            }
        ?>
    </table>
    <h1 style="font-size: 50px; text-align: center">Add courses</h1>
    <hr style="width: 80%; margin: 20px auto;">
    <div class="container manage-form">
        <form action="index.php" method="post">
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_code">Course code</label>
                </div>
                <div class="col-75 manage-form">
                    <input class="manage-form" type="text" id="course_code" name="course_code" placeholder="Course code..." required>
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_code">Course name</label>
                </div>
                <div class="col-75 manage-form">
                    <input class="manage-form" type="text" id="course_name" name="course_name" placeholder="Course name..." required>
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="category">Category</label>
                </div>
                <div class="col-75 manage-form">
                    <select class="manage-form" id="category" name="category">
                        <option class="manage-form" value="math">Math</option>
                        <option class="manage-form" value="physics">Physics</option>
                        <option class="manage-form" value="chemistry">Chemistry</option>
                        <option class="manage-form" value="biology">Biology</option>
                        <option class="manage-form" value="english">English</option>
                    </select>
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="tutor_id">Tutor ID</label>
                </div>
                <div class="col-75 manage-form">
                    <input class="manage-form" type="number" id="tutor_id" name="tutor_id" placeholder="Tutor ID..." required>
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_brief">Course brief</label>
                </div>
                <div class="col-75 manage-form">
                    <textarea class="manage-form" id="course_brief" name="course_brief" placeholder="Course brief..." style="height:50px" required></textarea>
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_description">Course description</label>
                </div>
                <div class="col-75 manage-form">
                    <textarea class="manage-form" id="course_description" name="course_description" placeholder="Course description..." style="height:200px" required></textarea>
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_fee">Course fee (VND)</label>
                </div>
                <div class="col-75 manage-form">
                    <input class="manage-form" type="number" id="course_fee" name="course_fee" placeholder="Course fee..." required>
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_schedule">Course schedule</label>
                </div>
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_schedule_monday">Monday</label>
                    <input type="checkbox" id="monday" name="monday" style="margin-top: 18px;">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_monday" name="course_schedule_monday">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_monday2" name="course_schedule_monday2">
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                </div>
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_schedule_tuesday">Tuesday</label>
                    <input type="checkbox" id="tuesday" name="tuesday" style="margin-top: 18px;">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_tuesday" name="course_schedule_tuesday">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_tuesday2" name="course_schedule_tuesday2">
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                </div>
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_schedule_wednesday">Wednesday</label>
                    <input type="checkbox" id="wednesday" name="wednesday" style="margin-top: 18px;">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_wednesday" name="course_schedule_wednesday">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_wednesday2" name="course_schedule_wednesday2">
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                </div>
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_schedule_thursday">Thursday</label>
                    <input type="checkbox" id="thursday" name="thursday" style="margin-top: 18px;">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_thursday" name="course_schedule_thursday">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_thursday2" name="course_schedule_thursday2">
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                </div>
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_schedule_friday">Friday</label>
                    <input type="checkbox" id="friday" name="friday" style="margin-top: 18px;">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_friday" name="course_schedule_friday">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_friday2" name="course_schedule_friday2">
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                </div>
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_schedule_saturday">Saturday</label>
                    <input type="checkbox" id="saturday" name="saturday" style="margin-top: 18px;">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_saturday" name="course_schedule_saturday">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_saturday2" name="course_schedule_saturday2">
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                </div>
                <div class="col-25 manage-form">
                    <label class="manage-form" for="course_schedule_sunday">Sunday</label>
                    <input type="checkbox" id="sunday" name="sunday" style="margin-top: 18px;">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_sunday" name="course_schedule_sunday">
                </div>
                <div class="col-25 manage-form">
                    <input class="manage-form" type="time" id="course_schedule_sunday2" name="course_schedule_sunday2">
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="start_date">Start date</label>
                </div>
                <div class="col-75 manage-form">
                    <input class="manage-form" type="date" id="start_date" name="start_date" required>
                </div>
            </div>
            <div class="row manage-form">
                <div class="col-25 manage-form">
                    <label class="manage-form" for="end_date">End date</label>
                </div>
                <div class="col-75 manage-form">
                    <input class="manage-form" type="date" id="end_date" name="end_date" required>
                </div>
            </div>
            <input class="manage-form" type="hidden" id="page" name="page" value="manage">
            <input class="manage-form" type="hidden" id="action" name="action" value="add">
            <div class="row manage-form">
                <input class="manage-form" type="submit" value="Add new course">
            </div>
        </form>
    </div>
</div>