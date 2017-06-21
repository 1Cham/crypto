<?php
$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
if (!isset($dsn, $user) || false === $password){
	throw new Exception('Set MYSQL_DSN,MYSQL_USER, and MYSQL_PASSWORD environment variables');
}
$db = new PD0($dsn, $user, $password);

$statement = $db->prepare("select messageaksndlkan");
$statement->execute();
$all = $statement->fetchAll();

foreach ($all as $data){
	echo $data["message"]."<br>";
}

$data = $_GET['lat'].", ".$_GET['long'];
fwrite($handle, $data);
fclose($handle);
#echo "hello";, speed: ".$_POST['alt']

?>
