<?php
include("life.php");
    if ($_SESSION['turn'] == 0) {
        echo form();
    } else if ($_SESSION['turn'] > 0) {
        echo world();
//	echo test();
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

function test() {
	$arr=[];
    for ($y = 0; $y < SIZE; $y++) {
        for ($x = 0; $x < SIZE; $x++) {
		if ($_SESSION["world"][$x][$y]){
			$cell=["($x, $y)", num_of_neighbors($x, $y)];
			array_push($arr,$cell);	 
//			array_push($arr, neighbors($x, $y));
		}
        }
   }
    $string="<PRE>". var_dump($arr) . "</PRE>";
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
