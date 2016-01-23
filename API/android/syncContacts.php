<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$name=$_GET['NAME'];
	$no=$_GET['NO'];
	$mail=$_GET['MAIL'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$name=$_POST['NAME'];
	$no=$_POST['NO'];
	$mail=$_POST['MAIL'];
}
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->phone_synced_contacts_list;
$val = $collection->find(array('contact_no'=>$no))->sort(array('sl_no' => -1))->limit(1);
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
			"date" =>date('d/M/Y',time()+12600) , 
			"person_name" =>$name, 
			"contact_no" =>$no,
			"email_id" =>$mail
			
		);
		$collection->insert($document2);
		file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=".urlencode('New Contact added '.$name));
	}
echo "1";
?>

