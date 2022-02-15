<?php
session_start();

include("../db.connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// username and password sent from form 

	$phone = $_SESSION['user_phone'];
	$sms = mysqli_real_escape_string($conn, $_POST['sms']);

	$sql = "SELECT * FROM users WHERE user_phone = '$phone' AND user_key = '$sms'";
	$result = mysqli_query($conn, $sql);

	$count = mysqli_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row

	if ($count == 1) {
		header('Location: http://citygenie.great-site.net/main/');
		echo json_encode($user_logged = false);
	} else {
		header('Location: https://http://citygenie.great-site.net/login/');
		$error = "Your Login Name or Password is invalid";
	}
}
?>
