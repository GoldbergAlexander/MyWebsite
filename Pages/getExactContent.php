<?php
require_once "/home/ubuntu/workspace/Pages/connectDB.php";
//Function for getting page content, takes a variable set of arguments,Database link, Tag for content, and optionaly privilidge level and length of text to display.
function getExactContent($connection,$url,$priv = 0){
try{
$statement = $connection->prepare("SELECT * FROM `Content` WHERE `URL` = ? AND `PRIVILEGE` <= ?");



$statement->bind_param("si", $url, $priv);

$statement->execute();

$statement->bind_result($id,$contentname,$url,$tag ,$postdate, $display, $priv, $type,$owner);

$statement->store_result();
if($statement->num_rows > 0){

while($statement->fetch()){
    
    
    
   if($display == 1){

    
   $filePath = "/home/ubuntu/workspace/Content/" . $url . "/main.txt";
   $imagePath = "/Content/" . $url . "/Images/" . "main.jpg";
   
   $file = fopen($filePath, "r");
    
   $content = fread($file, filesize($filePath)); //Discreet size or total file
   
   
   echo "<div class='contentExactItem'>";
   
   echo "<div class='contentExactTitle'>";
   echo $contentname;
   echo "</div>"; //contentTitle
   
   echo "<div class='contentExactOwner'>";
   echo $owner;
   echo "</div>"; //contentTitle
   
   echo "<div class='contentExactImage'>";
   echo "<img src=" . $imagePath . ">";
   echo "</div>"; //contentImage
   
   echo "<div class='contentExactText'>";
   echo $content;
   echo "</div>"; //contentText
   
   if( file_exists ("../Content/" . $url . "/Project/")){
   echo "<div class='files'>";
   echo "<a href='/Content/" . $url . "/Project/'>Project Files</a>";
   echo "</div>";
   }
   
   echo "<div class='contentExactDate'>";
   echo $postdate;
   echo "</div>"; //contentDate
   
   echo "</div>"; //contentItem
  
   fclose($file);
    }
   
    
}
}
else{
    echo "<div class='error'>No Content to Display</div>";
    
}

}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

$statement->close();
}
//getExactContent($connection,"Asset1");



?>
