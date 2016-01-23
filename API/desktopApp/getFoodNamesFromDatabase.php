<?PHP
//$data =array ('Do'=>1,'Temperature'=>2,'bathTemp'=>3);
//$data1 =array ('Do'=>$data,'Temperature'=>2,'bathTemp'=>3);
header('Content-Type: application/json');
//echo json_encode($data1);
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->food_details;
$type=$_POST['TYPE'];
$regex = new MongoRegex('/'.$type.'/');
$val = $collection->find(array('type' => $regex))->sort(array('sl_no' => 1));
$data=array();
$tempData=[];
foreach ($val as $document) {
		//$sl_no= $document['today_location'];
		$tempData[]=['id'=>$document['sl_no'],'food'=>$document['food'],'image'=>$document['image'],'calorie'=>$document['calorie']];
	}
echo json_encode($tempData);
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=desktop_app&COMM=".urlencode('Asked food list from server.'));
?>