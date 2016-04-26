<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$type=$_GET['TYPE'];
	$date=$_GET['DATE'];
	$time=$_GET['TIME'];
	$header=$_GET['HEAD'];
	$body=$_GET['BODY'];
	$location=$_GET['LOC'];
	$no=$_GET['NO'];
	$image=$_GET['IMG'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$type=$_POST['TYPE'];
	$date=$_POST['DATE'];
	$time=$_POST['TIME'];
	$header=$_POST['HEAD'];
	$body=$_POST['BODY'];
	$location=$_POST['LOC'];
	$no=$_POST['NO'];
	$image=$_POST['IMG'];
}
//"TYPE", "DATE", "TIME", "HEAD", "BODY", "LOC", "NO", "IMG"},
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->my_notes;
$val2 = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
		$sl_no=0;
		foreach ($val2 as $document) {
			$sl_no= $document["sl_no"]+1;
		}
$document2 = array( 
	"sl_no" => (int)$sl_no, 
	"type" => $type, 
	"date" =>$date, 
	"time" =>$time, 
	"header" =>$header, 
	"note" =>$body, 
	"location" =>$location, 
	"no" =>$no, 
	"image" =>$image
);
$collection->insert($document2);
echo "1";
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('Added New Notes'));
?>