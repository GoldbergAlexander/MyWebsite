<?php

require_once("getContent.php");
require "/home/ubuntu/workspace/Pages/connectDB.php";
$pageUrl = filter_var(trim($_GET["page"]),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pageUrl = filter_var($pageUrl, FILTER_SANITIZE_STRING);
//$pageUrl = strtoupper($pageUrl);

//require_once "getPageInfo.php";
//$pageData = getPageInfoByName($connection,$pageUrl,$_SESSION['priv']);

getContent($connection,$pageUrl,$_SESSION["priv"]);

?>