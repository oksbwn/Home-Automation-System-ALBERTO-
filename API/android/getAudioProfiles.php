<?PHP
//$data =array ('Do'=>1,'Temperature'=>2,'bathTemp'=>3);
//$data1 =array ('Do'=>$data,'Temperature'=>2,'bathTemp'=>3);
header('Content-Type: application/json');
//echo json_encode($data1);
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->sound_controller_values; // devices_to_be_on devices_to_be_off profile_name sl_no date
$val = $collection->find()->sort(array('sl_no' => 1));
$data=array();
$tempData=[];
foreach ($val as $document) {
		$tempData[]=['image'=>$document['profile_image'],'id'=>$document['sl_no'],'input'=>$document['input'],'output'=>$document['output'],'date'=>$document['date'],'profile_id'=>$document['profile_id']];

	}
echo json_encode($tempData);
?>