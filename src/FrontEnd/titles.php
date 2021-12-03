<?php
    $titles = array(
        "home" => "A tutor booking system - EDUBK",
        "courses" => "All courses - EDUBK",
        "map" => "Locations - EDUBK",
        "manage" => "Manage courses - EDUBK",
        "login" => "Sign up and login - EDUBK",
        "map" => "Locations - EDUBK",
        "register_success" => "Thank you - EDUBK",
    );
    if($direct != "tutor") {
        echo "<title>".$titles[$direct]."</title>";
    }
?>