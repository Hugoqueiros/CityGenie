<?php
require '../login/login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    $sql = "SELECT * FROM users WHERE user_phone = '$phone'";
    $result = mysqli_query($conn, $sql);

    echo json_encode($phone);


    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {

        $sql_user = "SELECT user_id FROM users WHERE user_phone = '$phone'";
        $result_user = mysqli_query($conn, $sql_user);
        while ($value_query = mysqli_fetch_assoc($result_user)) {
            $user_id = $value_query["user_id"];
        }

        $points = (int) $amount;
        $partner_id = $_SESSION['partner_id'];

        $sql_user_partner = "INSERT INTO `users_partners_points`(`partner_id`, `user_id`, `given_points`, `cost`) VALUES ('$partner_id','$user_id','$points','$amount')";
        $result_user_partner = mysqli_query($conn, $sql_user_partner);

        $sql_update_user = "UPDATE `users` SET `user_points`= user_points + '$points' WHERE user_id='$user_id'";
        $result_update_user = mysqli_query($conn, $sql_update_user);

        echo json_encode($user_logged = true);
        header('Location: http://citygenie.great-site.net/partner/dashboard.php');
    } else {
        $error = "Your Login Name or Password is invalid";
        header('Location: http://citygenie.great-site.net/partner/');
    }
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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Assign Customer Points</h3>
                            <form action="" method="post">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <span>
                                                <i class="fa fa-mobile" style="margin-right: 9px;"></i>
                                            </span>
                                            <input type="phone" id="phone" name="phone" placeholder="Phone Number" style="border-color:aqua;font-size: medium;">
                                        </div>
                                        <div style="margin-bottom: 5px;margin-top:5px">
                                            <span class="symbol-input100">
                                                <i class="far fa-money-bill-alt fa-1x"></i>
                                            </span>
                                            <input type="phone" id="amount" name="amount" placeholder="Amount" style="border-color:aqua;font-size: medium;">€
                                        </div>
                                        <div>
                                            <button style="color:#fff;background-color: #00bfee; border-color:#00bfee;border-radius:20px; padding: 2px 83px; margin-left:19px">
                                                Enter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="js/waves.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>