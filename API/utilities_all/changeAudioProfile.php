<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$deviceName= $_POST['NAME'];
	$profileID= $_POST['ID'];
}
if($_SERVER['REQUEST_METHOD']=="GET")
{
	$deviceName= $_GET['NAME'];
	$profileID= $_GET['ID'];
} 

$profileName="";
$m = new MongoClient();
$audioProfiles = $m->smart_home->smart_home_audio_profiles;
$profileData =$audioProfiles->find()->sort(array('sl_no' => 1));
foreach ($profileData as $doc) {
	//
	$audioProfiles->update(array("profile_id"=>(int)$doc['profile_id']), array('$set'=>array("is_active"=>0)));
	if( $doc['profile_id']==$profileID ){
		$audioProfiles->update(array("profile_id"=>(int)$doc['profile_id']), array('$set'=>array("is_active"=>1)));
	}
}

file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=".$deviceName."&COMM=".urlencode("Audio Profile Changed."));	
?>