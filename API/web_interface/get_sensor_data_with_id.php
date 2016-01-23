<?php
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
header("Content-type: text/xml");

$m = new MongoClient();
$db = $m ->smart_home;
$collection = $db->sensors_data;
$date=date('M/Y',time()+12600);
$val = $collection->find(array('sensor_id' => $_GET['ID']))->sort(array('sl_no' => -1))->limit(60);
$sl_no=0;
foreach ($val as $dateDistinct) {
	$node = $dom->createElement("M".$sl_no);
	$newnode = $parnode->appendChild($node);
	$newnode->setAttribute("data",$dateDistinct['value']);
	$newnode->setAttribute("time",substr($dateDistinct['time'],0,2).'.'.substr($dateDistinct['time'],3,2));
	$sl_no++;
}
echo $dom->saveXML();
?>