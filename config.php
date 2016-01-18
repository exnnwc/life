<?php

session_start();
define("SIZE", 20);
define("CELL_SIZE", 20);

if (!isset($_SESSION['turn'])){
    $_SESSION['turn'] = 0;
}
if (!isset($_SESSION['continue'])){
	 $_SESSION['continue']=true;
}

if (!isset($_SESSION['world'])){
	 $_SESSION['world']=[];
}


