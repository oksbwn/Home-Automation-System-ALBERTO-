<?php
	$m = new MongoClient();
	$deviceProfiles = $m->smart_home->my_smart_home_profiles;
	$night="night";
	$val = $deviceProfiles->find(array('profile_name'=>new MongoRegex("/$night/i")))->sort(array('sl_no' => 1));
	$returnStatus=0;
	foreach ($val as $document) {
		if(strcmp($document['Status'],"1")==0)
		{
			$returnStatus=1;
		}
	}
	echo $returnStatus;
?>