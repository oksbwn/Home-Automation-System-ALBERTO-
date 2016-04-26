<?php
$m = new MongoClient();
$outputDb = $m->smart_home->board_output_details;

changeLoad("woofer","BRD4","O");
changeLoad("tv","BRD4","O");
changeLoad("shelf","BRD4","F");
changeLoad("fan","BRD3","F");
changeLoad("room","BRD3","O");
changeLoad("liquid","BRD3","F");

function changeLoad($load,$board,$status){
	$regex =new MongoRegex("/$load/i");
	$output_load =$GLOBALS['outputDb']->find(array('name' => $regex,'id' => $board))->sort(array('sl_no' => 1));
	foreach ($output_load as $doc) {
		$GLOBALS['outputDb']->update(array("sl_no"=>$doc['sl_no']), array('$set'=>array("status"=>$status)));
	}
}
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=server_interface&COMM=".urlencode('Loads changed according to morning routine.'));
?>