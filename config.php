<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "tubes";

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    return $con;
    return $db;
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}

//$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
//
//if( !$con ){
//    die("Gagal terhubung dengan database: " . mysqli_connect_error());
//}

?>