<?php
require '../login/login.php';
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home</title>
    <link rel="icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
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
    <header class="masthead" style="background-image:url('assets/img/background.png');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading">
                        <h1>Explore now!</h1><span class="subheading">Play and find city&nbsp;knowledge</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8">
                <div id="google_translate_element"></div>



                <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({
                            pageLanguage: ''
                        }, 'google_translate_element');
                    }
                </script>



                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                <div class="post-preview"><a href="contact.php">
                        <h2 class="post-title"><strong>Want to become our partner?</strong></h2>
                        <h3 class="post-subtitle">Empower your business with our game experience,&nbsp;and gain new visitors every day</h3>
                    </a>
                    <p class="post-meta">Contact us -&nbsp;<a href="malito:help@citygenie.games">help@citygenie.games</a></p>
                </div>
                <hr>
                <div class="post-preview"><a href="prizes.php">
                        <h2 class="post-title"><strong>Prize of the month</strong></h2>
                        <h3 class="post-subtitle">For our launch month we are offering a iPhone X!</h3>
                    </a></div>
                <hr>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
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