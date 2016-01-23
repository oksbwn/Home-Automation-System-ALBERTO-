<?php
   $m = new MongoClient();
   $db = $m->smart_home;
	$collection = $db->machine_login_informations;
	
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
	  $sl_no= $document["sl_no"]+1;
	}
	$document = array( 
	  "sl_no" => (int)$sl_no, 
	  "machine" => "Desktop", 
	  "date" => date('d/M/Y',time()+12600), 
	  "duration" =>(double) $_POST['TIME'],
	  "time" => date('h:i',time()+12600)
   );
   $collection->insert($document);
   file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=desktop_app&COMM=".urlencode('Login time saved. ').$_POST['TIME']);
?>