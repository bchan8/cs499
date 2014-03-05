<?php

$symbol = $_POST['stock'];

$symbol = strtoupper($symbol);
$filename = '/data/nasdaq.xml';
if(file_exists($filename)){
	$xml = simplexml_load_file($filename);
}

?>