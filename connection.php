<?php

// Database connection details
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "register";

// Create connection
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    // Display a detailed error message if connection fails
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}



?>
