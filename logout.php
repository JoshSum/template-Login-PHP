<?php

session_start();
//session_unset("user");
$_SESSION = [];
session_unset();
session_destroy();
	unset($_SESSION['user']);
        header("Location: index.html");
		exit;
		
?>