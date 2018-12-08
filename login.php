<?php
session_start();

if (isset($_SESSION["loginuser"])) {
    header("Location: page_user/dashboard.php");
    exit;
}
if(isset($_SESSION["loginadmin"])){
   header("Location: page_admin/dashboard.php");
   exit;
}

require_once("config.php");

if (isset($_POST['login'])) {

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if ($user) {
        // verifikasi password
        if (password_verify($password, $user["password"])) {

            if ($user['user_type'] == 'admin' and $user['status'] == 'active') {
                // buat Session
                $_SESSION["loginadmin"] = true;
                $_SESSION['user'] = $user;
                //on session creation
                $_SESSION['timestamp']=time();
                $_SESSION['success'] = "You are now logged in";
                // login sukses, alihkan ke halaman timeline
                header('Location: page_admin/dashboard.php');
            } elseif ($user['user_type'] == 'admin' and $user['status'] == 'disable') {
                echo "<script type='text/javascript'>alert('Your account are disable by another admin');</script>";
            } elseif ($user['user_type'] == 'user' and $user['status'] == 'active') {
                $_SESSION["loginuser"] = true;
                $_SESSION['user'] = $user;
                $_SESSION['success'] = "You are now logged in";
                header('Location: page_user/dashboard.php');
            } elseif ($user['user_type'] == 'user' and $user['status'] == 'disable') {
                echo "<script type='text/javascript'>alert('Your account are disable by admin, Please contact your Administrator');</script>";
            }
        } else {
            $message = "Wrong Email or Password";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
//          echo "<script type='text/javascript'>document.getElementById('.error-msg').style.display = 'hide';</script>";
        $message = "Wrong Credentials";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Form</title>

        <!-- CSS -->
        <script src ="assets_main/js/jquery.3.2.1.min.js"></script>
        <link rel="stylesheet" href="assets_main/fonts/css.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!--        <link rel="stylesheet" href="css/style.css">-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Login</strong> Here !</h1>
                            <div class="description">
                                <p>
                                    You must login to access this program<br>
                                    Register <a href="register.php"><strong><b>here</b></strong></a>, if you do not have an account yet or <br> Back to <a href="index.php"><strong><b>Home</b></strong></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Login to our site</h3>
                                    <p>Enter your username and password to log on:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="username" placeholder="Username..." class="form-username form-control" id="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password" required>
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </div>
                                    <p class="error-msg"> Wrong Credential </p>
                                    <button type="submit" name= "login" class="btn">Login</button>
                                    <p style="text-align: center">Reset Password? Click <a href="reset_password.php"><strong>Here</strong></p>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>



        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>
    <script type="text/javascript">
        $("#passwordfield").on("keyup",function(){
            if($(this).val())
                $(".glyphicon-eye-open").show();
            else
                $(".glyphicon-eye-open").hide();
        });
        $(".glyphicon-eye-open").mousedown(function(){
            $("#password").attr('type','text');
        }).mouseup(function(){
            $("#password").attr('type','password');
        }).mouseout(function(){
            $("#password").attr('type','password');
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#login").click(function(){
                if($("#username").val() == ""){
                    $(".form-group").addClass("error");
                    $(".#username").css({"border":"2px solid red"});
                }
                if($("#password").val() == ""){
                    $(".form-group").addClass("error");
                    $(".#password").css({"border":"2px solid red"});
                }
            })
            $(".form-group").click(function(){
                $(".form-group").removeClass("error");
                $(".#username").css({"border":"2px solid #ddd"});
            })
        })    
    </script>
</html>