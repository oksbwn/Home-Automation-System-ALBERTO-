<?php
   $m = new MongoClient();
   $db = $m->smart_home;
	$collection = $db->my_smart_home_profiles;
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
	  $sl_no= $document["sl_no"]+1;
	}
	$document = array( 
	  "sl_no" => (int)$sl_no, 
	  "devices_to_be_off" => $_GET['OFF'], 
	  "devices_to_be_on" => $_GET['ON'], 
	  "for_device" => $_GET['FOR'],
	  "profile_image" =>  $_GET['IMG'],
	  "Status" => 0,
	  "profile_name" =>  $_GET['NAME'],
	  "date" =>  $_GET['DATE']
   );
   $collection->insert($document);
   echo "Profile added successfully";
   file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=web_interface&COMM=New%20Device%20Profile%20Added.");
?>