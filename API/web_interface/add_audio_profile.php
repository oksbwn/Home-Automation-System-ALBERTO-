<?php
   $m = new MongoClient();
   $db = $m->smart_home;
	$collection = $db->smart_home_audio_profiles;
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
	  $sl_no= $document["sl_no"]+1;
	}
	$document = array( 
	  "sl_no" => (int)$sl_no, 
	  "name" => $_GET['NAME'], 
	  "sequence" => $_GET['SEQ'], 
	  "profile_id" =>(int)$sl_no,
	  "input" =>  $_GET['IN'],
	  "output" =>  $_GET['OUT'],
	  "is_active" => 0,
	  "profile_image" =>  $_GET['IMG'],
	  "date" =>  $_GET['DATE']
   );
   $collection->insert($document);
   echo "Profile added successfully";
   file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=web_interface&COMM=").urlencode("New Audio Profile Added");
?>