<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$status=$_GET['STATUS'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$status=$_POST['STATUS'];
}
   $m = new MongoClient();
   $db = $m->smart_home;
	$collection = $db->smart_home_alram_day_status;
	
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
	  $sl_no= $document["sl_no"]+1;
	}
	$document = array( 
	  "sl_no" => (int)$sl_no,
	  "date" => date('d/M/Y',time()+16200), 
	  "status" =>$status
   );
   $collection->insert($document);
	file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=server_interface&COMM=".urlencode('Today alram status changed to ').$status);
?>