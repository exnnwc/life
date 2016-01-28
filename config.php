<?php
define("SIZE", 20);
define("CELL_SIZE", 20);
session_start();
if (!isset($_SESSION['turn'])){
    $_SESSION['turn'] = 0;
	$_SESSION['continue']=true;
    $_SESSION['stop']=false;
	$_SESSION['world']=[];
}
