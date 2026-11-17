<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "sql1.njit.edu";
$username = "ks2334";
$password = "YOUR MYSQL PASSWORD";
$dbname = "ks2334";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>