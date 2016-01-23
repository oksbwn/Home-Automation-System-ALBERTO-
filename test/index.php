<?php
$m = new MongoClient();

$collection = $m->smart_home->my_smart_home_profiles;
$document = array( 
	"sl_no" =>1, 
	"devices_to_be_on" =>"23,20,18,17,10,8,6,4", 
	"devices_to_be_off" =>"14,15,19,23", 
	"profile_name" =>"TV",
	"for_device" =>"Mobile",
	"date"=>"18/Oct/2015"
	);
$collection->insert($document);

?>