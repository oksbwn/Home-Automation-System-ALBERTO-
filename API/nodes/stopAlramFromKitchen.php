<?php
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->smart_home_alram_day_status;
$date=date('d/M/Y',time()+12600);
$collection->update(array('date'=>$date ), array('$set'=>array("status"=>"OFF")));

file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=kitchen_node&COMM=".urlencode('Today Alram stoppedfrom Kitchen.'));
?>