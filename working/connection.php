<?php
require_once("constants.php");
// connect to DB
$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die("database connection failed: " . mysql_error());
$db_select = mysql_select_db(DB_NAME,$connection) or die("database selection failed: " . mysql_error());
?>