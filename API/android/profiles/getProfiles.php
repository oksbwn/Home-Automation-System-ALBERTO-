<?PHP
header('Content-Type: application/json');
//echo json_encode($data1);
$m = new MongoClient();
$collection =$m->smart_home->my_smart_home_profiles;
$val = $collection->find(array("for_device"=>"Android"))->sort(array('sl_no' => 1));
$data=array();
$tempData=[];
foreach ($val as $document) {
		//$sl_no= $document['today_location'];
		$tempData[]=['TOON'=>$document['devices_to_be_on'],'TOOFF'=>$document['devices_to_be_off'],'PROFILE'=>$document['profile_name']];
	}
echo json_encode($tempData);
?>