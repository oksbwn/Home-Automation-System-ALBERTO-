<?PHP
if($_SERVER['REQUEST_METHOD']=="GET"){
	$day=$_GET['DAY'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$day=$_POST['DAY'];
}
header('Content-Type: application/json');
$m = new MongoClient();
$date=date('d/M/Y',time()+12600);
$collection = $m->smart_home->smart_home_alram_day_status;
$val = $collection->find(array('date'=>$date ))->sort(array('sl_no' => -1))->limit(1);
$status='NOTSET';
$data=array();
foreach ($val as $row) {
	$date=$row['date'];
	$status=$row['status'];
}

$collection = $m->smart_home->smart_home_alram_manager;
$val = $collection->find()->sort(array('sl_no' => -1))->limit(1);
$data=array();
$day=$day.'Time';
foreach ($val as $row) {
	$data =array ('date'=>$date,'daystatus'=>$status,'alramstatus'=>$row['alram_status'],'alramtime'=>$row[$day]);
}
echo json_encode($data);
?>
