<?php
//This file contains methods to establish connections with the working database//
$array = file("../login.txt");

$servername =   trim($array[0]);
$username =     trim($array[1]);
$password =     trim($array[2]);
$database =     trim($array[3]);
//Create Connection Object
$connection = new mysqli($servername,$username,$password,$database);
//Insure connection
if($connection->connect_error) {
    die("Connection Faild: " . $connection->connect_error);
}
if(!isset($_SESSION['priv']) && empty($_SESSION['priv'])){
    $_SESSION['priv'] = 0;
}

?>