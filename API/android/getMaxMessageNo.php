<?php
include('../Exception.php');
ExceptionThrower::Start();
$m = new MongoClient();
$db = $m->smart_home->mobile_messages;
$val = $db->find()->sort(array('sl_no' => -1))->limit(1);
foreach ($val as $row)
{
	echo $row['date'];
}
ExceptionThrower::Stop();
?>