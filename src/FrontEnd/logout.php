<?php
    require dirname(__FILE__) . '/../BackEnd/config.php';

    session_start();
    session_unset();
    session_destroy();
    header("Location: " . $ROOT_URL . "index.php?page=home");
?>