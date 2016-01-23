<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$status=$_GET['STATUS'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$status=$_POST['STATUS'];
}
$con=mysqli_connect("localhost","root","","alberto");
if($status==0){//Make sound to TV
	$updateQuery="UPDATE `soundmodule` SET `stat` = '7' WHERE `Sl_No` =1;";
	if (!mysqli_query($con,$updateQuery))
	{
		die('Error: ' . mysqli_error($con));
	}
 }
else if($status==1){//Take Sound for Server
	$updateQuery="UPDATE `soundmodule` SET `stat` = '6' WHERE `Sl_No` =1;";
	if (!mysqli_query($con,$updateQuery))
	{
		die('Error: ' . mysqli_error($con));
	}
}
mysqli_close($con);
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=server_interface&COMM=".urlencode('Audio status changed by Alram Manager to ').$status);
?>