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
	if(substr($time,4,1)=="0")//Insert data after 10 mins
	{
		$db = $m->smart_home->sensors_details;
		$val = $db->find(array('board_id' =>$board_id))->sort(array('sl_no' => 1));
		foreach ($val as $document) {//Get all Sensors on the board
			//Get the Highest Serial No
			$sensorData = $m->smart_home->sensors_data;
			$valSensor = $sensorData->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
			$sl_no=0;
			foreach ($valSensor as $doc) {
				$sl_no= $doc["sl_no"];
				echo $sl_no;
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
	echo '$@##';
	//Check if Input Changed
	$db = $m->smart_home->board_input_details;
	$outputDb = $m->smart_home->board_output_details;
	$val = $db->find(array('id' =>$board_id))->sort(array('sl_no' => 1));
	foreach ($val as $document) {
		if($_POST[$document['in_pin']]=='O'){
			$output_load = $outputDb->find(array('sl_no' => $document['output_effected_sl_no']));
			foreach ($output_load as $doc) {
				if($doc['status']=='O')	
				{
					$outputDb->update(array("sl_no"=>$document['output_effected_sl_no']), array('$set'=>array("status"=>"F")));
				}
				else if($doc['status']=='F')
				{
					$outputDb->update(array("sl_no"=>$document['output_effected_sl_no']), array('$set'=>array("status"=>"O")));
				}
			}
		}
	}
	//OUTPUT To the Board
	$val = $outputDb->find(array('id' =>$board_id))->sort(array('sl_no' => 1));
	$output_status='';
	foreach ($val as $document) {
		$output_status=$output_status.$document['status'];
	}
	echo $output_status.$time;
?>