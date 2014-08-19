<?php
if ($_FILES["file"]["error"] > 0) { echo "Return Code: " . $_FILES["file"]["error"] . "<br>"; }
else {
	if (file_exists("upload/" . $_FILES["file"]["name"])) { echo $_FILES["file"]["name"] . " already exists. "; }
   else { move_uploaded_file($_FILES["file"]["tmp_name"], "../images/" . $_FILES["file"]["name"]); }
	}
?>