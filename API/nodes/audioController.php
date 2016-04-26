<?php
	$m = new MongoClient();
	$db = $m->smart_home->smart_home_audio_profiles;
	$val = $db->find(array('is_active' =>1))->sort(array('sl_no' => 1));
	foreach ($val as $document) {
		echo  '$@##'.$document["sequence"];
	}
?>