<?php

ini_set('display_errors', 'On');
require_once "/home/ubuntu/workspace/Pages/connectDB.php";   //Opens required DB link
require_once "/home/ubuntu/workspace/Pages/getContent.php";  //Contains getContent($connection,$tag,$priv = 0 ,$length = 1000)
require_once "/home/ubuntu/workspace/Pages/getPage.php";     //Contains getPage($connection,$priv = 0)
require_once "/home/ubuntu/workspace/Pages/getPageInfo.php"; //Contains a function which returns array getPageInfo($connection,$url,$priv = 0) 
                                                             //array("pageName" => $pageName, "tag" => $tag);      
                                                        
require_once "/home/ubuntu/workspace/Pages/accessTab.php";   //accessTab();
require_once "/home/ubuntu/workspace/Pages/head.php";
//Figure out what page I am

$pageUrl = filter_var(trim($_GET["page"]),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pageUrl = filter_var($pageUrl, FILTER_SANITIZE_STRING);
$pageUrl = strtoupper($pageUrl);
//Figure out the rest through DB
$pageData = getPageInfo($connection,$pageUrl,$_SESSION["priv"]);

$pageName = $pageData["pageName"]; //Title of Page
$pageTag = $pageData["tag"]; //What content we should show
$pageImage = $pageData["image"];
echo "<body>";

//Display Login Tab

//echo "Alexander Goldberg";
echo "<div id='accessTab' class='accessTab'>";
accessTab();
echo "</div>";


//Display navigation
echo "<div id='navigation' class='navigation'>";
getPage($connection,$_SESSION["priv"]);

echo "</div>"; //navigation

/*echo "<div id='mainImage' class='mainImage'>";

echo "<img src='../PageImages/" . $pageImage . "'>";

echo "</div>"; //mainImage
*/
echo "<div id='title' class='title'>";
echo $pageName;
echo "</div>"; //title

//Display Content
echo "<div id='content' class='content'>";
getContent($connection,$pageTag,$_SESSION["priv"]);
echo "</div>"; //content

echo "</body>";
?>