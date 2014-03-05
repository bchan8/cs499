<!DOCTYPE html>
<html lang="en">
<head>
<title>Dividend Tracker</title>
<!-- Our CSS stylesheet file -->
<link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body>
<div class="container">
<?php

$symbol = $_POST['input_stock'];
$symbol = strtoupper($symbol);
echo '<h1>';
echo $symbol;
echo '</h1>';
$filename = 'data/nasdaq.xml';
if(file_exists($filename)){
	$stocks = simplexml_load_file($filename);
}
else {
	exit('Failed to open '.$filename);
}

foreach($stocks as $stockinfo):
	if(strcmp($symbol, $stockinfo['Symbol']) == 0){
		echo '<h1>';
		echo $stockinfo->Security_Name;
		echo '</h1>';
		echo'<div class="page-header" id="banner">';
	}
endforeach

?>
</div>
</body>
</html>