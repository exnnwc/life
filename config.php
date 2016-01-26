<?php

session_start();
define("SIZE", 20);
define("CELL_SIZE", 20);
define("ROOT_DIRS", substr( $_SERVER['PHP_SELF'], 0, strrpos( $_SERVER['PHP_SELF'], "/")) . "/");
define ("SITE_ROOT", $_SERVER['SERVER_NAME'].ROOT_DIRS);

if (!isset($_SESSION['turn'])){
    $_SESSION['turn'] = 0;
}
if (!isset($_SESSION['continue'])){
	 $_SESSION['continue']=true;
}

if (!isset($_SESSION['world'])){
	 $_SESSION['world']=[];
}


