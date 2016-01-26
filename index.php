<?php include ("config.php");?>
<html>
    <head>
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Expires" content="-1">
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $(".toggle").on("click", function () {
        			if ($(".toggle").val()=="Pause"){
        				continue_val=false;
        			} else if ($(".toggle").val()=="Play"){
        				continue_val=true;
        			}
                    set_continue(continue_val);
                });
                $("#reset").on("click", function(){
                    reset();
                });
                
            });

            function displayWorld() {
                $.ajax({
                    method: "POST",
                    url: "display.php",
                    data: {function_to_be_called: "display"}
                })
                        .done(function (result) {
                            $("#world_space").html(result);
                        });
            }
/*
            function reset() {
                $.ajax({
                    method: "POST",
                    url: "life.php",
                    data: {function_to_be_called: "reset"}
                })
                        .done(function (result) {
				console.log("RESET");
                            displayWorld();
                        });
            }
*/
            function set_continue(continue_val) {
                $.ajax({
                    method: "POST",
                    url: "life.php",
                    data: {function_to_be_called: "set_continue", continue_var:continue_val}
                })
                        .done(function (result) {
				console.log(result);
				location.reload(true);	
                        });
            }

            function test() {
                document.write("Test.");
            }
        </script>
    </head>
    <body onload="displayWorld()">
	<div>
	</div>

        <?php if ($_SESSION['turn'] > 0): ?>
            <form action='reset.php' method='post'>
            <input id='reset' type='submit' value='Reset' /> 
            </form>
            <form action='continue.php' method='post'>
            <?php if ($_SESSION['continue']): ?>
                <input name='continue' type='hidden' value='false' />
                <input class="toggle" type='submit' value='Pause'>
            <?php else: ?>
                <input name="continue" type='hidden' value='true' />
               <input class="toggle" type='submit' value='Play'>
            <?php endif ?>
            </form>
        <?php endif ?>
                Turn:<?php echo isset($_SESSION['turn']) ? $_SESSION['turn'] : ""; ?>
        <div id="world_space"></div>
    </body></html>
<?php
if (isset($_SESSION['turn']) && $_SESSION['turn'] > 0 && $_SESSION['continue'] == true) {
    header("Refresh:2");
}
