<?php
header("Location:adminPane.php");
require_once "/home/ubuntu/workspace/Pages/head.php";
require_once "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link

if(isset($_POST["submit"])) {
    
    
    $statement = $connection->prepare("SELECT * FROM `Content` WHERE `idContent` = ?");
    $statement->bind_param("i", $_POST['id']);
    $statement->execute();
    $statement->bind_result($id,$contentname,$url,$tag ,$postdate, $display, $priv, $type,$owner);
    $statement->fetch();
    
    if(isset($_FILES['textFile'])){
        $uploadDir = "../Content/$url/";
        $uploadFile = $uploadDir . "main.txt";
        if(!move_uploaded_file($_FILES['textFile']['tmp_name'], $uploadFile)){
            echo "File Upload Error";
        }
    
    }

    if(isset($_FILES['imageFile'])){
        $uploadDir = "../Content/$url/Images/";
        $uploadFile = $uploadDir . "main.jpg";
         if(!move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadFile)){
            echo "File Upload Error";
        }
    
    }
    
    $statement->close();

}

?>
