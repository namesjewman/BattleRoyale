<?php
session_start();
require_once("working/functions.php");
if(!isset($_SESSION['COL1_1_NAME'])){setVars();}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Battle Royale</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<script src='design/jquery.js'></script>
	<script src='design/javascript.js'></script>
   <script>
	<?php if($_SESSION['ROUND']==7){echo "var finalRound=true;\n";}else{echo"var finalRound=false;\n";}?>
	<?php 
		if      ($_SESSION['FF']=='done') { echo "var fakeFight='done';\n"; }
		else if ($_SESSION['FF'])         { echo "var fakeFight=true;\n"; }
		else    { echo"var fakeFight=false;\n"; }
	?>
   </script>
   <link rel='stylesheet' type='text/css' href='design/styles.css'>
   <?php if($_SESSION['ROUND']==7){echo "<style>.final1,.final2{opacity:100;}</style>";} ?>
</head>
<body>
<img id='comicCon' <?php if($_SESSION['FF']===true){echo "style='border-bottom:1px dotted' onclick='window.location.href=\"pages/update.php?FF=n\"'";} else if(!$_SESSION['FF']){echo "onclick='window.location.href=\"pages/update.php?FF=y\"'";} ?> src='images/comicCon.png' />
<a href='pages/admin.php'><img id='edit' src='images/edit.png' /></a>
<div id='main-title'><br>
	<button id='fadeIt' onclick='fadeTo()'>Tree</button>
</div>
<div id='arena'>
   <div id='tree'>
      <div id='col1'>
      	<div class='col1 <?php echo $_SESSION['COL1_1_STAT']?>'><?php echo $_SESSION['COL1_1_NAME']?></div>
         <div class='col2 <?php echo $_SESSION['COL1_2_STAT']?>'><?php echo $_SESSION['COL1_2_NAME']?></div>
         <div class='colMT'></div>
         <div class='col3 <?php echo $_SESSION['COL1_3_STAT']?>'><?php echo $_SESSION['COL1_3_NAME']?></div>
         <div class='col4 <?php echo $_SESSION['COL1_4_STAT']?>'><?php echo $_SESSION['COL1_4_NAME']?></div>
         <div class='colMT'></div>
         <div class='col5 <?php echo $_SESSION['COL1_5_STAT']?>'><?php echo $_SESSION['COL1_5_NAME']?></div>
         <div class='col6 <?php echo $_SESSION['COL1_6_STAT']?>'><?php echo $_SESSION['COL1_6_NAME']?></div>
         <div class='colMT'></div>
         <div class='col7 <?php echo $_SESSION['COL1_7_STAT']?>'><?php echo $_SESSION['COL1_7_NAME']?></div>
         <div class='col8 <?php echo $_SESSION['COL1_8_STAT']?>'><?php echo $_SESSION['COL1_8_NAME']?></div>
      </div>
      <div id='col2'>
      	<div class='col1 <?php echo $_SESSION['COL2_1_STAT']?>'><?php echo $_SESSION['COL2_1_NAME']?></div>
         <div class='col2 <?php echo $_SESSION['COL2_2_STAT']?>'><?php echo $_SESSION['COL2_2_NAME']?></div>
         <div class='colMT'></div>
         <div class='col3 <?php echo $_SESSION['COL2_3_STAT']?>'><?php echo $_SESSION['COL2_3_NAME']?></div>
         <div class='col4 <?php echo $_SESSION['COL2_4_STAT']?>'><?php echo $_SESSION['COL2_4_NAME']?></div>
      </div>
      <div id='col3'>
      	<div class='col1 <?php echo $_SESSION['COL3_1_STAT']?>'><?php echo $_SESSION['COL3_1_NAME']?></div>
         <div class='col2 <?php echo $_SESSION['COL3_2_STAT']?>'><?php echo $_SESSION['COL3_2_NAME']?></div>
      </div>
      <div id='col4'>
      	<div class='col1 <?php echo $_SESSION['COL4_1_STAT']?>'><?php echo $_SESSION['COL4_1_NAME']?></div>
      </div>
   </div> <!-- end tree -->

   <div id='fight'>
      <div id='left-box'>
         <div class='win' onclick='winner(0)'>Winner</div>
         <div id='l-name'><?php echo $_SESSION['f1_NAME']?></div>
         <div id='l-image'><?php if($_SESSION['f1_IMG']!='') { echo "<img src='images/".$_SESSION['f1_IMG']."' style='height: 423px; width: 300px;' />"; }?></div>
      </div>
   
      <div id='middle'>
         <?PHP
         	if($_SESSION['f1_NAME']==''){
					if($_SESSION['FF']===true){ echo "<a href='pages/update.php?prepare=FF'><button id='prepare'>Prepare</button></a>\n";}
					else {echo "<a href='pages/update.php?prepare=y'><button id='prepare'>Prepare</button></a>\n";}
				}
				else { echo "<button onclick='alert(\"Select a winner first\")' id='prepare'>Prepare</button>\n"; }
			?>
         <div class='final1'>FINAL</div>
         <div id='vs'><img src='images/vs.png'></div>
         <div class='final2'>BATTLE</div>
      </div>
   
      <div id='right-box'>
         <div class='win' onclick='winner(1)'>Winner</div>
         <div id='r-name'><?php echo $_SESSION['f2_NAME']?></div>
         <div id='r-image'><?php if($_SESSION['f2_IMG']!='') { echo "<img src='images/".$_SESSION['f2_IMG']."' style='height: 423px; width: 300px;' />"; }?></div>
      </div>
   </div> <!-- end fight -->

   <div id='noteTab' onclick='toggleTab()'><div id='noteTabUp'></div><div id='noteTabDown'></div><div class='noteTabLine'></div><div class='noteTabLine'></div><div class='noteTabLine'></div></div>
   <div id='notes'>
   	<div id='lnf'><?php echo $_SESSION['f1_NAME']?></div>
      <div id='rnf'><?php echo $_SESSION['f2_NAME']?></div>
      <textarea id='l-notes' /><?php findNote("l");?></textarea>
     	<textarea id='r-notes' /><?php findNote("r");?></textarea>
   </div>
</div> <!-- end Arena -->

</body>
</html>