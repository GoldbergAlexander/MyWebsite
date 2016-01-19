<?php
header("Location:adminPane.php");
require_once "/home/ubuntu/workspace/Pages/head.php";
require_once "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link

	if($_SESSION["priv"] >= 1){
function myFilter($value){
$value=filter_var(trim($value),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$value=filter_var($value, FILTER_SANITIZE_STRING);
return $value;
}

$id=  myFilter($_POST["id"]);
$pageName=  myFilter($_POST["pageName"]);
$url= strtolower($pageName);
$url= str_replace(' ', '', $url);
$priv = myFilter($_POST["priv"]);
$tag =  myFilter($_POST["tag"]);


try{
$statement = $connection->prepare("UPDATE `Pages` SET `PAGENAME`=?,`URL`=?, `PAGEPRIVILEGE`=?, `TAG`=? WHERE `idPages`=?");
$statement->bind_param('ssisi',$pageName,$url,$priv,$tag,$id);
$statement->execute();

}
catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

echo "records UPDATED successfully";
$statement->close();
}
?>