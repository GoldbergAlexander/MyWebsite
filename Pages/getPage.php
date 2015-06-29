<?php
ini_set('display_errors', 'On');
require_once "/home/ubuntu/workspace/Pages/connectDB.php";
//Function for getting page content, takes a variable set of arguments,Database link, Tag for content, and optionaly privilidge level and length of text to display.
function getPage($connection,$priv){
try{
$statement = $connection->prepare("SELECT * FROM `Pages` WHERE PAGEPRIVILEGE <= ?");

$statement->bind_param("i", $priv);

$statement->execute();

$statement->bind_result($id,$pageName,$url,$priv, $tag);

while($statement->fetch()){
    

 echo "<div class='links'>";
 echo "<a href='/Pages/mainPage.php?page=" . $url . "'>" . $pageName . "</a>";
 echo"</div>";

    
}

}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

$statement->close();
}
//getPage($connection);



?>
