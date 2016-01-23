<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$what=$_GET['WHAT'];
	$interfaceDevice=$_GET['DEVICE'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$what=$_POST['WHAT'];
	$interfaceDevice=$_POST['DEVICE'];
}
$m = new MongoClient();
$boardOutputsDb = $m->smart_home->board_output_details;
$boardOutputsTempDb=$m->smart_home->previous_load_status;//sl_no,id,status
if($what==0){//Take the load Ststus
	$currentLoadsStatus = $boardOutputsDb->find()->sort(array('sl_no' => 1));
	foreach ($currentLoadsStatus as $doc) {
		$tempLoadsStatus = $boardOutputsTempDb->find(array('id' => $doc['sl_no']));
		if($tempLoadsStatus->count()!=0){//If load is already in DB
			foreach ($tempLoadsStatus as $tempDoc){
				$boardOutputsTempDb->update(array("sl_no"=>$tempDoc['sl_no']), array('$set'=>array("status"=>$doc['status'])));
				//Switch OFF
				if($tempDoc['is_effected']==1)
					$boardOutputsDb->update(array("sl_no"=>$doc['sl_no']), array('$set'=>array("status"=>"F")));
			}
		}
		else{//Insert the new Load
			$lastLoadNo = $boardOutputsTempDb->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
			$sl_no=0;
			foreach ($lastLoadNo as $document) {
				$sl_no= $document["sl_no"]+1;
			}
			$newLoad = array( 
				"sl_no" => (int)$sl_no, 
				"id" => $doc['sl_no'], 
				"is_effected" =>1,
				"status" =>$doc['status']);
			$boardOutputsTempDb->insert($newLoad);
			//Switch OFF
			$boardOutputsDb->update(array("sl_no"=>$doc['sl_no']), array('$set'=>array("status"=>"F")));
			
			file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=all_utilities&COMM=".urlencode("New load added to the tempLoadStatus"));		
		}
	}
	file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=".$interfaceDevice."&COMM=".urlencode("Going out of home."));	
}
else if($what==1){//Restore the status
	$currentLoadsStatus = $boardOutputsDb->find()->sort(array('sl_no' => 1));	
	foreach ($currentLoadsStatus as $doc) {
		$tempLoadsStatus = $boardOutputsTempDb->find(array('id' => $doc['sl_no']));
		if($tempLoadsStatus->count()!=0){//If load is already in DB
			foreach ($tempLoadsStatus as $tempDoc){
				$boardOutputsDb->update(array("sl_no"=>$tempDoc['id']), array('$set'=>array("status"=>$tempDoc['status'])));
			}
		}
	}
	file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=".$interfaceDevice."&COMM=".urlencode("Came back to home."));	
}
?>