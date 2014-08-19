<!DOCTYPE html>
<html>
<head>
	<title>Battle Royale</title>
   <link rel='stylesheet' type='text/css' href='../design/styles.css'>
<?php
session_start();
require_once("../working/functions.php");
require_once("../working/connection.php");
if(isset($_GET['team'])) {
	$_SESSION['a_scroll'] = $_GET['a_scroll'];
	$_SESSION['j_scroll'] = $_GET['j_scroll'];
	$update="UPDATE characters SET team ='".$_GET['team']."' WHERE id ='".$_GET['id']."'";
	if(mysql_query($update, $connection)){header("Location: /battle/pages/admin.php");}
	else { echo "failed: ".$update; }
	}
?>
</head>
<body></body>
</html>