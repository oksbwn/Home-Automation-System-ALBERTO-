<?PHP
//$data =array ('Do'=>1,'Temperature'=>2,'bathTemp'=>3);
//$data1 =array ('Do'=>$data,'Temperature'=>2,'bathTemp'=>3);
header('Content-Type: application/json');
//echo json_encode($data1);
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->board_output_details;
$val = $collection->find()->sort(array('sl_no' => 1));
$data=array();
$tempData=[];
foreach ($val as $document) {
		//$sl_no= $document['today_location'];
		$tempData[]=['id'=>$document['sl_no'],'name'=>$document['comments'],'image'=>$document['image'],'status'=>$document['status']];
	}
echo json_encode($tempData);
?>