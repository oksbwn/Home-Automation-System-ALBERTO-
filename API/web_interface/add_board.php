<?php
   $m = new MongoClient();
   $db = $m->smart_home;
	$collection = $db->board_details;
	$document = array( 
	  "sl_no" => (int)$_GET['NO'], 
	  "out_pins" => $_GET['OUT'], 
	  "id" => $_GET['ID'], 
	  "in_pins" => $_GET['IN'],
	  "in_sensors" =>  $_GET['SENS'],
	  "mac_id" =>  $_GET['MAC'],
	  "board_ip" =>  $_GET['IP'],
	  "board_type" =>  $_GET['TYPE'],
	  "date" =>  $_GET['DATE'],
	  "status" => "Active",
	  "comments" =>  $_GET['COMM']
   );
   $collection->insert($document);
   
   //Board output Details.
   	$collection = $db->board_output_details;
	$i=$_GET['OUT'];
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
	  $sl_no= $document["sl_no"]+1;
	}
	$count=0;
	while($count<$i)
	{
		$document = array( 
		  "sl_no" => (int)$sl_no, 
		  "out_pin" => "OUT".$count, 
		  "id" => $_GET['ID'], 
		  "status" => 'O',
		  "date_update" =>  $_GET['DATE'],
		  "location" =>  "Room",
		  "image" =>  "bulb",
		  "name" =>  "bulb",
		  "comments" =>  $_GET['COMM']
	   );
	   $collection->insert($document);
	   $count++;
	   $sl_no++;
   }
   
   //Board Input Details
    $collection = $db->board_input_details;
	$i=$_GET['IN'];
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
	  $sl_no= $document["sl_no"]+1;
	}
	$count=0;
	while($count<$i)
	{
		$document = array( 
		  "sl_no" => (int)$sl_no, 
		  "in_pin" => "IN".$count, 
		  "id" => $_GET['ID'],
		  "date_update" =>  $_GET['DATE'],
		  "output_effected_sl_no" =>0,
		  "comments" =>  $_GET['COMM']
	   );
	   $collection->insert($document);
	   $count++;
	   $sl_no++;
   }
   
   //Add MAC and IP to IP table
	$collection = $db->mac_and_ip;
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
	  $sl_no= $document["sl_no"]+1;
	}

	$document = array( 
	  "sl_no" => (int)$sl_no, 
	  "machine_ip" => $_GET['IP'], 
	  "machine_mac" => $_GET['MAC'],
	  "date" =>  $_GET['DATE'],
	  "machine" =>  $_GET['COMM']
   );
   $collection->insert($document);
   file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=web_interface&COMM=New%20node%20added.");
?>