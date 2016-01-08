<html>
<head>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
function displayWorld(turn){
	$.ajax({
		method:"POST",
		url:"life.php",
		data:{function_to_be_called:"display_world", turn:turn}
	})
		.done(function (result){
			$("#world_space").html(result);	
		});
}

function resetSession(){
displayWorld(0);
	/*$.ajax({
		method:"POST",
		url:"life.php",
		data:{function_to_be_called:"reset_session"}
	})
		.done (displayWorld(0));*/
}	
function test(){
	$("#world_space").html("Test");
}
</script>
</head>
<body onload="displayWorld(
<?php 
session_start();
$_SESSION['turn']=3;
if (isset($_SESSION['turn'])){
	echo $_SESSION['turn'];
} else { 
	echo "0"; 
}
?>
			     )">
<input type='button' value='Reset' onclick="resetSession();" />
<div id="world_space"></div>
</body></html>
