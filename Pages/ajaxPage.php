<?php 
require_once("/home/ubuntu/workspace/Pages/connectDB.php");
require_once "/home/ubuntu/workspace/Pages/getPage.php"; 
getPage($connection,$_SESSION["priv"]);
?>