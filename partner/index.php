<?php
include("../db.connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// username and password sent from form 

	$partnerid = mysqli_real_escape_string($conn, $_POST['partnerid']);
    $partnerpw = mysqli_real_escape_string($conn, $_POST['partnerpw']);

	$sql = "SELECT * FROM partners WHERE partner_id = '$partnerid' AND partner_pw = '$partnerpw'";
	$result = mysqli_query($conn, $sql);


	$count = mysqli_num_rows($result);

    echo $sql;

	// If result matched $myusername and $mypassword, table row must be 1 row

	if ($count == 1) {

        $sql_user = "SELECT * FROM partners WHERE partner_id = '$partnerid'";
		$result_user = mysqli_query($conn, $sql_user);

		while ($value_query = mysqli_fetch_assoc($result_user)) {
			$id = $value_query["partner_id"];
			$name = $value_query["partner_name"];
		}

		$_SESSION['partner_id'] = $id;
		$_SESSION['partner_name'] = $name;
		echo json_encode($user_logged = true);
        header('Location: http://citygenie.great-site.net/partner/dashboard.php');
	} else {
		$error = "Your Login Name or Password is invalid";
        header('Location: http://citygenie.great-site.net/partner/');
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Partner</title>
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

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../images/logo_cor_new.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-title">
						Login Partner
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
						<input class="input1000" type="phone" id="partnerid" name="partnerid" placeholder="Partner ID" onkeypress="isInputNumber(event)">
						<script>
							function isInputNumber(input) {
								var char = String.fromCharCode(input.which);
								if (!(/[0-9]/.test(char))) {
									input.preventDefault();
								}
							}
						</script>
						<span class="symbol-input100">
							<i class="fa fa-id-badge" aria-hidden="true"></i>
						</span>
					</div>
                    <div class="wrap-input100">
						<input class="input1000" type="password" id="partnerpw" name="partnerpw" placeholder="Password">
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
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