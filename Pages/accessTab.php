<?php
ini_set('display_errors', 'On');
require_once "/home/ubuntu/workspace/Pages/connectDB.php";

function accessTab(){
echo "<div class='accessTab'>";
if($_SESSION["priv"] <= 0){
//echo "<form id='accessForm' action='' method='post'>";
echo "<div>";
echo "<input id='accessText' type='text' name='code' class='accessInput'>";
echo "</div>";
//echo "<input type='submit'>";
// echo "</form>";
}else{
//echo "<form action='login.php' method='post'>";
//echo "<span class='accessDisplay'>Access Level: " . $_SESSION["priv"] . "</span>";
//echo "<input type='submit' name='logout' class='accessLogout' value='logout'>";
echo "<div class='access'>";
echo "<input type='button' id='name' name='logout' class='accessLogout' value='logout'>";
echo "</div>";
//echo "</form>";
}
echo "</div>"; //login
}

?>