<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$forDevice=$_GET['FOR'];
	$byDevice=$_GET['FROM'];
	$message=$_GET['MSG'];
	 $type=$_GET['TYPE'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$forDevice=$_POST['FOR'];
	$byDevice=$_POST['FROM'];
	$message=$_POST['MSG'];
	 $type=$_POST['TYPE'];
}
//Types MAIL,VOICE
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->smart_home_notifications;

$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
$sl_no=0;
foreach ($val as $document) {
  $sl_no= $document["sl_no"]+1;
}
$document = array( 
  "sl_no" => (int)$sl_no, 
  "for_device" => $forDevice, 
  "date" => date('d/M/Y',time()+12600), 
  "by_device" => $byDevice,
  "message" => $message,
  "is_shown" => 0,
  "message_type" => $type,
  "time" => date('h.i',time()+12600)
);
$collection->insert($document);
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=server_app&COMM=".urlencode('New notification added.'));
?>