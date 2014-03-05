<!DOCTYPE html>
<html lang="en">
<head>
<title>Dividend Tracker</title>
<!-- Our CSS stylesheet file -->
<link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body>
	<div class="container">
		<?php include 'nav.php'?>
		<div class="row">
			<div class="col-lg-6">
				<div class="well">
					<form class="bs-example form-horizontal" action="stock.php" method="post">
						<fieldset>
							<legend>Enter stock symbol</legend>
							<div class="form-group">
								<label for="select" class="col-lg-2 control-label">Stocks</label>
								<div class="col-lg-5">
									<input type="text" class="form-control input-sm" name="input_stock"
										placeholder="e.g. MSFT" maxlength="10">
								</div>
							</div>
							<div class="form-group">
								<label for="input_date" class="col-lg-2 control-label">Options</label>
								<div class="col-lg-3">
<!-- 									<input type="text" class="form-control input-sm" id="input_date" -->
<!-- 										placeholder="mm/dd/yyyy" maxlength="10"> -->
									<div class="checkbox">
										<label> <input type="checkbox"> All historical dividends
										</label>
									</div>
									<div class="checkbox">
										<label> <input type="checkbox"> Checkbox
										</label>
									</div>
									<div class="checkbox">
										<label> <input type="checkbox"> Checkbox
										</label>
									</div>
								</div>
							</div>
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<button class="btn btn-default">Cancel</button>
										<input type="submit" class="btn btn-primary">
									</div>
								</div>
						
						</fieldset>
					</form>
				</div>
			</div>
		</div>

	</div>
</body>
</html>
