<?php
require_once "/home/ubuntu/workspace/Pages/connectDB.php";   //Opens required DB link
$file = $_GET['image'];
function myFilter($value)
{
    $value = filter_var(trim($value), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $value = filter_var($value, FILTER_SANITIZE_STRING);
    return $value;
}
$file = myFilter($file);
$url = substr($file,11,6);
echo "Bad Access";
$priv = $_SESSION['priv'];
$statement = $connection->prepare("SELECT * FROM `Content` WHERE `URL` = ? AND `PRIVILEGE` <= ?");
$statement->bind_param("si", $url,$priv);
$statement->execute();
$statement->bind_result($id,$contentname,$url,$tag ,$postdate, $display, $priv, $type,$owner);
$statement->store_result();
if($statement->num_rows > 0){
   if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
} 
}
?>