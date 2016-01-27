<?php
    include_once ("config.php");
    if ($_POST['continue']=="true"){
        $_SESSION['continue']=true;
    } else if ($_POST['continue']=='false'){
        $_SESSION['continue']=false;
    }

    header("Location:index.php" );
