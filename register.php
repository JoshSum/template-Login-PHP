<?php
session_start();
require_once("config.php");

if(isset($_POST['register'])){

    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $repeat = filter_input(INPUT_POST, 'repeat', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $email
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user > 0) {
        echo '<script language="javascript">
              alert ("Username atau Email Sudah Digunakan, Silahkan Masukkan Username atau Email Lainnya !");
              window.location="register.php";
              </script>';
              exit();
    } else {
        if($password != $repeat){
              echo "<script>
                    alert('Your Password Do Not Match, Please Check your Password !')
                    </script>";
            } else {
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    // menyiapkan query
    $sql = "INSERT INTO users (`name`, username, email, `password`, user_type, `status`, photo) 
            VALUES (:name, :username, :email, :password, 'user', 'disable', 'defaultuser.png')";
    $stmt = $db->prepare($sql);
    $_SESSION['success']  = "New user successfully created!!";
    

    // bind parameter ke query
    $params = array(
        ":name" => $name,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved) {
        $message = "Your account has been registered, Please contact the administrator to activate your account";
            echo "<script type='text/javascript'>alert('$message');window.location ='login.php';</script>";
        //header("Location: login.html");
    } else {
        $message = "Gagal !";
            echo "<script type='text/javascript'>alert('$message');window.location ='login.php';</script>";
}
}
}
}
?>


<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registration Form</title>

        <!-- CSS -->
        <link rel="stylesheet" href="assets_signup/css/css.css">
        <link rel="stylesheet" href="assets_signup/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets_signup/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets_signup/css/form-elements.css">
        <link rel="stylesheet" href="assets_signup/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets_signup/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets_signup/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets_signup/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets_signup/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets_signup/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Signup</strong> Here !</h1>
                            <div class="description">
                            	<p>
	                            	You must login to access this program<br> 
	                            	Have an account? Login <a href="login.php"><strong><b>here</b></strong></a> or <br>
                                    Back to <a href="index.html"><strong><b>Home</b></strong></a>
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
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form id ="validate_form" role="form" action="" method="post" class="login-form">
								<div class="form-group">
			                    		<label class="sr-only" for="form-username">Name</label>
			                        	<input type="text" name="name" placeholder="Name..." class="form-username form-control" id="name" required>
			                        </div>
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="username" required>
			                        </div>
									<div class="form-group">
			                    		<label class="sr-only" for="form-username">Email</label>
			                        	<input type="text" name="email" placeholder="Email..." class="form-username form-control" id="email" required>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password" required>
			                        </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="repeat" placeholder="Retype Password..." class="form-password form-control" id="repeat" >
                                    </div><br>
			                        <button type="submit" name ="register" class="btn">Signup</button>
			                    </form>
		                    </div>
                        </div>
                    </div>                
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets_signup/js/jquery-1.11.1.min.js"></script>
        <script src="assets_signup/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets_signup/js/jquery.backstretch.min.js"></script>
        <script src="assets_signup/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets_signup/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>