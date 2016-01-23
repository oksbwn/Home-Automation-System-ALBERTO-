<?PHP
header('Content-Type: application/json');
$m = new MongoClient();
$date=date('d/M/Y',time()+12600);
$collection = $m->smart_home->my_phone_call_informations;

$val = $collection->find(array('date'=>$date),array('is_call_notified'->'No'))->sort(array('sl_no' => -1));
$data=array();
foreach ($val as $row) {
	$data =array ('daystatus'=>$row['phone_no'],'alramstatus'=>$row['alram_status'],'alramtime'=>$row[$day]);
}
echo json_encode($data);
?>
