<?php
ini_set('display_errors', 'On');
require_once "/home/ubuntu/workspace/Pages/connectDB.php";
//Function for getting page content, takes a variable set of arguments,Database link, Tag for content, and optionaly privilidge level and length of text to display.
function getPageInfo($connection,$url,$priv = 0){
try{
$statement = $connection->prepare("SELECT * FROM `Pages` WHERE `URL` = ? AND PAGEPRIVILEGE <= ?");


$statement->bind_param("si",$url,$priv);

$statement->execute();

$statement->bind_result($id,$pageName,$url,$priv, $tag);

$statement->fetch();

return array("pageName" => $pageName, "tag" => $tag);


}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

$statement->close();
}
//$myArray = getPageInfo($connection,"test"); //returns array

function getPageInfoByName($connection,$url,$priv = 0){
try{
$statement = $connection->prepare("SELECT * FROM `Pages` WHERE `PAGENAME` = ? AND PAGEPRIVILEGE <= ?");


$statement->bind_param("si",$url,$priv);

$statement->execute();

$statement->bind_result($id,$pageName,$url,$priv, $tag);

$statement->fetch();

return array("url" => $url, "tag" => $tag);


}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

$statement->close();
}


?>
