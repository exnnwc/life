<?php include_once ("config.php");?>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>
            $(document).ready(function () {
                displayWorld();
            });
            function displayWorld() {
                $.ajax({
                    method: "POST",
                    url: "display.php",
                })
                        .done(function (result) {
                            $("#world_space").html(result);
                        });
            }
        </script>
    </head>
    <body>
        <?php if ($_SESSION['turn'] > 0): ?>
            
            <form style='float:left' action='reset.php' method='post'>
            <input id='reset' type='submit' value='Reset' /> 
            </form>
            <form  style='float:left' action='continue.php' method='post'>
            <?php if ($_SESSION['continue'] && !$_SESSION['stop']): ?>
                <input name='continue' type='hidden' value='false' />
                <input class="toggle" type='submit' value='Pause'>
            <?php elseif (!$_SESSION['continue'] && !$_SESSION['stop']): ?>
                <input name="continue" type='hidden' value='true' />
               <input class="toggle" type='submit' value='Play'>
            <?php elseif ($_SESSION['stop']): ?>
                Dead.
            <?php endif ?>
            </form>
        <?php endif ?>
                Turn:<?php echo $_SESSION['turn']; ?>
        <div style='clear:both;'  id="world_space"></div>
    </body>
</html>
<?php
if ($_SESSION['turn'] > 0 && $_SESSION['continue'] == true && !$_SESSION['stop']) {
    header("Refresh:1");
}
