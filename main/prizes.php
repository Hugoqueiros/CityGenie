<?php
require '../login/login.php';
include '../db.connection.php';


function get_prizes()
{
	include '../db.connection.php';
	$query = "select * from prizes where prize_stock > 0";
	$result = mysqli_query($conn, $query);
	return $result;
}

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '$id'";
$result = mysqli_query($conn, $sql);


$count = mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if ($count == 1) {
	while ($value_query = mysqli_fetch_assoc($result)) {
		$id = $value_query["user_id"];
		$name = $value_query["user_name"];
		$phone = $value_query["user_phone"];
		$points = $value_query["user_points"];
	}
	$_SESSION['user_id'] = $id;
	$_SESSION['user_name'] = $name;
	$_SESSION['user_points'] = $points;
	$_SESSION['user_phone'] = $phone;
}

?>
<!DOCTYPE html>
<html>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Prizes</title>
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
	<header class="masthead" style="background-image:url('assets/img/coins.png');">
		<div class="overlay"></div>
		<div class="container">
			<center>
				<div class="col-md-10 col-lg-8 mx-auto position-relative">
					<div class="site-heading">
						<h1>Win Prizes!</h1><span class="subheading">Check the Prizes you can win</span>
					</div>
				</div>
			</center>
		</div>
	</header>
	<div class="container">
		<center>
			<h2 class="heading-section">Prizes</h2>
		</center>
		<div class="row justify-content-center">
			<div class="col-md-6 text-center mb-4">
			</div>
		</div>
		<div class="row">
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
				<div>
					<table class="table">
						<thead class="thead-primary">
							<tr>
								<th>&nbsp;</th>
								<th>Name</th>
								<th>Points</th>
								<th>Stock</th>
								<th>&nbsp</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$result = get_prizes();
							while ($row = mysqli_fetch_assoc($result)) {
							?>
								<tr class="alert" role="alert">
									<td>
										<div class="img" style="background-image:url('<?php echo ($row['prize_images']) ?>')"></div>
									</td>
									<td>
										<div class="email">
											<span><?php echo utf8_encode($row['prize_name']); ?> </span>
											<span><?php echo utf8_encode($row['prize_description']); ?></span>
										</div>
									</td>
									<td name="points"><?php echo utf8_encode($row['prize_points']); ?></td>
									<td><?php echo utf8_encode($row['prize_stock']); ?></td>
									<?php if (isset($_SESSION['user_name'])) {
										$prize_id = utf8_encode($row['prize_id']);
										$prize_points = utf8_encode($row['prize_points']);
										$user_points = $_SESSION['user_points'];
										if ($user_points < $prize_points) {
									?>
											<td>
												<?php
												$remaining_points = ($_SESSION['user_points'] / ($row['prize_points'])) * 100;
												$missing_points = $row['prize_points'] - $_SESSION['user_points'];
												?>
												<p style="text-align: center;">Necessita de mais <?php echo $missing_points ?> pontos</p>
												<div class="progress blue">
													<div class="progress-bar" style="width:<?php echo $remaining_points ?>%;  background-color:#0D47A1;">
													</div>
												</div>
											</td>
										<?php
										} else if ($user_points >= $prize_points) {
										?>
											<td>
												<button type="button" class="close" onclick="take_points(<?php echo $prize_id ?>);"></a> Redimir Prémio
												</button>
												<script>
													take_points = function(points) {
														var prize_id = points;
														$.ajax({
															url: 'http://citygenie.great-site.net/take_points.php',
															type: "POST",
															data: {
																prize_id: prize_id
															}
														}).done(function(updated) {
															Swal.fire(
																'Prize redeemed successfully!',
																'We will contact you shortly',
																'success'
															).then(
																function() {
																	document.location.reload(true);
																})

														});
													}
												</script>
											</td>


										<?php
										}
									} else {
										?>
										<td>
											<button type="button" class="close" onclick="window.location.href='../login/'"> Efetuar Login
											</button>
										</td>
									<?php
									}
									?>
								</tr>
							<?php }
							?>

						</tbody>
					</table>
				</div>
			</div>
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