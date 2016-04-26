<?php
$m = new MongoClient();

$collection = $m->smart_home->smart_home_users;
$document = array( 
	"sl_no" =>1, 
	"rfid_tag" =>"0800AB8D331D", 
	"mobile_tag" =>"iamworking", 
	"user" =>"Bikash",
	"last_used" =>"07/Feb/2016",
	"date"=>"07/Feb/2016"
	);
$collection->insert($document);

?>