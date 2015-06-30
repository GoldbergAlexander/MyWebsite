<?php
header("Location:adminPane.php");
require_once "/home/ubuntu/workspace/Pages/head.php";
require "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link
function myCopy($source, $target) {
        if (!is_dir($source)) {//it is a file, do a normal copy
            copy($source, $target);
            return;
        }

        //it is a folder, copy its files & sub-folders
        @mkdir($target);
        $d = dir($source);
        $navFolders = array('.', '..');
        while (false !== ($fileEntry=$d->read() )) {//copy one by one
            //skip if it is navigation folder . or ..
            if (in_array($fileEntry, $navFolders) ) {
                continue;
            }

            //do copy
            $s = "$source/$fileEntry";
            $t = "$target/$fileEntry";
            myCopy($s, $t);
        }
        $d->close();
    }
$statement = $connection->prepare("SELECT `idContent` FROM `Content` ORDER BY `idContent` DESC LIMIT 1");
$statement->execute();
$statement->bind_result($id);
$statement->fetch();
$statement->close();
function myFilter($value){
$value=filter_var(trim($value),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$value=filter_var($value, FILTER_SANITIZE_STRING);
return $value;
}

$id = $id + 1;
$contentname = myFilter($_POST["contentname"]);
$url = "Asset" . $id; 
$tag = myFilter($_POST["tag"]);
$postdate = myFilter($_POST["postdate"]);
$display = myFilter($_POST["display"]);
//$type = myFilter($_POST["type"]);
$priv =myFilter($_POST["priv"]);
$owner = myFilter($_POST["owner"]);

try{
require "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link
$statement = $connection->prepare("INSERT INTO `Content` (`idContent`, `CONTENTNAME`, `URL`, `TAG`, `POSTDATE`, `DISPLAY`, `PRIVILEGE`, `TYPE`, `OWNER`) 
                                                VALUES (?, ?, ?, ?, ?, ?, ?, NULL, ?)");
$statement->bind_param('issssiis',$id,$contentname,$url,$tag,$postdate,$display,$priv,$owner);

$statement->execute();

}
catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}


myCopy("/home/ubuntu/workspace/Content/Asset","/home/ubuntu/workspace/Content/" . $url );

echo "records UPDATED successfully";
$statement->close();



?>