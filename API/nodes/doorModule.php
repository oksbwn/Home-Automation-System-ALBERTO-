<?php
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$board_id= $_POST['ID'];
		$rfidTag= $_POST['TAG'];
		$in1= $_POST['IN1'];
		$in0= $_POST['IN0'];
	}
	if($_SERVER['REQUEST_METHOD']=="GET")
	{
		$board_id= $_GET['ID'];
		$rfidTag= $_GET['TAG'];
		$in1= $_GET['IN1'];
		$in0= $_GET['IN0'];
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
	//Get current Profile
	$myHomeProfileStatus=0;
	$profileDb = $m->smart_home->my_smart_home_profiles;
	$profile = $profileDb->find(array('Status' =>1))->limit(1);
	foreach ($profile as $doc) 
	{
		echo $doc['profile_name'];
		if($doc['profile_name']=='Out')
			$myHomeProfileStatus=0;
		else
			$myHomeProfileStatus=1;
	}
	//RFID Card Swapped
	$foundActiveUser=false;
	$usersDb = $m->smart_home->smart_home_users;
	$user = $usersDb->find(array('rfid_tag' =>substr($rfidTag,0,12)))->limit(1);
	foreach ($user as $document) 
	{
		$foundActiveUser=true;
		curl_get_file_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=door_module&COMM=".urlencode(''.$document['user'].'Swiped the Card'));
		//file_get_contents();
	}
	if($foundActiveUser){
		if($myHomeProfileStatus==0){//Out Detected Do In
			$profileDb->update(array(),array('$set'=>array("Status"=>0)), array('multiple' => true)); //All profile Deactivated
			$profileDb->update(array("profile_name"=>'In'), array('$set'=>array("Status"=>1))); //Change Status
			$usersDb->update(array('rfid_tag' =>substr($rfidTag,0,12)), array('$set'=>array("is_active"=>1,"last_used"=>$date))); //Change Status
			curl_get_file_contents("http://192.168.0.1/smart_home/API/utilities_all/storeCurrentLoadStatus.php?WHAT=1&DEVICE=door_module");		
			curl_get_file_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=door_module&COMM=".urlencode('Profile In Selected by RFID'));
		}
		else if($myHomeProfileStatus==1){//In Detected Do Out
			$profileDb->update(array(),array('$set'=>array("Status"=>0)), array('multiple' => true)); //All profile Deactivated
			$profileDb->update(array("profile_name"=>'Out'), array('$set'=>array("Status"=>1))); //Change Status
			$usersDb->update(array('rfid_tag' =>substr($rfidTag,0,12)), array('$set'=>array("is_active"=>0,"last_used"=>$date))); //Change Status
			curl_get_file_contents("http://192.168.0.1/smart_home/API/utilities_all/storeCurrentLoadStatus.php?WHAT=0&DEVICE=door_module");	
			curl_get_file_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=door_module&COMM=".urlencode('Profile In Selected by RFID'));
		}
	}
	//Check if Input Changed
	$outputDb = $m->smart_home->board_output_details;
	if($in0=='O')
	{
		if($myHomeProfileStatus==1){
			$profileDb->update(array(),array('$set'=>array("Status"=>0)), array('multiple' => true)); //All profile Deactivated
			$profileDb->update(array("profile_name"=>'Out'), array('$set'=>array("Status"=>1))); //Change Status
			curl_get_file_contents("http://192.168.0.1/smart_home/API/utilities_all/storeCurrentLoadStatus.php?WHAT=0&DEVICE=door_module");	
			$usersDb->update(array('user' =>'Bikash'), array('$set'=>array("is_active"=>0,"last_used"=>$date))); //Change Status	
			curl_get_file_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=door_module&COMM=".urlencode('Profile Out Selected from Keypad'));
		}
	}
	if($in1=='O')
	{	
		if($myHomeProfileStatus==0){
			$profileDb->update(array(),array('$set'=>array("Status"=>0)), array('multiple' => true)); //All profile Deactivated
			$profileDb->update(array("profile_name"=>'In'), array('$set'=>array("Status"=>1))); //Change Status
			curl_get_file_contents("http://192.168.0.1/smart_home/API/utilities_all/storeCurrentLoadStatus.php?WHAT=1&DEVICE=door_module");	
			$usersDb->update(array('user' =>'Bikash'), array('$set'=>array("is_active"=>1,"last_used"=>$date))); //Change Status	
			curl_get_file_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=door_module&COMM=".urlencode('Profile In Selected from Keypad'));
		}
	}
	
	
	//Get current Profile
	$myHomeProfileStatus=0;
	$profileDb = $m->smart_home->my_smart_home_profiles;
	$profile = $profileDb->find(array('Status' =>1))->limit(1);
	foreach ($profile as $doc) 
	{
		if($doc['profile_name']=='Out')
			$myHomeProfileStatus=0;
		else
			$myHomeProfileStatus=1;
	}
	echo '$@##'.$myHomeProfileStatus.$rfidTag;
	
	function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
            else return FALSE;
    } 
?>