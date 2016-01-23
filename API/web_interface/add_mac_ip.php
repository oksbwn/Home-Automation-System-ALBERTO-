<?php
   $m = new MongoClient();
   $db = $m->smart_home;
	$collection = $db->mac_and_ip;
	$document = array( 
	  "sl_no" => (int)$_GET['NO'], 
	  "machine" => $_GET['COMM'], 
	  "machine_ip" => $_GET['IP'],
	  "machine_mac" =>  $_GET['MAC'],
	  "date" =>  $_GET['DATE']
   );
   $collection->insert($document);
   echo "MAC ID and IP added successfully";
   file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=web_interface&COMM=New%20MAC%20and%20IP%20added.");
?>