<?php
	require_once "/home/ubuntu/workspace/Pages/accessTab.php";//accessTab();
	require_once "/home/ubuntu/workspace/Pages/head.php";
	require_once "/home/ubuntu/workspace/Pages/connectDB.php";//Opens required DB link
	require_once "/home/ubuntu/workspace/Pages/getPage.php"; //getPage();
	echo "<body>";
	
	
	if($_SESSION["priv"] >= 1){//We will up this to an admin amount
		echo "Pages:";
		try{
			$statement = $connection->prepare("SELECT * FROM `Pages` WHERE PAGEPRIVILEGE <= ?");
			$priv = 1000;
			$statement->bind_param("i", $priv); //Catch all High Value
			$statement->execute();
			$statement->bind_result($id,$pageName,$url,$priv, $tag);
			while($statement->fetch()){
				echo "<div class='links'>";
				echo "<a href='/Pages/mainPage.php?page=" . $url . "'>" . $pageName . "</a>";
				echo "</div>";
				echo "<div class='details'>";
				echo "<form action='adminChangePage.php' method='POST'>";
				echo "ID:<input type='text' name='id' value='$id'>";
				echo "pageName:<input type='text' name='pageName' value='$pageName'>";
				echo "URL:<input type='text' name='url' value='$url'>";
				echo "Priv:<input type='text' name='priv' value='$priv'>";
				echo "Tag:<input type='text' name='tag' value='$tag'>";
				echo "<input type='submit' value='submit'>";
				echo "</form>";
				echo "</div>";
			}

		}

		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		
		echo "Content:";
		try{
			$statement = $connection->prepare("SELECT * FROM `Content` ORDER BY 'POSTDATE' DESC");
			//$priv = 1000;
			//$tag = "*";
			//$statement->bind_param("si",$tag, $priv); //Catch all High Value
			$statement->execute();
			$statement->bind_result($id,$contentname,$url,$tag ,$postdate, $display, $priv, $type,$owner);
			while($statement->fetch()){
				echo "<div class='links'>";
				echo "<a href=/Pages/contentPage.php?page=" . $url . ">" . $contentname . "</a>";
 				echo"</div>";
 				
 				
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
				echo "ID:<input type='text' name='id' value='$id'>";
				echo "contentname:<input type='text' name='contentname' value='$contentname'>";
				echo "URL:<input type='text' name='url' value='$url'>";
				echo "TAG:<input type='text' name='tag' value='$tag'>";
				echo "PostDate:<input type='text' name='postdate' value='$postdate'>";
				echo "Display:<input type='display' name='display' value='$display'>";
				echo "Priv:<input type='text' name='priv' value='$priv'>";
				echo "Owner:<input type='text' name='owner' value='$owner'>";
				echo "<input type='submit' value='submit'>";
				echo "</form>";
				echo "</div>";
			}

		}

		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$statement->close();
	}


echo "</body>";
?>