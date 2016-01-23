<?PHP
header('Content-Type: application/json');
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->smart_home_alram_manager;
$val = $collection->find()->sort(array('sl_no' => -1))->limit(1);
$data=array();
foreach ($val as $row) {
	$data =array ('status'=>$row['alram_status'],'sun'=>$row['SUNTime'],'mon'=>$row['MONTime'],'tue'=>$row['TUETime'],'wed'=>$row['WEDTime'],'thu'=>$row['THUTime'],'fri'=>$row['FRITime'],'sat'=>$row['SATTime']);
}
echo json_encode($data);
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('Alram times asked.'));
?>
