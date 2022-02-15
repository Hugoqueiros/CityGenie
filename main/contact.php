<?php
require '../login/login.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
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
    <header class="masthead" style="background-image:url('https://mapadelondres.org/wp-content/uploads/2016/10/Cabine_Fotor.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading">
                        <h1>Contact Me</h1><span class="subheading">Have questions? I have answers.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="col-md-10 col-lg-8 mx-auto">
            <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
            <form id="contactForm" name="sentMessage" novalidate="novalidate">
                <div class="control-group">
                    <div class="form-floating controls mb-3"><input class="form-control" type="text" id="name" required="" placeholder="Name"><label class="form-label" for="name">Name</label><small class="form-text text-danger help-block"></small></div>
                </div>
                <div class="control-group">
                    <div class="form-floating controls mb-3"><input class="form-control" type="email" id="email" required="" placeholder="Email Address"><label class="form-label">Email Address</label><small class="form-text text-danger help-block"></small></div>
                </div>
                <div class="control-group">
                    <div class="form-floating controls mb-3"><input class="form-control" type="tel" id="phone" required="" placeholder="Phone Number"><label class="form-label">Phone Number</label><small class="form-text text-danger help-block"></small></div>
                </div>
                <div class="control-group">
                    <div class="form-floating controls mb-3"><textarea class="form-control" id="message" data-validation-required-message="Please enter a message." required="" placeholder="Message" style="height: 150px;"></textarea><label class="form-label">Message</label><small class="form-text text-danger help-block"></small></div>
                </div>
                <div id="success"></div>
                <div class="mb-3"><button class="btn btn-primary" id="sendMessageButton" type="submit">Send</button></div>
            </form>
        </div>
    </div>
    </div>
    <hr>
    <footer>
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
</body>

</html>