<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $path = $_GET['PATH'];
    $type = $_GET['TYPE'];
    $drive = $_GET['DRIVE'];
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $path = $_POST['PATH'];
    $type = $_POST['TYPE'];
    $drive = $_POST['DRIVE'];
}
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->all_files_collection;
$isPresentStatus=0;
$isPresent = $collection->find(array('path' => $path));
foreach ($isPresent as $doc) {
	$isPresentStatus=1;
}
if($isPresentStatus==0){
	$val = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
	$sl_no=0;
	foreach ($val as $document) {
		$sl_no= $document["sl_no"]+1;
	}
	$document = array( 
		  "sl_no" => (int)$sl_no, 
		  "path" => $path, 
		  "date" => date('d/M/Y',time()+12600), 
		  "type" =>$type,
		  "drive" =>$drive,
		  "time" => date('h:i',time()+12600),
		  "available" => "Yes"
	);
	$collection->insert($document);
	file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=server_interface&COMM=".urlencode('Added new File.').$path);
}
?>