<?php
include_once ("config.php");
function alive($num_of_neighbors){
	if ($num_of_neighbors < 2 || $num_of_neighbors > 3) {
        	return false;
        } 
	return true;
}

function apply_rules() {
    $new_world=[];
    $_SESSION['last_world'] = $_SESSION['world'];	
    for($x=0;$x<SIZE;$x++) {
        for($y=0;$y<SIZE;$y++) {
    	    $num_of_neighbors=num_of_neighbors($x,$y);
            $new_world[$x][$y]=$_SESSION["world"][$x][$y] ? alive($num_of_neighbors) : dead($num_of_neighbors);
        }
    }
    $_SESSION['world']=$new_world;
    should_it_continue();
}

function dead($num_of_neighbors){
	if ($num_of_neighbors == 3) {
		return true;
    }
	return false;
}

function everything_is_dead() {
    for($x=0;$x<SIZE;$x++) {
        for($y=0;$y<SIZE;$y++) {
            if ($_SESSION["world"][$x][$y]) {
                return false;
            }
        }
    }
    return true;
}

function neighbors($home_x, $home_y) {
    $neighbors = [];
    for ($x=($home_x-1);$x<($home_x+2);$x++){
        for ($y=($home_y-1);$y<($home_y+2);$y++){
    	    if ($x!=$home_x || $y!=$home_y){
        		$coords=["x"=>$x, "y"=>$y];
        		array_push($neighbors, $coords);
    	    }
        }
    }
    return $neighbors;
}

function num_of_neighbors($x, $y) {
    $neighbors = neighbors($x, $y);
    $num = 0;  
    for ($i = 0; $i < 8; $i++) {
        if (isset($_SESSION["world"][$neighbors[$i]["x"]][$neighbors[$i]["y"]]) 
          && $_SESSION["world"][$neighbors[$i]["x"]][$neighbors[$i]["y"]]) {
            $num++;
        }
    }
    return $num;
}

function should_it_continue() {
    $_SESSION['stop'] = ($_SESSION['last_world'] ==$_SESSION['world'] || everything_is_dead());

}
