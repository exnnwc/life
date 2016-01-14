<?php
include ("config.php");
switch ($_POST['function_to_be_called']){
	case "display_world":
		display_world();
		break;
	case "reset":
		reset_everything();
		break;
}
function apply_rules($world, $max_turns ){
	for ($turn=1;$turn<=$max_turns;$turn++){
		foreach($world as $x=>$arr){
			foreach($arr as $y=>$val){
				$num_of_neighbors=num_of_neighbors($world,$x,$y);
				if ($world[$x][$y]){
					if($num_of_neighbors<2 || $num_of_neighbors>3){
						$world[$x][$y]=false;
					} else {
						$world[$x][$y]=true;
					}	
				} else {
					if ($num_of_neighbors==3){
						$world[$x][$y]=true;
					}
				}	
			}		
		}
	}
	return $world;
}

function form(){
	$string=  "<form method='POST' action='populate.php' ><table>";
	for ($y=0;$y<SIZE;$y++){
		$string=$string .  "<tr>";
		for ($x=0;$x<SIZE;$x++){
			$string=$string 
			  . "<td id ='".$x."xy$y' style='width:".CELL_SIZE."px;height:".CELL_SIZE."px;border:solid 1px black;'>
				<input name='".$x."xy$y' type='checkbox'  value='$y' />
			     </td>";	
		}
		$string=$string .  "</tr>";
	}
	$string=$string .  "</table><input type='submit' /></form>";
	return $string;

}

function world($world){
	$string="<table id='relevant_table'>";
	for ($y=0;$y<SIZE;$y++){
		$string=$string .  "<tr>";
		for ($x=0;$x<SIZE;$x++){
			$string=$string . "<td id ='".$x."xy$y' 
				style='width:".CELL_SIZE."px;height:".CELL_SIZE."px;border:solid 1px black;'>";
			$world[$x][$y]
				?$string=$string . "O":"";// "($x, $y)";
			$string=$string .  "</td>";	
		}
		$string=$string .  "</tr>";
	}
	$string=$string .  "</table>";
	return $string;

}
function display_world(){
	$turn=0;
	if (isset($_SESSION['turn'])){
		$turn=$_SESSION['turn'];
	} 
	if (isset($_SESSION['world'])) {
		$world=$_SESSION['world'];
	} else {
		$world=[];
	}
	if ($turn>1){
		$world=apply_rules($world, $turn);
	}
	if ($turn==0){
		echo form();
	} else if ($turn>0){
		echo world($world);
	}
	$turn=$_SESSION['turn'];
	if ($turn>0){
		$_SESSION['turn']++;
	}
	//come back and later do turn incrementing
}

function num_of_neighbors($world, $x, $y){
	$neighbors=neighbors($x, $y);	
	$num=0;
	for($i=0;$i<8;$i++){
		
		if (isset($world[$neighbors[$i]["x"]][$neighbors[$i]["y"]]) && $world[$neighbors[$i]["x"]][$neighbors[$i]["y"]]>0){
			$num++;
		} 
	}	
	return $num;
}
function neighbors($home_x, $home_y){
	$neighbors=array();
	$x=$home_x-1;
	$y=$home_y-1;
	for ($i=0;$i<8;$i++){
		if($x==$home_x && $x==$home_y){
			$x++;
		} 
			$neighbors[$i]["x"]=$x;
			$neighbors[$i]["y"]=$y;
		if ($x+1>$home_x+1){
			$x=$home_x-1;
			$y++;
		} else {
			$x++;
		}
	}
	return $neighbors;	
}

function reset_everything(){
	$_SESSION['turn']=0;
}
function toggle_continue(){
	$_SESSION=!$_SESSION['continue'];  
}
