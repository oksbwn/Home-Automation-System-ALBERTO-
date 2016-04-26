<?php
$m = new MongoClient();
$db = $m->smart_home->smart_home_logs;
$val = $db->find()->sort(array('sl_no' => -1))->limit(50);
$sl_no=0;//echo $document['sl_no'];
$i=0;

$data=array();
$tempData=[];
echo '<html>
	<table width="100%">
		<thead>
			<tr>
				
					<th width="15%"><b color="red">Sl.No.</b></th> 
					<th width="15%"><b color="red">DEVICE</b></th> 
					<th width="40%"><b color="red">LOG</b></th> 
					<th width="15%"><b color="red">DATE</b></th>
					<th width="15%"><b color="red">TIME</b></th>
			</tr>
		</thead>   
		<tbody>';
foreach ($val as $document) {
	echo '<tr>
				<td><b color="white">'.
					$document['sl_no'].'</b>
				</td>
				<td><b color="white">'.
					$document['from'].'</b>
				</td>
				<td><b color="white"><i>'.
					$document['comment'].'</b>
				</td>
				<td><b color="white">'.
					$document['date'].'</b>
					
				</td>
				<td><b color="white">'.
					$document['time'].'</b>
				</td>
			</tr>';
}
echo '</tbody>
	</table>
</html>';
?>			    
