<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$date=$_GET['DATE'];
	$item=$_GET['ITEM'];
	$what=$_GET['WHAT'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$date=$_POST['DATE'];
	$item=$_POST['ITEM'];
	$what=$_POST['WHAT'];
}
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->my_daily_stats;
$val = $collection->find(array('date'=>$date))->sort(array('sl_no' => -1))->limit(1);
$count=0;
foreach($val as $doc)
	$count++;
if($count==0)
	{
		$val2 = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -1))->limit(1);
		$sl_no=0;
		foreach ($val2 as $document) {
			$sl_no= $document["sl_no"]+1;
		}
		$document2 = array( 
			"sl_no" => (int)$sl_no, 
			"date" => $date, 
			"been_to_work" =>"", 
			"today_location" =>"",
			"breakfast" => "",
			"lunch" => "",
			"snacks" => "",
			"dinner" => "",
			"how_went_to_work" => "",
			"today_expenses_added" => "",
			"how_back_from_work" => "",
			"alram_done" => ""
		);
		$collection->insert($document2);
		file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('New stats added.'));
	}
$collection->update(array("date"=>$date), array('$set'=>array($what=>$item)));
echo "1";
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('Food added successfully from Android'));
?>

