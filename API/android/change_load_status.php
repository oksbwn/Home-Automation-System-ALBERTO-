<?php		
	$m = new MongoClient();
	$outputDb = $m->smart_home->board_output_details;
	$load=$_POST['NO'];
	$output_load = $outputDb->find(array('sl_no' => (int)$load));
	foreach ($output_load as $doc) {
		if($doc['status']=="O")	
		{
			$outputDb->update(array("sl_no"=>(int)$load), array('$set'=>array("status"=>"F")));
			echo 'F';
		}
		else if($doc['status']=='F')
		{
			$outputDb->update(array("sl_no"=>(int)$load), array('$set'=>array("status"=>"O")));
			echo 'O';
		}
	}
	echo "ok";
   file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('Load status changed'));
?>