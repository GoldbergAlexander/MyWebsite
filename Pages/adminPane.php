<?php
require_once "/home/ubuntu/workspace/Pages/accessTab.php";//accessTab();
require_once "/home/ubuntu/workspace/Pages/head.php";
//require_once "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link
//require_once "/home/ubuntu/workspace/Pages/getPage.php"; //getPage();
	

require "/home/ubuntu/workspace/Pages/connectDB.php";   //Opens required DB link
require_once "/home/ubuntu/workspace/Pages/getContent.php";  //Contains getContent($connection,$tag,$priv = 0 ,$length = 1000)
require_once "/home/ubuntu/workspace/Pages/getPage.php";     //Contains getPage($connection,$priv = 0)
require_once "/home/ubuntu/workspace/Pages/getPageInfo.php"; //Contains a function which returns array getPageInfo($connection,$url,$priv = 0) 
                                                             //array("pageName" => $pageName, "tag" => $tag);      
                                                        
require_once "/home/ubuntu/workspace/Pages/accessTab.php";   //accessTab();
require_once "/home/ubuntu/workspace/Pages/head.php";
//Figure out what page I am
/*
$pageUrl = filter_var(trim($_GET["page"]),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pageUrl = filter_var($pageUrl, FILTER_SANITIZE_STRING);
$pageUrl = strtoupper($pageUrl);
//Figure out the rest through DB
$pageData = getPageInfo($connection,$pageUrl,$_SESSION["priv"]);

$pageName = $pageData["pageName"]; //Title of Page
$pageTag = $pageData["tag"]; //What content we should show
$pageImage = $pageData["image"];
*/
echo "<body>";

//Display Login Tab
echo "<div id='accessTab' class='accessTab'>";
accessTab();
echo "</div>";


//Display navigation
echo "<div id='navigation' class='navigation'>";
getPage($connection,$_SESSION["priv"]);
echo "</div>"; //navigation

