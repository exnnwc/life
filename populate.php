<?php
include_once ("config.php");
$_SESSION['continue']=true;
$_SESSION['stop']=false;
$_SESSION['turn']=1;
for ($y=0;$y<SIZE;$y++){
	for ($x=0;$x<SIZE;$x++){
		$_SESSION['world'][$x][$y]=false;			
	}
}
foreach ($_POST as $val){
    $coords= json_decode($val);
    $x=$coords[0];
    $y=$coords[1];
	$_SESSION['world'][$x][$y]=true;
}
header("Location:index.php");
