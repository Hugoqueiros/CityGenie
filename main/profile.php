<?php
require '../login/login.php';


function get_monuments_count()
{
	include '../db.connection.php';
	$user_id = $_SESSION['user_id'];
	$query = "SELECT COUNT(*) AS quantity FROM user_monuments_points WHERE user_id='$user_id'";
	$result = mysqli_query($conn, $query);
	return $result;
}

function classify()
{
	include '../db.connection.php';
	$user_id = $_SESSION['user_id'];
	$query_classification = "SELECT * FROM `users_partners_points` UP, partners P WHERE UP.user_id='$user_id' AND UP.classification IS NULL AND UP.partner_id=P.partner_id";
	$result_classification = mysqli_query($conn, $query_classification);
	return $result_classification;
}


include '../db.connection.php';
$id = $_SESSION['user_id'];
$sql_user = "SELECT * FROM users WHERE user_id = '$id'";
$result_user = mysqli_query($conn, $sql_user);

while ($value_query = mysqli_fetch_assoc($result_user)) {
	$points = $value_query["user_points"];
}
$_SESSION['user_points'] = $points;

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Profile</title>
	<link rel="icon" href="assets/img/logo.png" type="image/x-icon">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
	<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
</head>

<body style="background-color: #f3f5f7">
	<nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav" style="background-color:#f3f5f7">
		<div class="container"><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
			<div class="collapse navbar-collapse" id="navbarResponsive"><img src="assets/img/logo.png" style="width: 270px;margin-top: 12px;border-top-width: 0px;">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item"><a class="nav-link" style="color:black" href="http://citygenie.great-site.net/main/">Home</a></li>
					<li class="nav-item"><a class="nav-link" style="color:black" href="visit.php">Visit</a></li>
					<li class="nav-item"><a class="nav-link" style="color:black" href="prizes.php">Prizes</a></li>
					<li class="nav-item"><a class="nav-link" style="color:black" href="sugestions.php">Our Sugestions</a></li>
					<?php if (isset(($_SESSION['user_name']))) {
					?>
						<li class="nav-item"><a class="nav-link" style="color:black" href="profile.php">Profile</a></li>
						<li class="nav-item"><a class="nav-link" style="color:black" href="http://citygenie.great-site.net/logout.php">Logout</a></li>
					<?php
					} else {
					?>
						<li class="nav-item"><a class="nav-link" style="color:black" href="../login/">Login/Regist</a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container d-flex justify-content-center align-items-center" style="background-color: #f3f5f7">
		<section class="light" style="margin-top: 140px;">
			<?php
			$result = get_monuments_count();
			while ($row = mysqli_fetch_assoc($result)) {
			?>
				<div class="container py-2">
					<article class="postcard light blue col-md-12" style="padding-right: 185px">
						<a class="postcard__img_link" href="#">
							<img class="postcard__img" src="https://www.kindpng.com/picc/m/269-2697881_computer-icons-user-clip-art-transparent-png-icon.png" alt="Image Title" />
						</a>
						<div class="postcard__text t-dark">
							<h1 class="postcard__title blue"><?php echo utf8_encode($_SESSION['user_name']); ?></h1>
							<div class="postcard__bar"></div>
							<div class="postcard__preview-txt">
								<h6 class="mb-0">Points</h6> <span><?php echo utf8_encode($_SESSION['user_points']); ?></span>
								<h6 class="mb-0">Monuments</h6> <span><?php echo utf8_encode($row['quantity']); ?></span>

							</div>
						</div>
				</div>
				</article>
	</div>
<?php } ?>
</section>
</div>

<section class="light" style="margin-top: 30px;">
	<?php $result_classification = classify();
	while ($row = mysqli_fetch_assoc($result_classification)) { ?>
		<div class="container py-2">
			<article class="postcard light blue">
				<a class="postcard__img_link" href="#">
					<img class="postcard__img" src="<?php echo utf8_encode($row['partner_image']); ?>" alt="Image Title" />
				</a>
				<div class="postcard__text t-dark">
					<h1 class="postcard__title blue">Rate your visit to <?php echo utf8_encode($row['partner_name']); ?></h1>
					<div class="postcard__preview-txt">
						<form method="post" id="contact-form">

							<input type="hidden" id="buy_id" name="buy_id" value="<?php echo utf8_encode($row['users_partners_points']); ?>" />
							<input type="hidden" id="partner_id" name="partner_id" value="<?php echo utf8_encode($row['partner_id']); ?>" />

							<div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
							</div>

							<input type="hidden" name="rating">
							<div class="postcard__bar"></div>
							<div>
								<textarea rows="4" cols="100" type="text" id="comments" name="comments" placeholder="Insert your comment here" style="background-color: #DCE2E9;"></textarea>
							</div>

					</div>

					<button class="tag__item play green" style="background-color: #DAE2E9; border:none">
						Send
					</button>

					</form>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
					<script type="text/javascript">
						$(document).ready(function() {
							$('#contact-form').on('submit', function(e) { //Don't foget to change the id form
								$.ajax({
									url: 'classify.php', //===PHP file name====
									data: $(this).serialize(),
									type: 'POST',
									success: function(data) {
										console.log(data);
										//Success Message == 'Title', 'Message body', Last one leave as it is
										swal("Thanks for your sharing", "Message sent!", "success").then(
											function() {
												document.location.reload(true);
											});
									},
									error: function(data) {
										//Error Message == 'Title', 'Message body', Last one leave as it is
										swal("Oops...", "Something went wrong :(", "error");
									}
								});
								e.preventDefault(); //This is to Avoid Page Refresh and Fire the Event "Click"
							});
						});
					</script>
				</div>
		</div>
		</article>
		</div>
	<?php } ?>
</section>
<script>
	$(function() {
		$(".rateyo").rateYo().on("rateyo.change", function(e, data) {
			var rating = data.rating;
			$(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
			$(this).parent().find('.result').text('rating :' + rating);
			$(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
		});
	});
</script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<footer class="new-footer" style="background-color: #f3f5f7">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-lg-8 mx-auto">
				<p class="text-muted copyright">Copyright&nbsp;©&nbsp;CityGenie</p>
			</div>
		</div>
	</div>
</footer>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/clean-blog.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
</body>

</html>