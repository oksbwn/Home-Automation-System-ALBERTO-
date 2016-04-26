<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$date=$_GET['DATE'];
	$time=$_GET['TIME'];
	$lat=$_GET['LAT'];
	$lng=$_GET['LNG'];
	$vel=$_GET['VEL'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$date=$_POST['DATE'];
	$time=$_POST['TIME'];
	$lat=$_POST['LAT'];
	$lng=$_POST['LNG'];
	$vel=$_POST['VEL'];
}
//"DATE", "TIME", "LAT", "LNG", "VEL"
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->my_location_details;
$val2 = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
		$sl_no=0;
		foreach ($val2 as $document) {
			$sl_no= $document["sl_no"]+1;
		}
$document2 = array( 
	"sl_no" => (int)$sl_no, 
	"date" => $date, 
	"time" =>$time, 
	"latitude" =>$lat, 
	"longitude" =>$lng, 
	"velocity" =>$vel
);
$collection->insert($document2);
echo "1";
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('Added visited Location'));
?>