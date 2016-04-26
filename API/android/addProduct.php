<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$date=$_GET['DATE'];
	$item=$_GET['ITEM'];
	$cost=$_GET['COST'];
	$file=$_GET['FILE'];
	$from=$_GET['FROM'];
	$warranty=$_GET['WARRNTY'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	
	$date=$_POST['DATE'];
	$item=$_POST['ITEM'];
	$cost=$_POST['COST'];
	$file=$_POST['FILE'];
	$from=$_POST['FROM'];
	$warranty=$_POST['WARRNTY'];
}
//"DATE", "ITEM", "COST", "FILE", "FROM", "WARRNTY"
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->product_bought_details;
$val2 = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
		$sl_no=0;
		foreach ($val2 as $document) {
			$sl_no= $document["sl_no"]+1;
		}
$document2 = array( 
	"sl_no" => (int)$sl_no, 
	"date" => $date, 
	"from" =>$from, 
	"image_file_path" =>$file, 
	"item" =>$item, 
	"price" =>$cost, 
	"warranty" =>$warranty
);
$collection->insert($document2);
echo "1";
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('Added New Product'));
?>