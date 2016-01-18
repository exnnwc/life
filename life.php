<?php
include ("config.php");

switch ($_POST['function_to_be_called']) {
    case "display_world":
        display_world();
        break;
    case "reset":
        reset_everything();
        break;
    case "toggle_continue":
        toggle_continue();
        break;
}

function apply_rules() {
    $_SESSION['last_world'] = $_SESSION['world'];

        foreach ($_SESSION["world"] as $x => $arr) {
            foreach ($arr as $y => $val) {
                $num_of_neighbors = num_of_neighbors($x, $y);
                if ($_SESSION["world"][$x][$y]) {
                    if ($num_of_neighbors < 2 || $num_of_neighbors > 3) {
                        $_SESSION["world"][$x][$y] = false;
                    } else {
                        $_SESSION["world"][$x][$y] = true;
                    }
                } else {
                    if ($num_of_neighbors == 3) {
                        $_SESSION["world"][$x][$y] = true;
                    }
                }
            }
        }
}

function display_world() {
    apply_rules();
    should_it_continue();

    if ($_SESSION['turn'] == 0) {
        echo form();
    } else if ($_SESSION['turn'] > 0) {
        echo world();
        $_SESSION['turn'] ++;
    }
}

function form() {
    $string = "<form method='POST' action='populate.php' ><table>";
    for ($y = 0; $y < SIZE; $y++) {
        $string = $string . "<tr>";
        for ($x = 0; $x < SIZE; $x++) {
            $string = $string
                    . "<td id ='" . $x . "xy$y' style='width:" . CELL_SIZE . "px;height:" . CELL_SIZE . "px;border:solid 1px black;'>
				<input name='" . $x . "xy$y' type='checkbox'  value='$y' />
			     </td>";
        }
        $string = $string . "</tr>";
    }
    $string = $string . "</table><input type='submit' /></form>";
    return $string;
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

function reset_everything() {
    $_SESSION['turn'] = 0;
}

function should_it_continue() {
	echo __FUNCTION__ . "<BR />";
    var_dump($_SESSION['continue']);
    $_SESSION['continue'] = ($_SESSION['last_world'] ==$_SESSION['world']) ? false : true;
    var_dump($_SESSION['continue']);
}

function toggle_continue() {
	echo __FUNCTION__ . "\n";
	var_dump($_SESSION['continue']);
    $_SESSION['continue'] = !$_SESSION['continue'];
	var_dump($_SESSION['continue']);
}



function world() {
    $string = "<table id='relevant_table'>";
    for ($y = 0; $y < SIZE; $y++) {
        $string = $string . "<tr>";
        for ($x = 0; $x < SIZE; $x++) {
            $string = $string . "<td id ='" . $x . "xy$y' 
				style='width:" . CELL_SIZE . "px;height:" . CELL_SIZE . "px;border:solid 1px black;'>";
            $string = $_SESSION["world"][$x][$y] ?  $string ."O" : $string .""; // "($x, $y)";
            $string = $string . "</td>";
        }
        $string = $string . "</tr>";
    }
    $string = $string . "</table>";
    return $string;
}
