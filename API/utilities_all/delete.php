<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$collection_docs=$_GET['DB'];
	$id=$_GET['ID'];
	$unique_val=$_GET['VAL'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$collection_docs=$_POST['DB'];
	$id=$_POST['ID'];
	$unique_val=$_POST['VAL'];
}

include('Exception.php');
ExceptionThrower::Start();
$m = new MongoClient();
$db = $m->smart_home->$collection_docs;
$val = $db->find(array($id=>(int)$unique_val))->limit(1);
$sl_no=0;
foreach ($val as $document)	
	 $idToDelete=$document['_id'];
ExceptionThrower::Stop();			
$db->remove( array( '_id' =>$idToDelete));
?>