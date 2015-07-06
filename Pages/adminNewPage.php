<?php
header("Location:adminPane.php");
require_once "/home/ubuntu/workspace/Pages/head.php";
require "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link
try{
$statement = $connection->prepare("SELECT `idPages` FROM `Pages` ORDER BY `idPages` DESC LIMIT 1");
$statement->execute();
$statement->bind_result($id);
$statement->fetch();
$statement->close();
}
catch(PDOException $e){
			echo "Error: " . $e->getMessage();
    
}


function myFilter($value){
$value=filter_var(trim($value),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$value=filter_var($value, FILTER_SANITIZE_STRING);
return $value;
}

$id = $id+1;


$pageName=  myFilter($_POST["pageName"]);
$url= strtolower($pageName);
$url= str_replace(' ', '', $url);
$priv = myFilter($_POST["priv"]);
$tag =  myFilter($_POST["tag"]);

require "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link
try{
$statement = $connection->prepare("INSERT INTO `Pages` (`idPages`, `PAGENAME`, `URL`, `PAGEPRIVILEGE`, `TAG`) 
                                                VALUES (?, ?, ?, ?, ?)");
$statement->bind_param('issss',$id,$pageName,$url,$priv,$tag);
$statement->execute();

}
catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

echo "Page Inserted";

?>
