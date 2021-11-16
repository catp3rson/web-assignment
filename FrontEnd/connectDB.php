<?php
    $servername = "localhost";
    $username = "root";
    $password = "an0kumene";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS LOCATIONDB;";
    $conn->query($sql);
    $conn = new mysqli($servername, $username, $password, 'LOCATIONDB'); 
?>