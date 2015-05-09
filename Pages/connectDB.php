<?php
//This file contains methods to establish connections with the working database//
ini_set('display_errors', 'On');

$servername =   "mysql.admin.server285.com";
$username =     "Ashas";
$password =     "pandadogpanda451";
$database =     "leahpine_alex";

//Create Connection Object
$connection = new mysqli($servername,$username,$password,$database);

//Insure connection
if($connection->connect_error) {
    die("Connection Faild: " . $connection->connect_error);
}

if(!isset($_SESSION['priv']) && empty($_SESSION['priv'])){
    $_SESSION['priv'] = 0;
}

echo "<head>";
//how it works
echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>";
echo "<script src='jquery.js'></script>";
//How it looks
echo "<script src='jqueryCSS.js'></script>";
echo "<link rel='stylesheet' type='text/css' href='css.css'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
echo "</head>";


?>
