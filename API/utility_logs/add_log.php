<?php
	$m = new MongoClient();
	$db = $m->smart_home;
	$collection = $db->smart_home_logs;
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
		$sl_no= $document["sl_no"]+1;
	}
	$document = array( 
	"sl_no" => (int)$sl_no, 
	"from" => $_GET['FROM'], 
	"comment" => $_GET['COMM'],
	"time" =>  date('H:i',time()+12600),
	"date" =>   date('d/M/Y',time()+12600)
	);
	$collection->insert($document);
	echo "Log added successfully";
?>