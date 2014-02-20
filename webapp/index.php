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
					<form class="bs-example form-horizontal">
						<fieldset>
							<legend>Select a stock</legend>
							<div class="form-group">
								<label for="select" class="col-lg-2 control-label">Stocks</label>
								<div class="col-lg-10">
									<select size="6" class="form-control">
										<option>Stock 1</option>
										<option>Stock 2</option>
										<option>Stock 3</option>
										<option>Stock 4</option>
										<option>Stock 5</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="input_date" class="col-lg-2 control-label">Date</label>
								<div class="col-lg-3">
									<input type="text" class="form-control input-sm" id="input_date"
										placeholder="mm/dd/yyyy" maxlength="10">
								</div>
							</div>
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<button class="btn btn-default">Cancel</button>
										<button type="submit" class="btn btn-primary">Submit</button>
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
