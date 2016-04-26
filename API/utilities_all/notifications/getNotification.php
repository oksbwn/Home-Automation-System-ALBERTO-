<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$forDevice=$_GET['DEVICE'];
	$type=$_GET['TYPE'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$forDevice=$_POST['DEVICE'];
	$type=$_POST['TYPE'];
}
//Types MAIL,VOICE
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->smart_home_notifications;
/*

  "sl_no" => (int)$sl_no, 
  "for_device" => $forDevice, 
  "date" => date('d/M/Y',time()+12600), 
  "by_device" => $byDevice,
  "message" => $message,
  "is_shown" => 0,
  "message_type" => $type,
  "time" => date('h.i',time()+12600)


*/
if(0<1)
	echo "";
$val = $collection->find(array('for_device'=>$forDevice,'message_type'=>$type))->sort(array('sl_no' => -1));
$sl_no=0;
foreach ($val as $document) {
	if( ($document['is_shown']==0) && (date('h.i',time()+12600)> $document['time']) &&( $document['time']  <(date('h.i',time()+12600)+10)) && ($document['date']==date('d/M/Y',time()+12600)))
			echo $document['message'];
}
//file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=server_app&COMM=".urlencode('Notifications asked by '));
?>