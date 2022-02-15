<?php
include '../db.connection.php';
require '../login/login.php';
session_start();

include("../db.connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "UPDATE `users_partners_points` SET `classification`='$rating',`comments`='$comments' WHERE partner_id='$partner_id' AND user_id='$user_id'";
    $result = mysqli_query($conn, $sql);

	if ($result)
    {
        echo "New Rate addedddd successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
