<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $task = $_GET['TASK'];
    $from = $_GET['FROM'];
    $date = $_GET['DATE'];
    $time = $_GET['TIME'];
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $task = $_POST['TASK'];
    $from = $_POST['FROM'];
    $date = $_POST['DATE'];
    $time = $_POST['TIME'];
}
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->own_rpc_jobs;
$val2 = $collection->find(array(), array('sl_no' => 1))->sort(array('sl_no' => -
    1))->limit(1);
$sl_no = 0;
foreach ($val2 as $document) {
    $sl_no = $document["sl_no"] + 1;
}
$document2 = array("sl_no" => (int)$sl_no, "job" => $task, "date" => $date, "time" => $time, "from" => $from,"is_done" =>'No');
$collection->insert($document2);
echo "1";
file_get_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=android_interface&COMM=" .
    urlencode('Added new job from .'.$from));

?>