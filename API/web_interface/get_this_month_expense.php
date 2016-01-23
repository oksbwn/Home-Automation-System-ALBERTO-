<?php
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
header("Content-type: text/xml");

$m = new MongoClient();
$db = $m ->smart_home;
$collection = $db->my_expenses;
$date=date('M/Y',time()+12600);
$val = $db->command(array("distinct" => "my_expenses", "key" => "date","query" => array("date" => new MongoRegex("/$date/")),"sort"=>array("Sl_No","-1")));
$sl_no=0;
foreach ($val['values'] as $dateDistinct) {
  //$sl_no=$sl_no+$document['date'];
	//echo $document;
	$val = $collection->find(array('date' =>$dateDistinct));
	$dayCost=0;	
	foreach ($val as $document) {
		//$sl_no=$sl_no+$document['cost'];
		$dayCost=$dayCost+$document['cost'];
	}
	$node = $dom->createElement("M".substr($dateDistinct,0,2));
	$newnode = $parnode->appendChild($node);
	$newnode->setAttribute("data",$dayCost);
}
echo $dom->saveXML();
?>