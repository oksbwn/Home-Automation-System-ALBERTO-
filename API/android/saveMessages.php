<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$data=$_GET['DATA'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$data=$_POST['DATA'];
}
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->mobile_messages;
$jsondata = json_decode($data,true);
if(is_array($jsondata))
{
	foreach ($jsondata["DATA"] as $result) {
		$toInsert=0;
		$valGet = $collection->find(array("From" => $result['ADDRESS'], "date" =>$result['DATE']))->sort(array('sl_no' => 1));
		foreach ($valGet as $docData) {
				$toInsert=1;
		}
		if($toInsert==0){
			$val2 = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
			$sl_no=0;
			foreach ($val2 as $document) {
				$sl_no= $document["sl_no"]+1;
			}
			$document2 = array( 
				"sl_no" => (int)$sl_no, 
				"Body" =>$result['BODY'], 
				"From" =>$result['ADDRESS'], 
				"date" =>$result['DATE'],
				"read" =>$result['READ'],
				"id" =>$result['ID'],
				"type" =>$result['TYPE']
				
			);
			$collection->insert($document2);
		}
		file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('Message from '.$result['ADDRESS'].' Synced'));
	}
}
echo "1";
?>