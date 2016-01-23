<?php

$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->my_phone_call_informations;

if($_SERVER['REQUEST_METHOD']=="GET"){
	$phoneNo=$_GET['NO'];
	$status=$_GET['STAT'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$phoneNo=$_POST['NO'];
	$status=$_POST['STAT'];
}

$time = date('H:i',time()+12600);
$date = date('d/M/Y',time()+12600);

$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
$sl_no=0;
foreach ($val as $document) {
  $sl_no= $document["sl_no"]+1;
}
$val = $collection->find(array('phone_no'=>$phoneNo))->sort(array('sl_no' => -1))->limit(1);
foreach ($val as $document) {
  $no_of_times_talked= $document["no_of_times_talked"]+1;
}
//switch off woofer


//
switch($status){
case 1://Incoming Call  //
		$document = array( 
		"sl_no" => $sl_no, 
		"phone_no" => $phoneNo, 
		"no_of_times_talked" =>(int)$no_of_times_talked, 
		"last_called_on_date" =>$date,
		"call_type" => "IN",
		"last_called_on_time" => $time,
		"is_call_notified" => "No"
	   );
	   $collection->insert($document);
	break;
case 2://Outgoing Call
		$document = array( 
		"sl_no" => $sl_no, 
		"phone_no" => $phoneNo, 
		"no_of_times_talked" =>(int)$no_of_times_talked, 
		"last_called_on_date" =>$date,
		"call_type" => "OUT",
		"last_called_on_time" => $time,
		"is_call_notified" => "Yes"
	   );
	   $collection->insert($document);
	   break;
case 3://Outgoing Call
	//Switch on Woofer
	break;
}
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('New call detected.'));
?>