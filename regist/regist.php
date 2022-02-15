<?php
session_start();

$function = $_GET['f'];
if (function_exists($function)) {
	call_user_func($function);
}

function regist_user()
{
	include "../db.connection.php";



	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$user_registed = false;
		if (isset($_POST['phone']) && isset($_POST['name'])) {
			$phone = $_POST['phone'];
			$name = $_POST['name'];
			$name = utf8_decode($name);
			$query = "select * from users where user_phone = '$phone'";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) > 0) {
				$user_registed = true;
				echo json_encode($user_registed);
			} else {
				$query = "insert into users (user_name, user_phone, user_points) VALUES ('$name','$phone','0')";
				$result = mysqli_query($conn, $query);
				echo json_encode($user_registed);
			}
		}
	}
}
