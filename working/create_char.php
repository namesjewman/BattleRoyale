<?php
session_start();
require_once("../working/functions.php");

if ($_FILES["image"]["error"] > 0) {
	if($_FILES["image"]["error"]==4) { // No image file was uploaded
		$_SESSION['error'] = " You have to upload an image file for the new Character";
		if ($_POST['charJoke']=='on') { $_SESSION['formJoke'] = $_POST['charJoke']; }
		$_SESSION['formName'] = $_POST['charName'];
		header("Location: /battle/pages/admin.php");
		}
	else { echo "Error Code: " . $_FILES["image"]["error"] . "<br>"; exit; }
	}
else {
	if($_POST['charName']!='') { // character has a name
		if (file_exists("../images/" . $_FILES["image"]["name"])) { // There is already an image by that name in the image folder
			if ($_POST['charJoke']=='on') { $_SESSION['formJoke'] = $_POST['charJoke']; }
			$_SESSION['formName'] = $_POST['charName'];
			$_SESSION['error']    = "There is already an image by that name, rename the image and resubmit";
			header("Location: /battle/pages/admin.php");
			}
		else {
			move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $_FILES["image"]["name"]);
			if($_POST['charJoke']=='on') { $team='joke'; }
			else { $team = 0; }
			$query="INSERT INTO characters (name, image, team) VALUES ('".$_POST['charName']."','".$_FILES["image"]["name"]."','".$team."')";
			if(mysql_query($query, $c)){header("Location: /battle/pages/admin.php");}
			}
		}
	else { // No Character name
		$_SESSION['error'] = " Please choose a character name and re-upload the file";
		header("Location: /battle/pages/admin.php");
		}
	}
?>