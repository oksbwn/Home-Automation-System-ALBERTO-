<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	$id=$_GET['ID'];
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$id=$_POST['ID'];
}
 echo $id;
?>