<?php
	$m = new MongoClient();
	$db = $m->smart_home;
	$collection = $db->my_daily_stats;
	if($_POST['TYPE']=="Check" && $_POST['PARA']=="Date"){
		$val = $collection->find(array('date'=> date('d/M/Y',time()+12600)))->sort(array('sl_no' => -1))->limit(1);
		$sl_no=0;
		foreach ($val as $document) {
		  $sl_no= 1;
		}
		if($sl_no==0){
			$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
			$sl_no=0;
			foreach ($val as $document) {
				$sl_no= $document["sl_no"]+1;
			}
			$document = array( 
				"sl_no" => (int)$sl_no, 
				"date" => date('d/M/Y',time()+12600), 
				"been_to_work" =>"", 
				"today_location" =>"",
				"breakfast" => "",
				"lunch" => "",
				"snacks" => "",
				"dinner" => "",
				"how_went_to_work" => "",
				"today_expenses_added" => "",
				"how_back_from_work" => "",
				"alram_done" => ""
			);
			$collection->insert($document);
			file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=desktop_app&COMM=".urlencode('Daily stats added.'));
		}
	}
	else if($_POST['TYPE']=="Check"){
		$val = $collection->find(array('date'=> date('d/M/Y',time()+12600)))->sort(array('sl_no' => -1))->limit(1);
		foreach ($val as $document) {
			if($document[$_POST['PARA']]==null || $document[$_POST['PARA']]=="")
				echo 0;
			else
				echo 1;
		}
	}
	else if($_POST['TYPE']=="Update"){
		$collection->update(array("date"=>date('d/M/Y',time()+12600)), array('$set'=>array($_POST['PARA']=>$_POST['VAL'])));	
		file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=desktop_app&COMM=".urlencode('Daily stats updated'));
		echo "Updated my stats.";
	}
?>