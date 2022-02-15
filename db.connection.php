<?php

$servername = "sql210.epizy.com";
$username = "epiz_30946069";
$password = "wmkSSaGOBAgj0y";
$dbName= "epiz_30946069_main";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>