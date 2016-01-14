<?php
include ("config.php");
$world = array();
for ($y=0;$y<SIZE;$y++){
	for ($x=0;$x<SIZE;$x++){
		$world[$x][$y]=false;			
	}
}
//var_dump($_POST);
foreach($_POST as $key => $val){
	if(substr($key,1,1)=="x"){
		$x=(int)substr($key,0,1);
	} else {
		$x=(int)substr($key,0,2);
	}
/*01/13/16
	echo "CHECKING ";
	var_dump( substr($key,(strlen($key)-1),1));
	echo "<BR>";
*/
	if(substr($key,(strlen($key)-2),1)=="y"){
		$y=(int)substr($key,strlen($key)-1,1);
	} else {
		$y=(int)substr($key,strlen($key)-2,2);

	}
	echo $y . "<BR>";
/*	var_dump($x);
echo ", " .
var_dump($y);
echo " <BR />";*/
	$world[$x][$y]=true;
}
$_SESSION['world']=$world;
$_SESSION['turn']=1;
$current_dir= "life";
$url="http://".$_SERVER['SERVER_NAME']."/".$current_dir."/";
header("Location: $url");
