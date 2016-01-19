<?php
require_once "/home/ubuntu/workspace/Pages/connectDB.php";

function accessTab(){
echo "<div class='login'>";
if($_SESSION["priv"] <= 0){
echo "<input id='accessText' type='text' name='code' class='accessInput'/>";
}else{
//echo "<div class='access'>";
echo "<input type='button' id='name' name='logout' class='accessLogout' value='Logout'/>";
//echo "</div>";
}
echo "</div>"; //login
}

?>