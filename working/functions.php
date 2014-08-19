<?php
require_once("constants.php");
$c=mysql_connect(DB_SERVER,DB_USER,DB_PASS)or die("database connection failed: ".mysql_error());
$db=mysql_select_db(DB_NAME,$c)or die("database selection failed: ".mysql_error());
function c_q($result_set){if(!$result_set){die("Database query failed: ".mysql_error());}}
function w(){global $c;$q="SELECT * FROM characters ORDER BY name";$s=mysql_query($q, $c);c_q($s);return $s;}
function getChar($d){global $c;$q="SELECT * FROM characters WHERE id=".$d;$s=mysql_query($q, $c);c_q($s);return $s;}
function mysql_prep($v){
	$m=get_magic_quotes_gpc();
	$n=function_exists("mysql_real_escape_string");
	if($n){
		if($m){$v=stripslashes($v);}}
		else{
			if(!m){$v=addslashes($v);
			}
		}
	return $v;
	}
function e($d,$f,$n,$i,$m){
	$_SESSION['COL'.$d.'_NAME']=$n;
	$_SESSION['COL'.$d.'_STAT']='';
	$_SESSION['f'.$f.'_LOC']='COL'.$d.'_STAT';
	$_SESSION['f'.$f.'_NAME']=$n;
	$_SESSION['f'.$f.'_NOTE']=$m;
	$_SESSION['f'.$f.'_IMG']=$i;
	}

function e2($d,$f,$n){
	$_SESSION['COL'.$d.'_NAME']=$_SESSION['f'.$f.'_NAME'];
	$_SESSION['COL'.$d.'_NOTE']=$n;
	$_SESSION['COL'.$d.'_IMG']=$_SESSION['f'.$f.'_IMG'];
	}
function findColumn($n,$i,$m){switch(''){case $_SESSION['COL1_1_NAME']:e('1_1',1,$n,$i,$m);break;case $_SESSION['COL1_2_NAME']:e('1_2',2,$n,$i,$m);break;case $_SESSION['COL1_3_NAME']:e('1_3',1,$n,$i,$m);break;case $_SESSION['COL1_4_NAME']:e('1_4',2,$n,$i,$m);break;case $_SESSION['COL1_5_NAME']:e('1_5',1,$n,$i,$m);break;case $_SESSION['COL1_6_NAME']:e('1_6',2,$n,$i,$m);break;case $_SESSION['COL1_7_NAME']:e('1_7',1,$n,$i,$m);break;case $_SESSION['COL1_8_NAME']:e('1_8',2,$n,$i,$m);break;case $_SESSION['COL2_1_NAME']:e('2_1',1,$n,$i,$m);break;case $_SESSION['COL2_2_NAME']:e('2_2',2,$n,$i,$m);break;case $_SESSION['COL2_3_NAME']:e('2_3',1,$n,$i,$m);break;case $_SESSION['COL2_4_NAME']:e('2_4',2,$n,$i,$m);break;case $_SESSION['COL3_1_NAME']:e('3_1',1,$n,$i,$m);break;case $_SESSION['COL3_2_NAME']:e('3_2',2,$n,$i,$m);break;case $_SESSION['COL4_1_NAME']:e('4_1',1,$n,$i,$m);break;}}
function setWinner($f,$n){
	switch($_SESSION['f'.$f.'_LOC']){
		case 'COL1_1_STAT':e2('2_1',$f,$n);break;
		case 'COL1_2_STAT':e2('2_1',$f,$n);break;
		case 'COL1_3_STAT':e2('2_2',$f,$n);break;
		case 'COL1_4_STAT':e2('2_2',$f,$n);break;
		case 'COL1_5_STAT':e2('2_3',$f,$n);break;
		case 'COL1_6_STAT':e2('2_3',$f,$n);break;
		case 'COL1_7_STAT':e2('2_4',$f,$n);break;
		case 'COL1_8_STAT':e2('2_4',$f,$n);break;
		case 'COL2_1_STAT':e2('3_1',$f,$n);break;
		case 'COL2_2_STAT':e2('3_1',$f,$n);break;
		case 'COL2_3_STAT':e2('3_2',$f,$n);break;
		case 'COL2_4_STAT':e2('3_2',$f,$n);break;
		default:e2('4_1',$f,$n);break;
		}}
function setVars(){$_SESSION['ROUND']=1;$_SESSION['f1_NAME']=$_SESSION['f1_IMG']=$_SESSION['f2_NAME']=$_SESSION['f2_IMG']=$_SESSION['FF']='';$_SESSION['COL1_1_NAME']=$_SESSION['COL1_2_NAME']=$_SESSION['COL1_3_NAME']=$_SESSION['COL1_4_NAME']=$_SESSION['COL1_5_NAME']=$_SESSION['COL1_6_NAME']=$_SESSION['COL1_7_NAME']=$_SESSION['COL1_8_NAME']=$_SESSION['COL2_1_NAME']=$_SESSION['COL2_2_NAME']=$_SESSION['COL2_3_NAME']=$_SESSION['COL2_4_NAME']=$_SESSION['COL3_1_NAME']=$_SESSION['COL3_2_NAME']=$_SESSION['COL4_1_NAME']='';$_SESSION['COL1_1_STAT']=$_SESSION['COL1_2_STAT']=$_SESSION['COL1_3_STAT']=$_SESSION['COL1_4_STAT']=$_SESSION['COL1_5_STAT']=$_SESSION['COL1_6_STAT']=$_SESSION['COL1_7_STAT']=$_SESSION['COL1_8_STAT']=$_SESSION['COL2_1_STAT']=$_SESSION['COL2_2_STAT']=$_SESSION['COL2_3_STAT']=$_SESSION['COL2_4_STAT']=$_SESSION['COL3_1_STAT']=$_SESSION['COL3_2_STAT']=$_SESSION['COL4_1_STAT']='mt';}
function findNote($d){if($d=='l'){if($_SESSION['ROUND']==5){echo $_SESSION['COL2_1_NOTE'];}elseif($_SESSION['ROUND']==6){echo $_SESSION['COL2_3_NOTE'];}elseif($_SESSION['ROUND']==7){echo $_SESSION['COL3_1_NOTE'];}}else{if($_SESSION['ROUND']==5){echo $_SESSION['COL2_2_NOTE'];}elseif($_SESSION['ROUND']==6){echo $_SESSION['COL2_4_NOTE'];}elseif($_SESSION['ROUND']==7){echo $_SESSION['COL3_2_NOTE'];}}}
?>