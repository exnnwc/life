<?php
    include_once ("config.php");
    $_SESSION['continue']=json_decode($_POST['continue']);
    header("Location:index.php" );
