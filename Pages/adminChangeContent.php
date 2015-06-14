<?php
header("Location:adminPane.php");
require_once "/home/ubuntu/workspace/Pages/head.php";
require_once "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link
foreach($_POST as $value){
    $value = filter_var(trim($value),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $value = filter_var($value, FILTER_SANITIZE_STRING);
}

$id = $_POST["id"];
$contentname = $_POST["contentname"];
$url = $_POST["url"];
$tag = $_POST["tag"];
$postdate = $_POST["postdate"];
$display = $_POST["display"];
//$type = $_POST["type"];
$priv = $_POST["priv"];
$owner = $_POST["owner"];
try{
$statement = $connection->prepare("UPDATE `Content` SET `CONTENTNAME`='$contentname',`URL`='$url', `TAG`='$tag', `POSTDATE`='$postdate',`DISPLAY`='$display',`PRIVILEGE`='$priv',`OWNER`='$owner'  WHERE `idContent`='$id'");


$statement->execute();

}
catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

echo "records UPDATED successfully";
$statement->close();



?>