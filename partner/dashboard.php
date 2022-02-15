<?php
require '../login/login.php';

function get_visit()
{
    include("../db.connection.php");

    $partner_id = $_SESSION['partner_id'];
    $sql = "SELECT * FROM `users_partners_points` WHERE partner_id='$partner_id'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}

function total_earned()
{
    include("../db.connection.php");

    $partner_id = $_SESSION['partner_id'];
    $sql = "SELECT SUM(cost) AS Total FROM users_partners_points WHERE partner_id='$partner_id'";
    $result = mysqli_query($conn, $sql);
    while ($value_query = mysqli_fetch_assoc($result)) {
        $total = $value_query["Total"];
    }
    return $total;
}

function citygenie_fee()
{
    include("../db.connection.php");

    $partner_id = $_SESSION['partner_id'];
    $sql = "SELECT SUM(cost) AS Total FROM users_partners_points WHERE partner_id='$partner_id'";
    $result = mysqli_query($conn, $sql);
    while ($value_query = mysqli_fetch_assoc($result)) {
        $total = $value_query["Total"];
    }
    $b = 0.05;
    $fee = $total * $b;
    $fee = number_format($fee, 2);
    return $fee;
}

function get_comments()
{
    include("../db.connection.php");

    $partner_id = $_SESSION['partner_id'];
    $sql = "SELECT * FROM users_partners_points UP, users U WHERE partner_id='$partner_id' AND classification IS NOT NULL AND UP.user_id=U.user_id ORDER BY users_partners_points DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);
    return $result;
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Partner Dashboard</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="dashboard.html">
                        <b class="logo-icon">
                            <img src="../images/logo_cor_new.png" style="    vertical-align: middle; width: 163px; margin-left: 20px; margin-top: 15px;" alt="homepage" />
                        </b>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li>
                            <a class="profile-pic" href="#">
                                <span class="text-white font-medium"><?php echo utf8_decode($_SESSION['partner_name']) ?></span>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php" aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="customer.php" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Customer Area</span>
                            </a>
                        </li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="http://citygenie.great-site.net/partner/logout.php" class="btn d-grid btn-danger text-white">
                                Logout</a>
                        </li>
                    </ul>

                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Visit</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div class="fa fa-eye fa-2x" style="color:#7ace4c; margin-left:7px;">
                                    </div>
                                </li>
                                <?php $count = get_visit() ?>
                                <li class="ms-auto"><span class="counter text-success"><?php echo $count ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Earned</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div class="fa fa-credit-card fa-2x" style="color:#707cd2; margin-left:7px;">
                                    </div>
                                </li>
                                <?php $total = total_earned() ?>
                                <li class="ms-auto"><span class="counter text-purple"><?php echo $total ?> €</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">CityGenie Fee</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div class="fa fa-handshake fa-2x" style="color:#2cabe3;margin-left:7px;">
                                    </div>
                                </li>
                                <?php $fee = citygenie_fee() ?>
                                <li class="ms-auto"><span class="counter text-info"><?php echo $fee ?> €</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- .col -->
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="card white-box p-0">
                            <div class="card-body">
                                <h3 class="box-title mb-0">Recent Comments</h3>
                            </div>
                            <?php
                            $result = get_comments();
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <div class="comment-widgets">
                                    <div class="d-flex flex-row comment-row p-3 mt-0">
                                        <div class="comment-text ps-2 ps-md-3 w-100">
                                            <h5 class="font-medium"><?php echo utf8_encode($row['user_name']); ?></h5>
                                            <span class="mb-3 d-block">Classification given by the user: <?php echo utf8_encode($row['classification']); ?> <a style="color:yellow">★</a></span>
                                            <?php if($row['comments'] != ""){?>
                                            <span class="mb-3 d-block"><?php echo utf8_encode($row['comments']); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                </div>
                        </div>
                    </div>

                    <!-- /.col -->
                </div>
            </div>
        </div>
    </div>
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="js/waves.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/custom.js"></script>
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
</body>

</html>