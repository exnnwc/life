<?php
include("life.php");

    if ($_SESSION['turn'] == 0) {
        echo form();
    } else if ($_SESSION['turn'] > 0) {
        echo world();
//	echo test();
        $_SESSION['turn'] ++;
        apply_rules();
    }

function form() {
    $presets=[];//get_presets();
    $string = "<form method='POST' action='populate.php'><table>";
    for ($y = 0; $y < SIZE; $y++) {
        $string = $string . "<tr>";
        for ($x = 0; $x < SIZE; $x++) {
		
            $string = $string
                    . "<td id ='" . $x . "xy$y' 
                         style='width:" . CELL_SIZE . "px;height:" . CELL_SIZE . "px;border:solid 1px black;'>
				       <input name='" . $x . "xy$y' type='checkbox'  value='$y'";
            foreach ($presets as $preset){
                for ($i=0;$i<sizeof($preset[0]);$i++){
                    if ($preset[0][$i]==$x && $preset[1][$i]==$y){
                        $string = $string . " checked";
                    }
                }
    
            }
            $string = $string . " />
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


function get_presets(){
    $presets=[];
    $x=[];
    $y=[];
    for ($set=0;$set<4;$set++){
        for ($i=0;$i<4;$i++){
            switch ($set){
                case 0:
                    //top left
                    array_push($x,$i);
                    array_push($y,$i);
                    break;
                case 1:
                    //bottom left
                    array_push($x, $i);
                    array_push($y, (SIZE-1)-$i);
                    break;
                case 2:
                    //top right
                    array_push($x, (SIZE-1)-$i);
                    array_push($y,$i);
                    break;
                case 3:
                    //bottom right
                    array_push($x, (SIZE-1)-$i);
                    array_push($y, (SIZE-1)-$i);
                    break;
            }
        }  
    }
    $presets["diagnol-corners"]=[$x,$y];
    return $presets;
}
