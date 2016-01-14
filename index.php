<?php include ("config.php"); ?>
<html>
<head>
<script src="http://localhost/jquery-2.1.4.min.js"></script>
<script>
function displayWorld(){
	$.ajax({
		method:"POST",
		url:"life.php",
		data:{function_to_be_called:"display_world"}
	})
		.done(function (result){
			$("#world_space").html(result);	
		});
}
function reset(){
	$.ajax({
		method:"POST",
		url:"life.php",
		data:{function_to_be_called:"reset"}
	})
		.done(function(result){
			displayWorld();
		});
}
</script>
</head>
<body onload="displayWorld()">
Turn:<?php echo isset($_SESSION['turn'])? $_SESSION['turn']:"";?>
<?php if ($_SESSION['turn']>0):?>
<input type='button' value='Reset' onclick="reset();" /> 
	<?php if ($_SESSION['continue']):?>
	<input type='button' value='Pause'>
	<?php else:?>
	<input type='button' value='Play'>
	<?php endif?>
<?php endif ?>
<div id="world_space"></div>
</body></html>
<?php 
if (isset($_SESSION['turn']) && $_SESSION['turn']>0 && $_SESSION['continue']==true){
		header("Refresh:2");
	}
