<?php
    require_once dirname(__FILE__) . '/../BackEnd/config.php';
    echo($ROOT_URL);
    session_start();
    session_unset();
    session_destroy();
    header("Location: " . $ROOT_URL . "index.php?page=home");
?>