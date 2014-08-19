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
	$update="UPDATE characters SET team ='".$_GET['team']."' WHERE id ='".$_GET['id']."'";
	if(mysql_query($update, $connection)){header("Location: /battle/pages/admin.php");}
	else { echo "failed: ".$update; }
	}
if(isset($_GET['end'])){
	$update ="UPDATE characters SET status ='mt'";
	if(mysql_query($update, $connection)){
		session_destroy();
		header("Location: /battle");}
	else{echo"<p>Updating character 2 failed.</p>";echo "<p>".mysql_error()."</p>";}
	}
if(isset($_GET['FF'])){
	$_SESSION['FF']=true;
	header("Location: /battle");
}
else if(isset($_GET['win'])){
	if($_SESSION['FF']===true){
		$_SESSION['FF']='done';
		$_SESSION['f1_NAME']=$_SESSION['f1_IMG']=$_SESSION['f1_NOTE']=$_SESSION['f2_NAME']=$_SESSION['f2_IMG']=$_SESSION['f2_NOTE']='';
		header("Location: /battle");
		}
	else {
		$l='';
		if($_SESSION['ROUND']<5) {
			if($_GET['win']==$_SESSION['f1_NAME']){$_SESSION[$_SESSION['f2_LOC']]='lost';$l=$_SESSION['f2_NAME'];setWinner(1,$_GET['note']);}
			else{$l=$_SESSION['f1_NAME'];$_SESSION[$_SESSION['f1_LOC']]='lost';setWinner(2,$_GET['note']);}
		}
		$update ="UPDATE characters SET status ='lost' WHERE name ='".$l."'";
		$update2="UPDATE characters SET status ='won' WHERE name ='".$_GET['win']."'";
		if(mysql_query($update, $connection)) {
			if(mysql_query($update2, $connection)) {
				if($_SESSION['ROUND']==5) {
					if($_GET['win']==$_SESSION['f1_NAME']){ $_SESSION['COL2_2_STAT']='lost';$_SESSION['COL3_1_NAME']=$_SESSION['f1_NAME'];$_SESSION['COL3_1_IMG']=$_SESSION['f1_IMG'];$_SESSION['COL3_1_NOTE']=$_GET['note'];}
					else {$_SESSION['COL2_1_STAT']='lost';$_SESSION['COL3_1_NAME']=$_SESSION['f2_NAME'];$_SESSION['COL3_1_IMG']=$_SESSION['f2_IMG'];$_SESSION['COL3_1_NOTE']=$_GET['note'];}
				}
				else if($_SESSION['ROUND']==6) { echo "round 6<br>";
					if($_GET['win']==$_SESSION['f1_NAME']){ $_SESSION['COL2_4_STAT']='lost'; $_SESSION['COL3_2_NAME']=$_SESSION['f1_NAME']; $_SESSION['COL3_2_IMG']=$_SESSION['f1_IMG'];$_SESSION['COL3_2_NOTE']=$_GET['note'];}
					else { $_SESSION['COL2_3_STAT']='lost'; $_SESSION['COL3_2_NAME']=$_SESSION['f2_NAME']; $_SESSION['COL3_2_IMG']=$_SESSION['f2_IMG'];$_SESSION['COL3_2_NOTE']=$_GET['note'];}
				}
				else if($_SESSION['ROUND']==7) { echo "round 7<br>";
					if($_GET['win']==$_SESSION['f1_NAME']){ $_SESSION['COL3_2_STAT']='lost'; $_SESSION['COL4_1_NAME']=$_SESSION['f1_NAME']; $_SESSION['COL4_1_IMG']=$_SESSION['f1_IMG'];}
					else { $_SESSION['COL3_1_STAT']='lost'; $_SESSION['COL4_1_NAME']=$_SESSION['f2_NAME']; $_SESSION['COL4_1_IMG']=$_SESSION['f2_IMG'];}
				}
				$_SESSION['f1_NAME']=$_SESSION['f1_IMG']=$_SESSION['f1_GRP']='';
				$_SESSION['f2_NAME']=$_SESSION['f2_IMG']=$_SESSION['f2_GRP']='';
				$_SESSION['ROUND']++;
				header("Location: /battle");
			}
			else {echo "<p>Updating winner failed.</p>"; echo "<p>".mysql_error()."</p>";}
		}
		else {echo "<p>Updating loser failed.</p>"; echo "<p>".mysql_error()."</p>";}
	}
} // end win
else if(isset($_GET['prepare'])){
	if($_GET['prepare']=='FF'){
		$name=array();
		$img=array();
		$note=array();
		$d=w();
		while($c=mysql_fetch_array($d)){
			if($c['team']=='joke1') {
				array_push($name, $c['name']);
				array_push($img,  $c['image']);
				array_push($note, $c['notes']);
				}
			}
		$_SESSION['f1_NAME'] = $name[0];
		$_SESSION['f1_IMG']  = $img[0];
		$_SESSION['f1_NOTE'] = $note[0];
		$_SESSION['f2_NAME'] = $name[1];
		$_SESSION['f2_IMG']  = $img[1];
		$_SESSION['f2_NOTE'] = $note[1];
		header("Location: /battle");
		}
	else if($_SESSION['ROUND']==5){$_SESSION['f1_NAME']=$_SESSION['COL2_1_NAME']; $_SESSION['f2_NAME']=$_SESSION['COL2_2_NAME'];$_SESSION['f1_IMG'] =$_SESSION['COL2_1_IMG'];  $_SESSION['f2_IMG'] =$_SESSION['COL2_2_IMG'];$_SESSION['f1_NOTE']=$_SESSION['COL2_1_NOTE']; $_SESSION['f2_NOTE']=$_SESSION['COL2_2_NOTE'];header("Location: /battle");}
	else if($_SESSION['ROUND']==6){$_SESSION['f1_NAME']=$_SESSION['COL2_3_NAME']; $_SESSION['f2_NAME']=$_SESSION['COL2_4_NAME'];$_SESSION['f1_IMG'] =$_SESSION['COL2_3_IMG'];  $_SESSION['f2_IMG'] =$_SESSION['COL2_4_IMG'];$_SESSION['f1_NOTE']=$_SESSION['COL2_3_NOTE']; $_SESSION['f2_NOTE']=$_SESSION['COL2_4_NOTE'];header("Location: /battle");}
	else if($_SESSION['ROUND']==7){$_SESSION['f1_NAME']=$_SESSION['COL3_1_NAME']; $_SESSION['f2_NAME']=$_SESSION['COL3_2_NAME'];$_SESSION['f1_IMG'] =$_SESSION['COL3_1_IMG'];  $_SESSION['f2_IMG'] =$_SESSION['COL3_2_IMG'];$_SESSION['f1_NOTE']=$_SESSION['COL3_1_NOTE']; $_SESSION['f2_NOTE']=$_SESSION['COL3_2_NOTE'];header("Location: /battle");}
	else if($_SESSION['ROUND']>7){header("Location: /battle");}
	else { // Rounds 1-4
		$name=array();
		$img=array();
		$note=array();
		$team=array();
		$d=w();
		while($c=mysql_fetch_array($d)){
			if(($c['status']=='mt')&&($c['team']=='1')) {
				array_push($name, $c['name']);
				array_push($img, $c['image']);
				array_push($note, $c['notes']);
				array_push($team, $c['team']);
				}
			}
		$n =rand(0, count($name)-1);
		$n2=rand(0, count($name)-1);
		while($n2==$n){
		$n2=rand(0, count($name)-1);
		}
		$c1=$name[$n];
		$c2=$name[$n2];
		findColumn($name[$n], $img[$n], $note[$n]);
		findColumn($name[$n2],$img[$n2],$note[$n2]);
		$_SESSION['f1_NAME' ] = $c1;        $_SESSION['f2_NAME'] = $c2;
		$_SESSION['f1_IMG']   = $img[$n];   $_SESSION['f2_IMG']  = $img[$n2];
		$_SESSION['f1_GRP']   = $team[$n];  $_SESSION['f2_GRP']  = $team[$n2];
		$_SESSION['f1_NOTE']  = $note[$n];  $_SESSION['f2_NOTE'] = $note[$n2];
		header("Location: /battle");
	}
}
?>
</head>
<body>
<img id='comicCon' src='../images/comicCon.png' />
<div id='main-title'><br>
	<button id='fadeIt' onclick='fadeTo()'>Tree</button>
</div>
<div id='arena'>
	<div id='fight'>
      <div id='left-box'><div class='win' onclick='winner(0)'>Winner</div></div>
      <div id='middle'><div class='final1'>FINAL</div><div id='vs'><img src='../images/vs.png'></div><div class='final2'>BATTLE</div></div>
      <div id='right-box'><div class='win' onclick='winner(1)'>Winner</div></div>
   </div>
</div>
</body>
</html>