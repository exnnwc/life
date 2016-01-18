<?php include ("config.php");
var_dump ($_SESSION['continue']); ?>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $(".toggle").on("click", function () {
                    toggle_continue();
                });
            });
            function test() {
                document.write("Test.");
            }
            function displayWorld() {
                $.ajax({
                    method: "POST",
                    url: "life.php",
                    data: {function_to_be_called: "display_world"}
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
                            displayWorld();
                        });
            }
            function toggle_continue() {
                $.ajax({
                    method: "POST",
                    url: "life.php",
                    data: {function_to_be_called: "toggle_continue"}
                })
                        .done(function (result) {
				console.log(result);
				//window.location.href="<?php echo $_SERVER['PHP_SELF']; ?>";	
	
                        });

            }
		function reload(){
			location.reload();
		}
        </script>
    </head>
    <body onload="displayWorld()">
        <?php if ($_SESSION['turn'] > 0): ?>
            <input type='button' value='Reset' onclick="reset();" /> 
            <?php if ($_SESSION['continue']): ?>
                <input class="toggle" type='button' value='Pause'>
            <?php else: ?>
                <input class="toggle" type='button' value='Play'>
            <?php endif ?>
        <?php endif ?>
                Turn:<?php echo isset($_SESSION['turn']) ? $_SESSION['turn'] : ""; ?>
        <input type='button' onclick="reload()" />       
        <div id="world_space"></div>
    </body></html>
<?php
if (isset($_SESSION['turn']) && $_SESSION['turn'] > 0 && $_SESSION['continue'] == true) {
    header("Refresh:2");
}
