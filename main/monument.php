<?php
require '../login/login.php';
include "../db.connection.php";

if (empty($_GET['monument'])) {
    header('Location: http://citygenie.great-site.net/main/');
} else {
    $monument = $_GET['monument'];
    $query = "select * from monuments where id_mask = '$monument'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($value_query = mysqli_fetch_assoc($result)) {
            $monument_id = $value_query["monument_id"];
            $monument_name = $value_query["monument_name"];
            $monument_image = $value_query["monument_image"];
            $monument_description = $value_query["monument_description"];
            $monument_address = $value_query["monument_address"];
            $monument_points = $value_query["monument_points"];
            $id_mask = $value_query["id_mask"];
        }

        $array[] = array(
            'monument_id' => utf8_encode($monument_id),
            'monument_name' => utf8_encode($monument_name),
            'monument_image' => $monument_image,
            'monument_description' => utf8_encode($monument_description),
            'monument_points' => utf8_encode($monument_points),
            'monument_address' => utf8_encode($monument_address),
            'id_mask' => $id_mask,
        );

?>


        <!DOCTYPE html>
        <html>

        <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <title> <?php echo ($array[0]['monument_name']); ?></title>
            <link rel="icon" href="assets/img/logo.png" type="image/x-icon">
            <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
            <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
            <link rel="stylesheet" href="assets/sweetalert2-11.3.10/package/dist/dist/sweetalert2.min.css">

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

        <body>
            <script>
                src = "assets/sweetalert2-11.3.10/package/dist/dist/sweetalert2.all.min.js"
            </script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <header class="masthead" style="background-image:url('<?php echo ($array[0]['monument_image']) ?>');">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-lg-8 mx-auto position-relative">
                            <div class="post-heading">
                                <h1>
                                    <?php echo ($array[0]['monument_name']);
                                    $id = $array[0]['monument_id'];
                                    $points = $array[0]['monument_points'];
                                    $url = $array[0]['id_mask'];
                                    ?>
                                </h1>
                                <?php if (isset(($_SESSION['user_name']))) {
                                    $user_id = $_SESSION["user_id"];
                                    $query = "select * from user_monuments_points where user_id = '$user_id' AND monument_id= '$monument_id'";
                                    $result = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($result) > 0) { ?>
                                        <button style="background: transparent; border: none;" class="list-inline-item"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-check fa-stack-1x fa-inverse"></i></span> <span style="color:white;">Este monumento já foi visitado</span></button>
                                    <?php } else { ?>
                                        <button type="button" style="background: transparent; border: none;" class="list-inline-item" onclick="reedem_points(<?php echo $id ?>, <?php echo $points ?>)"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-plus-square fa-stack-1x fa-inverse"></i></span> <span style="color:white;">Redimir Pontos</span></button>
                                        <script>
                                            reedem_points = function(id, points) {
                                                var monument_id = id;
                                                var monument_points = points;

                                                $.ajax({
                                                    url: 'http://citygenie.great-site.net/reedem_points.php',
                                                    type: "POST",
                                                    data: {
                                                        monument_id: monument_id,
                                                        monument_points: monument_points,
                                                    }
                                                }).done(function(updated) {
                                                    Swal.fire(
                                                        'Points redeemed successfully!',
                                                        'Let´s go for the next monument',
                                                        'success'
                                                    ).then(
                                                        function() {
                                                            document.location.reload(true);
                                                        })

                                                });
                                            }
                                        </script>
                                    <?php } ?>

                                <?php } else { ?>
                                    <button style="background: transparent; border: none;" class="list-inline-item" onclick="location.href='http://citygenie.great-site.net/login/'"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-sign-in fa-stack-1x fa-inverse"></i></span> <span style="color:white;">Efetuar Login</span></button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <article>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-lg-8 mx-auto" style="color:black">
                            <div id="google_translate_element"></div>



                            <script type="text/javascript">
                                function googleTranslateElementInit() {
                                    new google.translate.TranslateElement({
                                        pageLanguage: ''
                                    }, 'google_translate_element');
                                }
                            </script>



                            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                            <h2 class="section-heading">Description</h2>
                            <p> <?php echo ($array[0]['monument_description']);
                                ?></p>
                            <center><iframe src="<?php echo ($array[0]['monument_address']); ?>" width="auto" height="auto" style="border:0;" allowfullscreen="" loading="lazy"></iframe></center>
                        </div>
                    </div>
                </div>
            </article>
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

<?php
    } else {
        header('Location: https://citygenie.games/main/index.php');
    }
}
?>