<?php

require_once "/home/ubuntu/workspace/Pages/connectDB.php";
//Function for getting page content, takes a variable set of arguments,Database link, Tag for content, and optionaly privilidge level and length of text to display.
function getContent($connection,$tag,$priv,$length = 1000){
try{
$statement = $connection->prepare("SELECT * FROM `Content` WHERE `TAG` = ? AND `PRIVILEGE` <= ? ORDER BY `POSTDATE` DESC");

$statement->bind_param("si", $tag,$priv);

$statement->execute();

$statement->bind_result($id,$contentname,$url,$tag ,$postdate, $display, $priv, $type,$owner);

$statement->store_result();
if($statement->num_rows >0){

while($statement->fetch()){
   
   if($display == 1){

   $filePath = "/home/ubuntu/workspace/Content/" . $url . "/main.txt";
   $imagePath = "Content/" . $url . "/Images/main.jpg";
   
   $file = fopen($filePath, "r");
    
   $content = fread($file, $length/*filesize($filePath)*/); //Discreet size or total file
   
   
   echo "<div class='contentItem'>";
   
   echo "<div class='contentHeader'>";
   echo "<div class='contentTitle'>";
   echo "<a href=/Pages/contentPage.php?page=" . $url . ">$contentname</a>";
   echo "</div>"; //contentTitle
   
   echo "<div class='contentOwner'>";
   echo $owner;
   echo "</div>"; //contentTitle
   echo "</div>"; //contentHeader
   
   echo "<div class='contentImage'>";
   echo "<img src=" . "'image.php?image=../$imagePath'" . ">";
   echo "</div>"; //contentImage
   
   echo "<div class='contentText'>";
   echo $content;
   
   if($length < filesize($filePath)){ // If there is more to display
   
        echo "<span class='contentLink'>";
        echo "...   ";
        echo "<a href=/Pages/contentPage.php?page=" . $url . ">Read More </a>";
        echo "</span>";
   
   }
   echo "</div>"; //contentText
   
  
   
   echo "<div class='contentDate'>";
   echo $postdate;
   echo "</div>"; //contentDate
   
   echo "</div>"; //contentItem
  
   fclose($file);
    }
   
    
}

}else{
    echo "<div class='error'>No Content to Display</div>";
}
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

$statement->close();
}

?>
