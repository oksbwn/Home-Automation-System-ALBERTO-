<?php
   $m = new MongoClient();
   $db = $m->smart_home;
	$collection = $db->sensors_details;
	$document = array( 
	  "sl_no" => (int)$_GET['NO'], 
	  "sensor_id" => $_GET['ID'], 
	  "board_id" => $_GET['BOARD'],
	  "date" =>  $_GET['DATE'],
	  "sensor_type" =>  $_GET['TYPE']
   );
   $collection->insert($document);
   echo "Sensor inserted successfully";
   file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=web_interface&COMM=New%20sensor%20added.");
?>