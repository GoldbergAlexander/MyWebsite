<?php
header("Location:adminPane.php");
require_once "/home/ubuntu/workspace/Pages/head.php";
require_once "/home/ubuntu/workspace/Pages/myDelete.php";
require_once "/home/ubuntu/workspace/Pages/connectDB.php"; //Opens required DB link
function myFilter($value)
{
    $value = filter_var(trim($value), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $value = filter_var($value, FILTER_SANITIZE_STRING);
    return $value;
}





    $id = myFilter($_POST["id"]);
    myDelete("/home/ubuntu/workspace/Content/Asset" . $id);
    try {
        $statement = $connection->prepare("DELETE FROM `Content` WHERE `idContent` = ?");
        $statement->bind_param('i', $id);
        $statement->execute();
    }   
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    echo "records UPDATED successfully";

?>
