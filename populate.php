<?php
session_start();
define ("WIDTH", 25);
define ("HEIGHT", 25);
$world = array();
for ($y=0;$y<HEIGHT;$y++){
	for ($x=0;$x<HEIGHT;$x++){
		$world[$x][$y]=0;			
	}
}
var_dump($_POST);
foreach($_POST as $key => $val){
	if(substr($key,1,1)=="x"){
		$x=(int)substr($key,0,1);
	} else {
		$x=(int)substr($key,0,2);
	}
	if(substr($key,1,1)=="y"){
		$y=(int)substr($key,strlen($key),1);
	} else {
		$y=(int)substr($key,strlen($key)-2,2);

	}
/*	var_dump($x);
echo ", " .
var_dump($y);
echo " <BR />";*/
	$world[$x][$y]=1;
}
$_SESSION['world']=$world;
$_SESSION['turn']=1;
$current_dir= substr(__DIR__, 26, strlen(__DIR__)-26);
$url="http://".$_SERVER['SERVER_NAME']."/".$current_dir."/";
header("Location: $url");
