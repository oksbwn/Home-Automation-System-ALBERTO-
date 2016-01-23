<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$item=$_GET['ITEM'];
	$cost=$_GET['COST'];
	$date=$_GET['DAT'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$item=$_POST['ITEM'];
	$cost=$_POST['COST'];
	$date=$_POST['DAT'];
}
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->my_expenses;
$val2 = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
		$sl_no=0;
		foreach ($val2 as $document) {
			$sl_no= $document["sl_no"]+1;
		}
$document2 = array( 
	"sl_no" => (int)$sl_no, 
	"details" => $item, 
	"date" =>$date, 
	"cost" =>(int)$cost
);
$collection->insert($document2);
echo "1";
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('Expense added from phone.'));
?>