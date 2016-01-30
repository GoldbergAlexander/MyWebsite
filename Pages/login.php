<?php
require_once "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link
if(isset($_POST['logout'])){
    $_SESSION['priv'] =0;
    session_destroy();
}

global $accessCount;
global $codeG;
global $id;

if(isset($_POST['code'])){
    $code = filter_var(trim($_POST['code']),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $code = filter_var($code, FILTER_SANITIZE_STRING);
    $code = strtoupper($code);
    $GLOBALS["codeG"] = $code;
    try{
        //Verify
        $statement = $connection->prepare("SELECT * FROM `Authorized` WHERE `AccessCode` = ?");
        $statement->bind_param("s", $code);
        $statement->execute();
        $statement->bind_result($id,$accessCode,$priv,$accessTimes, $LastAccess);
      
    while($statement->fetch()){
        $_SESSION['priv'] = $priv;
        $GLOBALS["accessCount"] = $accessTimes;
        $GLOBALS['id'] = $id;
    }

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    $statement->close();
    
    //UPDATE Authorized Rows
    try{
        require_once "/home/ubuntu/workspace/Pages/connectDB.php";
        $GLOBALS["accessCount"] = $GLOBALS["accessCount"] + 1;
        $DATE = date("Y-m-d");
        $statement = $connection->prepare("UPDATE `Authorized` SET `AccessTimes` = ?, `LastAccess` = ? WHERE `AccessCode` = ?");
        $statement->bind_param("iss",$GLOBALS["accessCount"],$DATE,$GLOBALS["codeG"]);
        $statement->execute();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    //INSERT Authorized Access Record
    try{
        require_once "/home/ubuntu/workspace/Pages/connectDB.php";
        $DATE = date("Y-m-d h:m:s");
      
        $ID = $GLOBALS['id'];
     
        $IP = $_SERVER['REMOTE_ADDR'];
    
        $statement = $connection->prepare("INSERT INTO `Authorized_Access` (`idAuthorized`,`Timestamp`,`Ip`) VALUES (?,?,?)");
        $statement->bind_param("iss",$ID,$DATE,$IP);
        $statement->execute();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    
}

?>