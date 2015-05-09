<?php
require_once("getExactContent.php");
require "/home/ubuntu/workspace/Pages/connectDB.php";
$pageUrl = filter_var(trim($_GET["page"]),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pageUrl = filter_var($pageUrl, FILTER_SANITIZE_STRING);
//$pageUrl = strtoupper($pageUrl);
/*try{
$statement = $connection->prepare("SELECT * FROM `Content` WHERE `CONTENTNAME` = '?' AND `PRIVILEGE` <= ?");
$statement->bind_param("si", $pageUrl,$priv);
$statement->execute();
$statement->bind_result($id,$contentname,$url,$tag ,$postdate, $display, $priv, $type);
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}
*/
getExactContent($connection,$pageUrl,$_SESSION['priv']);


?>