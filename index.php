<?php include ("config.php");
?>
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
            <input id='reset' type='button' value='Reset' /> 
            <?php if ($_SESSION['continue']): ?>
                <input class="toggle" type='button' value='Pause'>
            <?php else: ?>
                <input class="toggle" type='button' value='Play'>
            <?php endif ?>
        <?php endif ?>

                Turn:<?php echo isset($_SESSION['turn']) ? $_SESSION['turn'] : ""; ?>
        <div id="world_space"></div>
    </body></html>

<?php
if (isset($_SESSION['turn']) && $_SESSION['turn'] > 0 && $_SESSION['continue'] == true) {
    header("Refresh:2");
}
