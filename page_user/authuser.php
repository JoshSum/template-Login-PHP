<?php
session_start();
if(!isset($_SESSION["loginuser"])){
    header("Location: ../login.php");
    exit;
}
?>