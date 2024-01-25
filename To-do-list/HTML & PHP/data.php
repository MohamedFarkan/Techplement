<?php
$hostname = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "to-do-list";
$conn = mysqli_connect($hostname, $dbuser, $dbpassword, $dbname);
if (!$conn) {
    die("Something went wrong");
} else {
}
