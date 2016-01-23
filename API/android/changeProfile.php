<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$status=$_GET['STATUS'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$status=$_POST['STATUS'];
}
$profileName="";
switch($status){
	case 3://Going Out
		$profileName="Out";
		break;
	case 4://Cmae back
		$profileName="In";
		break;
	case 2://Movie Mode
		$profileName="Movie";
		break;
	case 5://TV Mode
		$profileName="TV";
		break;
	case 1://Good Night
		$profileName="Good Night";
		break;
	
}
$m = new MongoClient();
$boardOutputsDb = $m->smart_home->board_output_details;
$myProfiles=$m->smart_home->my_smart_home_profiles;//sl_no,id,status
$dev="Mobile";
$device =new MongoRegex("/$dev/i");
$profile =new MongoRegex("/$profileName/i");
$profileData =$myProfiles->find(array('for_device' =>$device,'profile_name' =>$profile))->sort(array('sl_no' => 1));
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
echo "ok";
?>