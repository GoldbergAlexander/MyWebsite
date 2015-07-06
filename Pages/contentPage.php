<?php
//This page is linked to from long content
require_once "/home/ubuntu/workspace/Pages/connectDB.php";   //Opens required DB link
require_once "/home/ubuntu/workspace/Pages/getContent.php";  //Contains getContent($connection,$tag,$priv = 0 ,$length = 1000)
require_once "/home/ubuntu/workspace/Pages/getPage.php";     //Contains getPage($connection,$priv = 0)
require_once "/home/ubuntu/workspace/Pages/getPageInfo.php"; //Contains a function which returns array getPageInfo($connection,$url,$priv = 0) 
                                                             //array("pageName" => $pageName, "tag" => $tag); 
require_once "/home/ubuntu/workspace/Pages/getExactContent.php";//getExactContent($connection,$pageUrl,$_SESSION["priv"]);
require_once "/home/ubuntu/workspace/Pages/accessTab.php";   //accessTab();
require_once "/home/ubuntu/workspace/Pages/head.php";                                                        
$pageUrl = $_GET["page"]; //get the page variable/link

echo "<body>";
//Display Login Tab
echo "<div id='accessTab' class='accessTab'>";
accessTab();
echo "</div>";

//Display navigation
echo "<div id='navigation' class='navigation'>";
getPage($connection,$_SESSION["priv"]);
echo "</div>"; //navigation

echo "<div id='exactContent' class='exactContent'>";
getExactContent($connection,$pageUrl,$_SESSION["priv"]);
echo "</div>"; //content

echo "</body>";

?>
