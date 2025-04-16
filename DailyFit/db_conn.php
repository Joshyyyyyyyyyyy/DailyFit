<?php
$host = "localhost";
$user = "root";
$pass = ""; // change to your MySQL password if needed
$db = "DailyFit";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
