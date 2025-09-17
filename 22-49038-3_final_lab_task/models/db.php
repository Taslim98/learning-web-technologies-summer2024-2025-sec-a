<?php
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "job_portal"; // or job_portal

function getConnection() {
    global $host, $dbuser, $dbpass, $dbname;
    $con = mysqli_connect($host, $dbuser, $dbpass, $dbname);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>