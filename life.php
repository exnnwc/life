<?php
session_start();
switch ($_POST['function_to_be_called']){
	case "display_world":
		display_world($_POST['turn']);
		break;
}
function apply_rules($world, $max_turns ){
	for ($turn=1;$turn<=$max_turns;$turn++){
		foreach($world as $x=>$arr){
			foreach($arr as $y=>$val){
				$num_of_neighbors=num_of_neighbors($world,$x,$y);
				if ($world[$x][$y]>0){
					if($num_of_neighbors<2 || $num_of_neighbors>3){
						$world[$x][$y]--;
					} else {
						$world[$x][$y]++;
					}	
				} else {
					if ($num_of_neighbors==3){
						$world[$x][$y]--;
					}
				}	
			}		
		}
	}
	return $world;
}
function display_world($turn){
	if (isset($_SESSION['world'])) {
		$world=$_SESSION['world'];
	}
	if ($turn>1){
		$world=apply_rules($world, $turn);
	}
	if ($turn==0){
		$string=  "<form method='POST' action='populate.php' ><table>";
	} else {
		$string="<table>";
	}
	foreach ($world as $x => $arr){
	$string=$string .  "<tr>";
		foreach ($arr as $y=>$val){
			$string=$string . "<td>";
			if ($turn==0){
				$string=$string .  "<input name='".$x."xy$y' type='checkbox'  value='$y' />";
			} else {
				$string=$string .  $world[$x][$y];
			}
			$string=$string .  "</td>";	
		}
		$string=$string .  "</tr>";
	}
	$string=$string .  "</table>";

	if ($turn==0){
		$string=$string .  "<input type='submit' /></form>";
	}
	echo $string;
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

