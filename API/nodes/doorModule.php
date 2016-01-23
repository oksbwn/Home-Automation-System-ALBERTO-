<?php
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$board_id= $_POST['ID'];
	}
	if($_SERVER['REQUEST_METHOD']=="GET")
	{
		$board_id= $_GET['ID'];
	}  
	//Miscellaneous
	$m = new MongoClient();
	$date=date('d/M/Y',time()+12600);
	$time=date('H:i',time()+12600);
	//Add Sensor Data
	if(substr($time,4,1)=="9")//Insert data after 10 mins
	{
		$db = $m->smart_home->sensors_details;
		$val = $db->find(array('board_id' =>$board_id))->sort(array('sl_no' => 1));
		foreach ($val as $document) {//Get all Sensors on the board
			//Get the Highest Serial No
			$sensorData = $m->smart_home->sensors_data;
			$valData = $sensorData->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
			$sl_no=0;
			foreach ($valData as $doc) {
				$sl_no= $doc["sl_no"];
			}
			//Prepare the Sensor Data
			$docu = array( 
				  "sl_no" => ($sl_no+1), 
				  "sensor_id" =>  $document['sensor_id'], 
				  "value" => $_POST[$document['sensor_id']],
				  "date" =>$date,
				  "time" =>$time
				);
			//Check if the data exist to insert if not
			$toInsert=0;
			$valGet = $sensorData->find(array("sensor_id" =>  $document['sensor_id'], "time" =>$time,"date"=>$date))->sort(array('sl_no' => 1));
			foreach ($valGet as $docData) {
				$toInsert=1;
			}
			if($toInsert==0)
				$sensorData->insert($docu);
		}
	}
	//Check if Input Changed
	$outputDb = $m->smart_home->board_output_details;
	if($_POST['IN0']=='O')
	{
		file_get_contents("http://192.168.0.1/smart_home/API/utilities_all/storeCurrentLoadStatus.php?WHAT=0&DEVICE=door_module");	
	}
	if($_POST['IN1']=='O')
	{	
		file_get_contents("http://192.168.0.1/smart_home/API/utilities_all/storeCurrentLoadStatus.php?WHAT=1&DEVICE=door_module");	
	}
	echo '$@##';
?>