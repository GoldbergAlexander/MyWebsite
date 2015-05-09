<?php
ini_set('display_errors', 'On');
require_once "/home/ubuntu/workspace/Pages/connectDB.php";   //Opens required DB link

if(isset($_POST['logout'])){
$_SESSION['priv'] =0;
session_destroy();
}

if(isset($_POST['code'])){
$code = filter_var(trim($_POST['code']),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$code = filter_var($code, FILTER_SANITIZE_STRING);
$code = strtoupper($code);
error_log("Login Code: " . $code . "\n", 3, "~/php_errors.log");

try{
$statement = $connection->prepare("SELECT * FROM `Authorized` WHERE `AccessCode` = ?");

$statement->bind_param("s", $code);

$statement->execute();

$statement->bind_result($id,$accessCode,$priv,$accessTimes, $LastAccess);

while($statement->fetch()){
    $_SESSION['priv'] = $priv;
}

}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

$statement->close();
}

?>