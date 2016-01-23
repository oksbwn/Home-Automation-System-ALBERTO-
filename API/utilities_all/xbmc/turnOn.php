<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$what=$_GET['WHAT'];
	$interfaceDevice=$_GET['DEVICE'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$what=$_POST['WHAT'];
	$interfaceDevice=$_POST['DEVICE'];
}
$m = new MongoClient();
$boardOutputsDb = $m->smart_home->board_output_details;
$load="XBMC";
$regex =new MongoRegex("/$load/i");
if($what==0)				
	$boardOutputsDb->update(array('name'=>$regex), array('$set'=>array("status"=>'F')));
else if($what==1)				
	$boardOutputsDb->update(array('name'=>$regex), array('$set'=>array("status"=>'O')));

file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=".$interfaceDevice."&COMM=".urlencode("XBMC has been toggled."));	
?>