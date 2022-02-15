<?php
include("../db.connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// username and password sent from form 

	$phone = mysqli_real_escape_string($conn, $_POST['phone']);

	$sql = "SELECT * FROM users WHERE user_phone = '$phone'";
	$result = mysqli_query($conn, $sql);


	$count = mysqli_num_rows($result);

	$user_key = md5(microtime() . rand());
	$query_insert = "update users SET user_key='$user_key' WHERE user_phone='$phone'";
	$result_query = mysqli_query($conn, $query_insert);



	while ($value_query = mysqli_fetch_assoc($result)) {
		$user_id = $value_query["user_id"];
		$name = $value_query["user_name"];
		$phone = $value_query["user_phone"];
		$user_points = $value_query["user_points"];
		$user_key = $value_query["user_key"];
	}

	// If result matched $myusername and $mypassword, table row must be 1 row

	if ($count == 1) {
		$user_key = substr(md5(microtime()),rand(0,26),4);
		$query_insert = "update users SET user_key='$user_key' WHERE user_phone='$phone'";
		$result_query = mysqli_query($conn, $query_insert);

		$sql_user = "SELECT * FROM users WHERE user_phone = '$phone'";
		$result_user = mysqli_query($conn, $sql_user);

		while ($value_query = mysqli_fetch_assoc($result_user)) {
			$id = $value_query["user_id"];
			$name = $value_query["user_name"];
			$phone = $value_query["user_phone"];
			$points = $value_query["user_points"];
			$key = $value_query["user_key"];
		}

		$_SESSION['user_id'] = $id;
		$_SESSION['user_name'] = $name;
		$_SESSION['user_points'] = $points;
		$_SESSION['user_phone'] = $phone;
		$_SESSION['user_key'] = $key;

		$id_sms = "ACe478565aeecfc4136f06cb83f47e137e";
		$token = "dded3a6e3bb78c807806caa6f075a563";
		$url = "https://api.twilio.com/2010-04-01/Accounts/$id_sms/SMS/Messages";
		$from = "MG373e8ff33213d53ab7cf37fd19e5832a";
		$to = $phone;
		$body =  $_SESSION['user_key'];
		$data = array(
			'From' => $from,
			'To' => $to,
			'Body' => "Seu código é " . $body,
		);
		$post = http_build_query($data);
		$x = curl_init($url);
		curl_setopt($x, CURLOPT_POST, true);
		curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($x, CURLOPT_USERPWD, "$id_sms:$token");
		curl_setopt($x, CURLOPT_POSTFIELDS, $post);
		$y = curl_exec($x);
		curl_close($x);

		$user_logged = true;
	} else {
		$error = "Your Login Name or Password is invalid";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<!--===============================================================================================-->
</head>

<body>

<?php
if( $user_logged == false) { ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../images/logo_cor_new.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-title">
						Login
					</span>

					<?php
					if (isset($_SESSION['no_result'])) :
					?>
						<div class="notification">
							<p class="data">Incorrect Data</p>
						</div>
					<?php
					endif;
					unset($_SESSION['no_result']);
					?>

					<div class="wrap-input100">
						<input class="input1000" type="phone" id="phone" name="phone" placeholder="Phone number" onkeypress="isInputNumber(event)">
						<script>
							function isInputNumber(input) {
								var char = String.fromCharCode(input.which);
								if (!(/[0-9]/.test(char))) {
									input.preventDefault();
								}
							}
						</script>
						<span class="symbol-input100">
							<i class="fa fa-mobile" aria-hidden="true"></i>
						</span>
					</div>
					<span class="helper-error" id="helper-error-phone"></span>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" >
							Enter
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="../regist/">
							Don't have an account yet? Create your Account now!
							<i aria-hidden="true"></i>
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>
	<?php } else { ?>
		<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login-sms-pic" data-tilt>
					<img src="../images/logo_cor_new.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="login.php" method="post">
					<span class="login100-form-title">
						SMS Code
					</span>

					<?php
					if (isset($_SESSION['no_result'])) :
					?>
						<div class="notification">
							<p class="data">Incorrect Data</p>
						</div>
					<?php
					endif;
					unset($_SESSION['no_result']);
					?>

					<div class="wrap-input100">
						<input class="input1000" type="phone" id="sms" name="sms" placeholder="Insert Here SMS Code">
						<span class="symbol-input100">
							<i class="fa fa-mobile" aria-hidden="true"></i>
						</span>
					</div>
					<span class="helper-error" id="helper-error-phone"></span>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" >
							Enter
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php }?>
						




	<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../js/sweetalert2@11.js"></script>
	<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="../vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="../js/jquery-3.6.0.min.js"></script>
	<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>

</html>