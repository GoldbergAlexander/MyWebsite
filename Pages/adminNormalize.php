<?php

require_once "/home/ubuntu/workspace/Pages/connectDB.php"; //Opens required DB link
require_once "/home/ubuntu/workspace/Pages/myCopy.php";
require_once "/home/ubuntu/workspace/Pages/myDelete.php";
$baseDir = "/home/ubuntu/workspace/Content/";

	if($_SESSION["priv"] >= 99){
try {
    $statement = $connection->prepare("UPDATE `Content` SET `idContent`=?,`URL`=?  WHERE `URL`=?");
    //$statement->bind_param('iss', $id, $url, $url);
    //$statement->execute();
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$arrayOfAssets = scandir("/home/ubuntu/workspace/Content");
$rightIndex = 1;
for($i = 3; $i < sizeof($arrayOfAssets); $i++){
    echo $arrayOfAssets[$i];
    if(substr($arrayOfAssets[$i],5) > $rightIndex){
        echo "\nshould be " . $rightIndex;
        echo "\nCopying";
        myCopy($baseDir . $arrayOfAssets[$i], $baseDir . "Asset" . $rightIndex);
        echo "\nCleaning";
        myDelete($baseDir . $arrayOfAssets[$i]);
        echo "\nUpdating";
        try{
            echo "\nIndex should be $rightIndex and URL should be " . $baseDir . "Asset" . $rightIndex; 
            $setIndex = $rightIndex;
            $setURL =  "Asset" . $rightIndex;
            $searchURL = $arrayOfAssets[$i];
            $statement->bind_param('iss', $setIndex,$setURL, $searchURL);
            $statement->execute();
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    echo "</br>";
    $rightIndex++;
}

$statement->close();

}
?>