<?php
header("Location:adminPane.php");
require_once "/home/ubuntu/workspace/Pages/head.php";
require_once "/home/ubuntu/workspace/Pages/connectDB.php"; //Opens required DB link
	if($_SESSION["priv"] >= 99){
function myFilter($value)
{
    $value = filter_var(trim($value), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $value = filter_var($value, FILTER_SANITIZE_STRING);
    return $value;
}


$id          = myFilter($_POST["id"]);
$contentname = myFilter($_POST["contentname"]);
$url         = "Asset" . $id;
$tag         = myFilter($_POST["tag"]);
$postdate    = myFilter($_POST["postdate"]);
$display     = myFilter($_POST["display"]);
//$type= myFilter($_POST["type"]);
$priv        = myFilter($_POST["priv"]);
$owner       = myFilter($_POST["owner"]);
try {
    $statement = $connection->prepare("UPDATE `Content` SET `CONTENTNAME`=?,`URL`=?, `TAG`=?, `POSTDATE`=?,`DISPLAY`=?,`PRIVILEGE`=?,`OWNER`=?  WHERE `idContent`=?");
    $statement->bind_param('ssssiisi', $contentname, $url, $tag, $postdate, $display, $priv, $owner, $id);
    $statement->execute();
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "records UPDATED successfully";
$statement->close();

}

?>