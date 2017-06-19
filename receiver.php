<?php

$my_file = 'file.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$data = $_GET['lat'].", ".$_GET['long'];
fwrite($handle, $data);
fclose($handle);
#echo "hello";, speed: ".$_POST['alt']

?>
