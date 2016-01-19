<?php
include("life.php");
include ("config.php");
    if ($_SESSION['turn'] == 0) {
        echo form();
    } else if ($_SESSION['turn'] > 0) {
        echo world();
        $_SESSION['turn'] ++;
    }
    apply_rules();

function form() {
    $string = "<form method='POST' action='populate.php'><table>";
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

function world() {
    $string = "<table id='relevant_table'>";
    for ($y = 0; $y < SIZE; $y++) {
        $string = $string . "<tr>";
        for ($x = 0; $x < SIZE; $x++) {
            $string = $string . "<td id ='" . $x . "xy$y' 
				style='width:" . CELL_SIZE . "px;height:" . CELL_SIZE . "px;border:solid 1px black;";
            $string = $_SESSION["world"][$x][$y] ?  $string ."background-color:black;" : $string ."";
            $string = $string . "'></td>";
        }
        $string = $string . "</tr>";
    }
    $string = $string . "</table>";
    return $string;
}
