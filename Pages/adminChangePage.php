<?php
header("Location:adminPane.php");
require_once "/home/ubuntu/workspace/Pages/head.php";
require_once "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link
foreach($_POST as $value){
    $value = filter_var(trim($value),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $value = filter_var($value, FILTER_SANITIZE_STRING);
}
$id=  $_POST["id"];
$pageName=  $_POST["pageName"];
$url=  $_POST["url"];
$priv = $_POST["priv"];
$tag =  $_POST["tag"];


try{
$statement = $connection->prepare("UPDATE `Pages` SET `PAGENAME`='$pageName',`URL`='$url', `PAGEPRIVILEGE`='$priv', `TAG`='$tag' WHERE `idPages`='$id'");


$statement->execute();

}
catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

echo "records UPDATED successfully";
$statement->close();

?>