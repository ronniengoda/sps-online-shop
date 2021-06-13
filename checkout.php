<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();?>
<!DOCTYPE html>
<html>
<head>
	<title>CHECKOUT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- <link href="style.css" type="text/css" rel="stylesheet" /> -->
	<script type="text/javascript" src="https://www.jquery-az.com/javascript/alert/dist/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="https://www.jquery-az.com/javascript/alert/dist/sweetalert.css">
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="container">
		<form action="payment.php" method="POST">
			<div class="form-group">
				<label for="name">Customer Name:</label>
				<input type="text" class="form-control" id="name" name="name" required="">
			</div>
			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" id="email" name="email" required="">
			</div>
			<div class="form-group">
				<label for="phone">Phone Number</label>
				<input type="text" class="form-control" id="phone_number" name="phone_number" required="">
			</div>
			<div class="form-group">
				<label for="address">Delivery Address</label>
				<textarea class="form-control" id="address" name="address" required=""></textarea>
			</div>
			<button type="submit" name="submit" class="btn btn-success">Proceed To Payment</button>
		</form>
	</div>
</body>
</html>