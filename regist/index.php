<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../images/logo_cor_new.png" alt="IMG">
				</div>

				<form class="login100-form validate-form">
					<span class="login100-form-title">
						Sign Up
					</span>


					<div class="wrap-input100 validate-input" data-validate="You must submit your name">
						<input class="input100" type="string" id="name" placeholder="Name" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' maxlength="18">
						<script>
							function isInputLetter(input) {
								var char = String.fromCharCode(input.which);
								if (!(/[a-z]/.test(char)) && !(/[A-Z]/.test(char))) {
									input.preventDefault();
								}
							}
						</script>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<span class="helper-error" id="helper-error-name"></span>

					<div class="wrap-input100">
						<input class="input100" type="phone" id="phone" placeholder="Phone number" onkeypress="isInputNumber(event)">
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
						<button class="login100-form-btn" onclick="regist_user();" type="button">
							Enter
						</button>
						<script>
							function regist_user() {
								var phone = $('#phone').val();
								var name = $('#name').val();
								var live = "http://citygenie.great-site.net/regist/regist.php?f=regist_user";
								var submit = true;

								if (phone == '') {
									$('#helper-error-phone').text('*Required Field');
									submit = false;
								} else {
									$('#helper-error-phone').text('');
								}

								if (name == '') {
									$('#helper-error-name').text('*Required Field');
									submit = false;
								} else {
									$('#helper-error-name').text('');
								}

								if (submit == true) {

									$.ajax({
										url: 'http://citygenie.great-site.net/regist/regist.php?f=regist_user',
										type: "POST",
										data: {
											phone: phone,
											name: name,
										}
									}).done(function(updated) {
										if (updated == "false") {
											toastr.options = {
												"closeButton": false,
												"debug": false,
												"newestOnTop": false,
												"progressBar": false,
												"positionClass": "toast-bottom-center",
												"preventDuplicates": false,
												"onclick": null,
												"showDuration": "300",
												"hideDuration": "1000",
												"timeOut": "100000000000000000000",
												"extendedTimeOut": "1000",
												"showEasing": "swing",
												"hideEasing": "linear",
												"showMethod": "fadeIn",
												"hideMethod": "fadeOut",
												"tapToDismiss": false
											}
											toastr["success"]("<a href='http://citygenie.great-site.net/login/'>Click Here to Sign In Now</a>", "Successfully registered")

											
										} else if(updated == "true") {
											toastr.options = {
												"closeButton": false,
												"debug": false,
												"newestOnTop": false,
												"progressBar": false,
												"positionClass": "toast-bottom-center",
												"preventDuplicates": false,
												"onclick": null,
												"showDuration": "300",
												"hideDuration": "1000",
												"timeOut": "5000",
												"extendedTimeOut": "1000",
												"showEasing": "swing",
												"hideEasing": "linear",
												"showMethod": "fadeIn",
												"hideMethod": "fadeOut"
											}
											toastr["error"]("Already existing user with this number")
										}

									});
								}
							}
						</script>
					</div>


					<div class="text-center p-t-136">
						<a class="txt2" href="http://citygenie.great-site.net/login/">
							Already have an account? Login now!
							<i aria-hidden="true"></i>
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
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
	<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>

</html>