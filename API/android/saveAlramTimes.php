<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$sun=$_GET['SUN'];
	$mon=$_GET['MON'];
	$tue=$_GET['TUE'];
	$wed=$_GET['WED'];
	$thu=$_GET['THU'];
	$fri=$_GET['FRI'];
	$sat=$_GET['SAT'];
	$status=$_GET['STATUS'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$sun=$_POST['SUN'];
	$mon=$_POST['MON'];
	$tue=$_POST['TUE'];
	$wed=$_POST['WED'];
	$thu=$_POST['THU'];
	$fri=$_POST['FRI'];
	$sat=$_POST['SAT'];
	$status=$_POST['STATUS'];
}
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->smart_home_alram_manager;
$collection->update(array("sl_no"=>1), array('$set'=>array("alram_status"=>$status,"SUNTime"=>$sun,"MONTime"=>$mon,"TUETime"=>$tue,"WEDTime"=>$wed,"THUTime"=>$thu,"FRITime"=>$fri,"SATTime"=>$sat)));
echo "1";
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_app&COMM=Alram%20time%20changed.");
?>