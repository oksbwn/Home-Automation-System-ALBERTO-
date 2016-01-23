<?php
	$m = new MongoClient();
	$db = $m->smart_home;
	$collection = $db->my_daily_stats;
	
	$val = $collection->find()->sort(array('sl_no' => -1))->limit(10);
	$sl_no='';
	foreach ($val as $document) {
	  $sl_no= $document['today_location'];
	  if($sl_no!=null || $sl_no!="")
		  break;
	}
	echo  $sl_no;
?>