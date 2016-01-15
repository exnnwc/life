<?php

session_start();
define("SIZE", 25);
define("CELL_SIZE", 20);


if (!isset($_SESSION['turn'])) {
    $_SESSION['turn'] = 0;
    $_SESSION['continue'] = true;
    $_SESSION['world'] = [];
}

