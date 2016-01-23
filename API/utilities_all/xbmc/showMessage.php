<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$from=$_GET['FROM'];
	$message=$_GET['MSG'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$from=$_POST['FROM'];
	$message=$_POST['MSG'];
}
include("authenticatedGETCall.php");
echo callXBMC("http://192.168.0.100/jsonrpc?request={%22jsonrpc%22:%222.0%22,%22id%22:1,%22method%22:%22GUI.ShowNotification%22,%22params%22:{%22message%22:%22".urlencode($message)."%22,%22title%22:%22".urlencode($from)."%22,%22displaytime%22:30000}}");
?>