<?php
require '../login/login.php';
include '../db.connection.php';
function get_monuments()
{
	include '../db.connection.php';
	$query = "select * from monuments";
	$result = mysqli_query($conn, $query);
	return $result;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Visit</title>
	<link rel="icon" href="assets/img/logo.png" type="image/x-icon">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
	<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="../css/util.css">
	<style>
		.goog-te-banner-frame.skiptranslate {
			display: none !important;
			display: 0px !important;
		}

		body {
			top: 0px !important;
		}
	</style>
</head>

<body style="background-color: #f3f5f7">
	<nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
		<div class="container"><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
			<div class="collapse navbar-collapse" id="navbarResponsive"><img src="assets/img/logo.png" style="width: 270px;margin-top: 12px;border-top-width: 0px;">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item"><a class="nav-link" href="http://citygenie.great-site.net/main/">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="visit.php">Visit</a></li>
					<li class="nav-item"><a class="nav-link" href="prizes.php">Prizes</a></li>
					<li class="nav-item"><a class="nav-link" href="sugestions.php">Our Sugestions</a></li>
					<?php if (isset(($_SESSION['user_name']))) {
					?>
						<li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
						<li class="nav-item"><a class="nav-link" href="http://citygenie.great-site.net/logout.php">Logout</a></li>
					<?php
					} else {
					?>
						<li class="nav-item"><a class="nav-link" href="../login/">Login/Regist</a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
	<header class="masthead" style="background-image:url('assets/img/ribeira-do-porto.png');">
		<div class="overlay"></div>
		<div class="container">
			<center>
				<div class="col-md-10 col-lg-8 mx-auto position-relative">
					<div class="site-heading">
						<h1>Visit Places!</h1><span class="subheading">Win Prizes while you visit</span>
					</div>
				</div>
			</center>
		</div>
	</header>
	<div class="container">
		<center>
			<div class="col-md-6 text-center mb-4">
				<h2 class="heading-section">Places to Visit</h2>
			</div>
		</center>
		<div id="google_translate_element"></div>



		<script type="text/javascript">
			function googleTranslateElementInit() {
				new google.translate.TranslateElement({
					pageLanguage: ''
				}, 'google_translate_element');
			}
		</script>



		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<div>
			<table class="table">
				<thead class="thead-primary">
					<tr>
						<th>&nbsp;</th>
						<th>Name</th>
						<th style="text-align: center;">Points by Visiting</th>
						<th style="text-align: center;">Already visited?</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$result = get_monuments();
					while ($row = mysqli_fetch_assoc($result)) {
					?>
						<tr class="alert" role="alert">
							<td>
								<div class="img" style="background-image:url('<?php echo ($row['monument_image']) ?>')"></div>
							</td>
							<td>
								<div class="email">
									<span><?php echo utf8_encode($row['monument_name']); ?> </span>
									<span>Porto</span>
								</div>
							</td>
							<td style="text-align: center;"><?php echo utf8_encode($row['monument_points']); ?></td>
							<?php if (isset($_SESSION['user_name'])) {
								$user_id = $_SESSION['user_id'];
								$monument_id = utf8_encode($row['monument_id']);
								$query_verified = "select * from user_monuments_points WHERE user_id='$user_id' AND monument_id='$monument_id'";
								$result_verified = mysqli_query($conn, $query_verified);
								$count = mysqli_num_rows($result_verified);
								if ($count == 1) {
							?>
									<td class="text-success" style="font-weight: bold;text-align: center;">
										✓
									</td>
								<?php
								} else {
								?>
									<td class="text-danger" style="font-weight: bold;text-align: center;">
										X
									</td>
							<?php
								}
							}
							?>
						</tr>
					<?php }
					?>

				</tbody>
			</table>
		</div>
	</div>
	<footer>
		<div class="container">
			<center>
				<p class="text-muted copyright">Copyright&nbsp;©&nbsp;CityGenie</p>
			</center>
		</div>
	</footer>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/clean-blog.js"></script>
</body>

</html>