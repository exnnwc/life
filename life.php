<?php
include ("config.php");
switch ($_POST['function_to_be_called']) {
    case "reset":
        reset_everything();
        break;
    case "set_continue":
        set_continue(filter_input(INPUT_POST, "continue_var", FILTER_VALIDATE_BOOLEAN));
        break;
}

function alive($num_of_neighbors){
	if ($num_of_neighbors < 2 || $num_of_neighbors > 3) {
        	return false;
        } 
	return true;
}

function apply_rules() {
    $_SESSION['last_world'] = $_SESSION['world'];
    foreach ($_SESSION["world"] as $x => $arr) {
        foreach ($arr as $y => $val) {
    	    $num_of_neighbors=num_of_neighbors($x,$y);
            $_SESSION["world"][$x][$y] = $_SESSION["world"][$x][$y] ? alive($num_of_neighbors) : dead($num_of_neighbors);
        }
    }
    should_it_continue();
}

function dead($num_of_neighbors){
	if ($num_of_neighbors == 3) {
		return true;
        }
	return false;
}



function is_everything_dead() {
    foreach ($_SESSION["world"] as $x => $arr) {
        foreach ($arr as $y => $val) {
            if ($_SESSION["world"][$x][$y]) {
                return false;
            }
        }
    }
    return true;
}


function neighbors($home_x, $home_y) {
    $neighbors = array();
    $x = $home_x - 1;
    $y = $home_y - 1;
    for ($i = 0; $i < 8; $i++) {
        if ($x == $home_x && $x == $home_y) {
            $x++;
        }
        $neighbors[$i]["x"] = $x;
        $neighbors[$i]["y"] = $y;
        if ($x + 1 > $home_x + 1) {
            $x = $home_x - 1;
            $y++;
        } else {
            $x++;
        }
    }
    return $neighbors;
}

function num_of_neighbors($x, $y) {
    $neighbors = neighbors($x, $y);
    $num = 0;
    for ($i = 0; $i < 8; $i++) {
        if (isset($_SESSION["world"][$neighbors[$i]["x"]][$neighbors[$i]["y"]]) && $_SESSION["world"][$neighbors[$i]["x"]][$neighbors[$i]["y"]] > 0) {
            $num++;
        }
    }
    return $num;
}

function reset_everything() {
    $_SESSION['turn'] = 0;
	echo "CHECK";
}

function should_it_continue() {
    $_SESSION['continue'] = ($_SESSION['last_world'] ==$_SESSION['world']) ? false : true;
}

function set_continue($continue) {
    $_SESSION['continue'] = $continue;
}
