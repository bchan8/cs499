<!DOCTYPE html>
<html lang="en">
<head>
<title>Dividend Tracker</title>
<!-- Our CSS stylesheet file -->
<link rel="stylesheet" href="css/bootstrap.css" />
<script>
function goBack()
  {
  window.history.back()
  }
</script>
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
			}
		endforeach;

			?>
		<div class="page-header" id="banner"></div>
		<button onclick="goBack()">Go Back</button>
		<div class="row">
			<div class="col-lg-4">
				<h2>Historical Dividend Data</h2>
				
				<?php
				$exchanges = array('nasdaq', 'nyse');
				
				foreach($exchanges as $e):
					$filename = 'data/'.$e.'/'.$symbol.'/dividend_history.xml';
	
					if(file_exists($filename)){
						$dividend_history_xml = simplexml_load_file($filename);
						break;
					}
					else {
						exit('Symbol Does Not Exist, Please Enter A Different One. Failed to open '.$filename);
					}
				endforeach;
				
				echo '<h3>Source: ';
				echo $dividend_history_xml['source'];
				echo '</h3>';
				echo '<h3>Exchange: ';
				echo $dividend_history_xml->exchange['market'];
				echo '</h3>';
				echo '<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
						<th>Date</th>
						<th>Dividend Price</th>
						</tr>
						</thead>
						<tbody>';
		
				foreach($dividend_history_xml->exchange->dividend_date as $dividendinfo):
					echo '<tr>';
					echo '<td>';
					echo $dividendinfo['date'];
					echo '</td>';
					echo '<td>';
					echo $dividendinfo->price;
					echo '</td>';
					echo '</tr>';
				endforeach;
		
				echo '</tbody></table>';
		?>
			</div>
		</div>
	</div>
</body>
</html>
