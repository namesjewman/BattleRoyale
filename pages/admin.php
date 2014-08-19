<?php
session_start();
require_once("../working/functions.php");
?>
<!DOCTYPE html>
<html>
<head>
   <title>Battle Royale</title>
   <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
   <script src='../design/jquery.js'></script>
   <script src='../design/javascript.js'></script>
   <script>
		$(document).ready(function(){
			$('#archive, #charList, #joke, #jokeArchive').children('div').children('input').each(function(){
				$(this).click(function() {
						var par = $(this).parent().parent().attr('id');
						switch(par){
							case 'charList':    team=0;                                     break;
							case 'archive':     !this.checked ? team=0 : team=1;            break;
							case 'joke':        team='joke';                                break;
							case 'jokeArchive': !this.checked ? team='joke' : team='joke1'; break;
							}
						var id = parseInt($(this).attr('value'));
						if (!this.checked) { sendIt(team,id,$('#archive div').scrollTop(),$('#jokeArchive div').scrollTop()); }
						else if (par=='jokeArchive') {
							if ($('#joke').children('div').children().length<7) { sendIt(team,id,$('#archive div').scrollTop(),$('#jokeArchive div').scrollTop()); }
							else { alert('You can only have 2 Characters<br>for the Joke battle'); }
							}
						else if ($('#charList').children('div').children().length<24) { sendIt(team,id,$('#archive div').scrollTop(),$('#jokeArchive div').scrollTop()); }
						else {
							var a=$(this).attr('id').toString().split('-');
							$('#'+a[0]+'-2').prop('checked', false);
							alert('You can only have 8 fighters'); }
					});
				});
				<?php
				if(isset($_SESSION['a_scroll'])) {
					echo '$("#archive div").scrollTop('.$_SESSION['a_scroll'].')';
					}
				if(isset($_SESSION['error'])) {
					echo 'alert("'.$_SESSION['error'].'")';
					unset($_SESSION['error']);
					}
				?>
			});	
   </script>
   <link rel='stylesheet' type='text/css' href='../design/styles.css'>
</head>

<body>
<button onclick='verify()' id='endSession'>End Session</button>
<a href='/battle' id='backButton'><img src='../images/back.jpg'></a>
<h1>Customize Battle / Add Characters <button onClick="verifyStart()" id="startFight">Fight!</button></h1>
<div id="adminBody">
   <div id='charList'>
      <center><h3>Current Battle</h3></center>
      <div>
      <?php
         $d=w(); $x=1;
         while($characters=mysql_fetch_array($d)) { if($characters['team']=="1") { echo'      <input type="checkbox" checked id="id'.$x.'-1" name="char'.$x.'-1" value="'.$characters['id'].'"> <span>'.$characters['name']."</span><br>\n"; } $x++;}
      ?>
      </div>
   </div>
   <div id='archive'>
      <center><h3>Archive</h3></center>
      <div>
      <?php
         $d=w(); $x=1;
         while($characters=mysql_fetch_array($d)) { if(($characters['team']=="0")||($characters['team']=="1")) { echo'      <input type="checkbox"'; if($characters['team']==1) {echo "checked";} echo ' id="id'.$x.'-2" name="char'.$x.'-2" value="'.$characters['id'].'"> <span>'.$characters['name']."</span><br>\n"; } $x++;}
      ?>
      </div>
   </div>
   <form id='characterForm' action='../working/create_char.php' name='createChar' method='post' enctype="multipart/form-data">
      <center>
         <div id='leftForm'>
            Character Name:<br />
            Upload Image:<br />
            Joke Character?
         </div>
         <div id="rightForm">
            <input name="charName" type='text'<?php if(isset($_SESSION['formName'])){echo " value='".$_SESSION['formName']."'"; unset($_SESSION['formName']); }; ?> /><br />
            <input name="image"    type="file"><br />
            <input name="charJoke" <?php if(isset($_SESSION['formJoke'])){echo " checked"; unset($_SESSION['formJoke']); }; ?> type="checkbox" />
         </div>
         <input type="submit" name="submit" value="Create New Character">
         <br><br>
         Image names need to include the extension<br>
         example: HeroName.jpg or HeroName.gif<br>
         Images will be autosized to 300x423
      </center>
   </form>
   <div id='joke'>
      <center><h3>Joke Battle</h3></center>
      <div>
      <?php
         $d=w(); $x=1;
         while($characters=mysql_fetch_array($d)) { if($characters['team']=="joke1") { echo'      <input type="checkbox" checked id="id'.$x.'-1" name="char'.$x.'-1" value="'.$characters['id'].'"> <span>'.$characters['name']."</span><br>\n"; } $x++;}
      ?>
      </div>
   </div>
   <div id='jokeArchive'>
      <center><h3>Joke Archive</h3></center>
      <div>
      <?php
         $d=w(); $x=1;
         while($characters=mysql_fetch_array($d)) { if(($characters['team']=="joke")||($characters['team']=="joke1")) {echo'      <input type="checkbox" '; if($characters['team']=="joke1") {echo "checked";} echo ' id="id'.$x.'-2" name="char'.$x.'-2" value="'.$characters['id'].'"> <span>'.$characters['name']."</span><br>\n"; } $x++;}
      ?>
      </div>
   </div>
</div> <!-- end #AdminBody -->
<!--
   <form id="imageUploadForm" action="../working/upload_file.php" method="post" enctype="multipart/form-data">
      <input type="file" name="file" id="file"><br>
      <input type="submit" name="submit" value="Upload image">
   </form>
-->
</body>
</html>