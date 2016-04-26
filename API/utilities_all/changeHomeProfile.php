<?php
$profileName="";
$m = new MongoClient();
$boardOutputsDb = $m->smart_home->board_output_details;
$myProfiles=$m->smart_home->my_smart_home_profiles;//sl_no,id,status

$profileData =$myProfiles->find(array('Status' => 1))->sort(array('sl_no' => 1));
foreach ($profileData as $doc) {
	//
	$onDevices=explode(',',$doc['devices_to_be_on']);
	$max = sizeof($onDevices);
	for ($i=0; $i<$max; $i++) {
		if( $onDevices[$i]!=null ||  $onDevices[$i] != ""){
				$boardOutputsDb->update(array("sl_no"=>(int)$onDevices[$i]), array('$set'=>array("status"=>"O")));
		}
	}
	
	$offDevices=explode(',',$doc['devices_to_be_off']);
	$max = sizeof($offDevices);
	for ($i=0; $i<$max; $i++) {
		if( $offDevices[$i]!=null ||  $offDevices[$i] != ""){
				$boardOutputsDb->update(array("sl_no"=>(int)$offDevices[$i]), array('$set'=>array("status"=>"F")));
		}
	}
}
?>