echo "<div id='title' class='title'>";
echo "Administration Panel";
echo "</div>"; //title

	
	if($_SESSION["priv"] >= 99){//We will up this to an admin amount
		echo "<div class='adminPages'>";
			echo "&nbspPages:";
			try{
				$statement = $connection->prepare("SELECT * FROM `Pages` WHERE PAGEPRIVILEGE <= ?");
				$priv = 1000;
				$statement->bind_param("i", $priv); //Catch all High Value
				$statement->execute();
				$statement->bind_result($id,$pageName,$url,$priv, $tag);
				while($statement->fetch()){
					echo "<div class='pageNode'>";
						echo "<div class='AdminLinks'>";
							echo "<a href='/Pages/mainPage.php?page=" . $url . "'>" . $pageName . "</a>";
						echo "</div>";
						echo "<div class='details'>";
							echo "<form action='adminChangePage.php' method='POST'>";
								echo "<input type='hidden' name='id' value='$id'>";
								echo "Name <input type='text' name='pageName' value='$pageName'>   ";
								echo "Privilege <input type='text' name='priv' value='$priv'>   ";
								echo "Tag <input type='text' name='tag' value='$tag'>   ";
								echo "<input type='submit' value='submit'>";
							echo "</form>";
						echo "</div>";
						echo "<div class='remove'>";
							echo "<form action='adminPageDelete.php' method='POST'>   ";
								echo "<input type='hidden' name='id' value='$id'>   ";
								echo "<input type='submit' value='remove'>";
							echo "</form>";
						echo "</div>";
					echo "</div>";
				}
				
					echo "<div class='pageNode'>";
						echo "<div class='details'>";
							echo "<form action='adminNewPage.php' method='POST'>";
								echo "Name <input type='text' name='pageName' value='$pageName'>   ";
								echo "Privilege <input type='text' name='priv' value='$priv'>   ";
								echo "Tag <input type='text' name='tag' value='$tag'>   ";
								echo "<input type='submit' value='new'>";
							echo "</form>";
						echo "</div>";
					echo "</div>";
	
			}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		echo "</div>";
		echo "<div class='adminContent'>";
			echo "&nbspContent:";
			try{
				$statement = $connection->prepare("SELECT * FROM `Content` ORDER BY 'POSTDATE' DESC");
				//$priv = 1000;
				//$tag = "*";
				//$statement->bind_param("si",$tag, $priv); //Catch all High Value
				$statement->execute();
				$statement->bind_result($id,$contentname,$url,$tag ,$postdate, $display, $priv, $type,$owner);
				while($statement->fetch()){
					echo "<div class='contentNode'>";
					
						echo "<div class='adminLinks'>";
							echo "<a href=/Pages/contentPage.php?page=" . $url . ">" . $contentname . "</a>";
		 				echo "</div>";
		 				
		 				echo "<div class='files'>";
		
			 				echo "<form action='adminContentChangeFile.php' method='post' enctype='multipart/form-data'>";
				    			echo "<input type='file' name='imageFile' id='imageFile'>";
				    			echo "<input type='hidden' name='id' value='$id'>";
				    			echo "<input type='submit' value='Upload Image' name='submit'>";
							echo "</form>";
							
							echo "<form action='adminContentChangeFile.php' method='post' enctype='multipart/form-data'>";
				    			echo "<input type='file' name='textFile' id='textFile'>";
				    			echo "<input type='hidden' name='id' value='$id'>";
				    			echo "<input type='submit' value='Upload Text' name='submit'>";
							echo "</form>";
		 				
		 				echo "</div>";
		 				
		 				echo "<div class='details'>";
							echo "<form action='adminChangeContent.php' method='POST'>";
								echo "<input type='hidden' name='id' value='$id'>";
								echo "Name <input type='text' name='contentname' value='$contentname'>   ";
								echo "Tag <input type='text' name='tag' value='$tag'>   ";
								echo "PostDate <input type='datetime' name='postdate' value='$postdate'>   ";
								echo "</br>";
								echo "Display <input type='display' name='display' value='$display'>   ";
								echo "Privilege <input type='text' name='priv' value='$priv'>   ";
								echo "Owner <input type='text' name='owner' value='$owner'>   ";
								echo "<input type='submit' value='submit'>";
							echo "</form>";
						echo "</div>";
						
						echo "<div class='remove'>";
							echo "<form action='adminContentDelete.php' method='POST'>";
							echo "<input type='hidden' name='id' value='$id'>";
							echo "<input type='submit' value='remove'>";
							echo "</form>";
						echo "</div>";
					
					echo "</div>";
					
				}
				
				//New File option
				echo "<div class='contentNode'>";
					echo "<div class='adminLinks'>";
						echo "New Content Node";
	 				echo"</div>";
	 				
	 				
	 				
	 				echo "<div class='details'>";
						echo "<form action='adminNewContent.php' method='POST'>";
							echo "Name <input type='text' name='contentname'>   ";
							echo "Tag <input type='text' name='tag' >   ";
							echo "PostDate <input type='text' name='postdate'>  ";
							echo "</br>";
							echo "Display <input type='display' name='display' >   ";
							echo "Privilege <input type='text' name='priv' >   ";
							echo "Owner <input type='text' name='owner' >";
							echo "</br>";
							echo "<input type='submit' value='New'>";
						echo "</form>";
					echo "</div>";
					
				echo "</div>";
	
			}
			catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			} finally {
					$statement->close();
			}
		echo "</div>";
		try{
		echo "<div class='adminAccess'>";
			echo "&nbspAuthorized: ";
			$statement = $connection->prepare("SELECT * FROM `Authorized`");
			//$statement->bind_param("i", $priv); //Catch all High Value
			$statement->execute();
			$statement->bind_result($id,$accessCode,$priv,$accessTimes, $lastAccess);
			while($statement->fetch()){
				echo "<div class='authorizedNode'>";
					echo "<span>Access Code: $accessCode</span>";
					echo "<span>Privilege: $priv</span>";
					echo "<span>Access Times: $accessTimes</span>";
					echo "<span>Last Access: $lastAccess</span>";
				echo "</div>";
			}
		echo "</div>";
		}catch(PDOException $e){
				echo "Error: " . $e->getMessage();
		} finally {
					$statement->close();
		}
	}else{
		  echo "<div class='error'>No Content to Display</div>";
	}


echo "</body>";
?>