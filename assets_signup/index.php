<?php
session_start();
if(!isset($_SESSION["loginadmin"])){
    header("Location: ../login.php");
    exit;
}
if(!isset($_SESSION["loginuser"])){
    header("Location: ../login.php");
    exit;
}
if(isset($_SESSION["loginadmin"])){
    header("Location: page_admin/dashboard.php");
    exit;
}
if(isset($_SESSION["loginuser"])){
    header("Location: page_user/dashboard.php");
    exit;
}
?>