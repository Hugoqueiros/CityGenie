<?php
require '../login/login.php';
include '../db.connection.php';


function get_sugestions()
{
	include '../db.connection.php';
	$query = "select * from partners";
	$result = mysqli_query($conn, $query);
	return $result;
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Sugestions</title>
	<link rel="icon" href="assets/img/logo.png" type="image/x-icon">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
	<header class="masthead" style="background-image:url('https://media.timeout.com/images/103750976/1024/576/image.jpg');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-lg-8 mx-auto position-relative">
					<div class="site-heading">
						<h1>See our Sugestions</h1><span class="subheading">Check our partners</span>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="filter" id="filters">
		<h8>Select:</h8>
		<select name="fetchval" id="fetchval">
			<option value="ALL" selected="">All</option>
			<option value="REST">Restaurants</option>
			<option value="HOTEL">Hotels</option>
			<option value="AT">Ativities</option>
		</select>
	</div>
	<script>
		$(document).ready(function() {
			$("#fetchval").on('change', function() {
				var value = $(this).val();
				$.ajax({
					url: "fetch.php",
					type: "POST",
					data: 'request= ' + value,
					beforeSend: function() {
						$("#container-plus").html("<span>Working</span>");
					},
					success: function(data) {
						$(".container-plus").html(data);
					}
				})
			})
		})
	</script>
	<div class="container-plus">
		<div class="row">
			<?php $result = get_sugestions();
			while ($row = mysqli_fetch_assoc($result)) { ?>
				<div class="col-sm-3" style="margin-top: 20px;">
					<div class="card text-center" style="background-color: #CEDCE6; height: 325px;">
						<img class="card-img-top img-fluid" src="<?php echo utf8_encode($row['partner_image']); ?>" alt="Card image cap">
						<div class="card-block">
							<h6 class="card-title" style="margin-top: 5px;color:black"><?php echo utf8_encode($row['partner_name']); ?> </h6>
							<p class="card-text" style="color:black; margin-top:-1px"><?php echo utf8_encode($row['partner_address']); ?></p>
							<p class="card-text" style="color:black;margin-top: -15px;"><small><?php echo utf8_encode($row['partner_description']); ?></small></p>
							<p class="card-text" style="color: black;position: absolute;bottom: -16px;left: 0px;"><small><?php echo utf8_encode($row['partner_email']); ?></small></p>
							<?php if ($row['classification'] != "") { ?>
								<p class="card-text" style="color:yellow;position: absolute;bottom: 3px;right: 0px;"><small style="color:black;;text-align: -webkit-right;display: inline-flex;"><?php echo utf8_encode($row['classification']); ?></small>★</p>
							<?php } ?>
						</div>
					</div>
				</div>




			<?php } ?>
		</div>
	</div>
	<footer>
		<div class="container">
			<div class="row">

			</div>
		</div>
	</footer>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/clean-blog.js"></script>
</body>

</html>