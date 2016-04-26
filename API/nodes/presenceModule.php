<?php
	$m = new MongoClient();
	$outputDb = $m->smart_home->board_output_details;

	if($_POST['STA']==0)	
	{
		$outputDb->update(array("sl_no"=>20), array('$set'=>array("status"=>"F")));
	}
	else if($_POST['STA']==1)
	{
		$outputDb->update(array("sl_no"=>20), array('$set'=>array("status"=>"O")));
	}
	$profileDb = $m->smart_home->my_smart_home_profiles;
	$x=0;
	$y=0;
	if($_POST['SW1']==1){	
		$profileDb->update(array(),array('$set'=>array("Status"=>0)), array('multiple' => true)); //All profile Deactivated
		$profileDb->update(array("sl_no"=>8), array('$set'=>array("Status"=>1))); //Change Status
		curl_POST_file_contents("http://192.168.0.1/smart_home/API/utilities_all/changeHomeProfile.php");	
		curl_POST_file_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=bed_module&COMM=".urlencode('Profile Morning Selected from Keypad'));
	}
	if($_POST['SW2']==1){
			
		$profileDb->update(array(),array('$set'=>array("Status"=>0)), array('multiple' => true)); //All profile Deactivated
		$profileDb->update(array("sl_no"=>7), array('$set'=>array("Status"=>1))); //Change Status
		curl_POST_file_contents("http://192.168.0.1/smart_home/API/utilities_all/changeHomeProfile.php");	
		curl_POST_file_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=bed_module&COMM=".urlencode('Profile night Selected from Keypad'));		
	}
	if($_POST['SW3']==1){
			
		$profileDb->update(array(),array('$set'=>array("Status"=>0)), array('multiple' => true)); //All profile Deactivated
		$profileDb->update(array("sl_no"=>6), array('$set'=>array("Status"=>1))); //Change Status
		curl_POST_file_contents("http://192.168.0.1/smart_home/API/utilities_all/changeHomeProfile.php");	
		curl_POST_file_contents("http://192.168.0.1/smart_home/API/utility_logs/add_log.php?FROM=bed_module&COMM=".urlencode('Profile TV Selected from Keypad'));
	}
	function curl_POST_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
            else return FALSE;
    } 
	
	$profileData =$profileDb->find(array('Status' =>1))->sort(array('sl_no' => 1));
	foreach ($profileData as $doc) {
		if($doc['profile_name']=='morning')
			$x=1;		
		if($doc['profile_name']=='TV')
			$y=1;	
		if($doc['profile_name']=='In'){
			$y=1;
			$x=1;
		}
		
	}
	echo  '$@##'.$x.$y;
	
?>