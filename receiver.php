<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
if (!isset($dsn, $user) || false === $password){
	throw new Exception('Set MYSQL_DSN,MYSQL_USER, and MYSQL_PASSWORD environment variables');
}

$db = new PD0($dsn, $user, $password);
//if(isset($_POST['long'])&isset($_POST['lat'])&isset($_POST['speed']){
//	$statement = $db->prepare("INSERT INTO location (vehicleid,longitude,latitude,speed) VALUES (1,'".$_POST['long']."','".$_POST['lat']."',".$_POST['speed'].")");
//	$statement->execute();
//}
//$all = $statement->fetchAll();



?>
