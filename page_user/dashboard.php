<?php 
require_once 'authuser.php';
include 'idleTimer.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets_main/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Welcome</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets_main/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Animation library for notifications   -->
    <link href="../assets_main/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets_main/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets_main/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="../assets_main/fonts/font-awesome.min.css" rel="stylesheet">
    <link href='../assets_main/fonts/css.css' rel='stylesheet' type='text/css'>
    <link href="../assets_main/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="../assets_main/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Welcome
                </a>
<!--                <img src="assets_main/img/logo.png">-->
            </div>
            <nav class="main-nav">
            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                        
            </ul>
            </nav>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">                   

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="user.php">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>Action
                                        <b class="caret"></b>
                                    </p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="../logout.php"><span class="pe-7s-next-2"></span> Log Out</a></li>
                              </ul>
                        </li>                     
			<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <div class="card"> -->

                            <div class="header">
                                <h4 class="title"></h4>
                                <p class="category"></p>
                            </div>
                            <div class="content"">
                                <img src="../assets_main/img/logo.png" style="max-width: 80%; padding-left: 125px;padding-top: 125px;"">
                            </div>
                        <!-- </div> -->
                    </div>

                    
                </div>
         
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Joshua Sumardi</a>, Application for Proccess Data
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
        <script src="../assets_main/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../assets_main/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="../assets_main/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets_main/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../assets_main/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="../assets_main/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Hi, <?php echo  $_SESSION["user"]["username"] ?> Welcome to <b>Dashboard LOGIN</b> - Template Login Created by Joshua Sumardi."

            },{
                type: 'info',
                timer: 4000
            });
               idleTimer();
    	});
	</script>
</body>
</html>
