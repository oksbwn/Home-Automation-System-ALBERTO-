<?php
	$m = new MongoClient();
	$db = $m->my_daily_stats;
	$collection = $db->my_tweets_from_twitter;
	
	$val = $collection->find(array('id' => $_POST['ID']))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
	  $sl_no= 1;
	}
	echo  $sl_no;
?>