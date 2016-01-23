<?php
   $m = new MongoClient();
   $db = $m->smart_home;
	$collection = $db->food_details;
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
	  $sl_no= $document["sl_no"]+1;
	}
	$document = array( 
	  "sl_no" => (int)$sl_no, 
	  "image" => $_GET['IMG'], 
	  "food" => $_GET['NAME'], 
	  "calorie" => $_GET['CAL'],
	  "type" =>  $_GET['TYPE'],
	  "date" =>  $_GET['DATE']
   );
   $collection->insert($document);
   echo "Food added successfully";
   file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=web_interface&COMM=New%20food%20added.");
?>