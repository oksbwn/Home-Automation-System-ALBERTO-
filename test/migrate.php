<?php
$con=mysqli_connect("localhost","root","","alberto");
$sql="SELECT *
	FROM `callstats`
	ORDER BY `Sl_No` ASC";
$result = mysqli_query($con,$sql);
$total="";
$m = new MongoClient();
$db = $m->smart_home;
$collection = $db->my_phone_call_informations;

while($row = mysqli_fetch_array($result))
{
	$document = array( 
	"sl_no" => (int)$row['Sl_No'], 
	"phone_no" => $row['No'], 
	"no_of_times_talked" =>(int)$row['Times'], 
	"last_called_on_date" =>substr($row['Last_On'],0,10),
	"call_type" => $row['type'],
	"last_called_on_time" => substr($row['Last_On'],11)
   );
   $collection->insert($document);
}
?>