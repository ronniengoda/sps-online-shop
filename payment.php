<?php 
$api_key="";//provide your api key here this is for the basic checkout form stk
$username="";//provide your username here
// Start the session
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

if (!isset($_POST['phone'])) {
  	# code...
	$total_price = 0;
	$payment_reference=mt_rand(10000,100000);//generate order number will be used as payment reference.
	//loop through our cart items to get total amout for this order
	foreach ($_SESSION["cart_item"] as $item){
		$total_price += ($item["price"]*$item["quantity"]);
	}

  $_SESSION["amount"]=$total_price;//your total amount
  $_SESSION["payment_reference"]=$payment_reference;//your payment reference.
  $_SESSION["frompage"]=$_SERVER['HTTP_REFERER'];

  $_SESSION["phone_number"]=$_POST['phone_number'];//post value from checkout.php
  $_SESSION["name"]=$_POST['name'];//post value from checkout.php
  $_SESSION["email"]=$_POST['email'];//post value from checkout.php
  $_SESSION["address"]=$_POST['address'];//post value from checkout.php
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>PAYMENT CHECKOUT FORM</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script type="text/javascript" src="https://www.jquery-az.com/javascript/alert/dist/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="https://www.jquery-az.com/javascript/alert/dist/sweetalert.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<!--MPESA ONLY-STK PAYMENT METHOD-->
				<div class="card">
					<div class="card-header bg-dark text-white"><strong>PAYMENT DETAILS|LIPA NA MPESA-STK ONLY</strong></div>
					<div class="card-body">
						<form role="form" method="POST">
							<div><img src="https://cdn-images-1.medium.com/fit/t/1600/480/1*ku2fgiHHIfl_VOatvwwZGw.png" class="mx-auto d-block" width="100%"></div>
							<div class="form-group">
								<div class="alert alert-info">Kindly provide an MPESA registered phone number to complete the transaction.</div>
								<label for="phoneNumber">
								PHONE NUMBER</label>
								<div class="input-group">
									<input type="text" class="form-control" id="phone" name='phone' placeholder="MPESA Registered Phone Number"
									required autofocus />
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fa fa-phone"></span></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="amount">
								AMOUNT</label>
								<div class="input-group">
									<input type="text" class="form-control" id="amount" name='amount' placeholder="Amount"
									required autofocus value="<?php echo $_SESSION["amount"]; ?>" disabled="yes" />
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fa fa-credit-card"></span></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="accountRef">
								ORDER NUMBER</label>
								<div class="input-group">
									<input type="text" class="form-control" id="payment_reference" name='payment_reference' placeholder="Payment Reference"
									required autofocus value="<?php echo $_SESSION["payment_reference"]; ?>" disabled="yes" />
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fa fa-list-alt"></span></span>
									</div>
								</div>
							</div>
							<button type="button" class="btn btn-primary btn-block">
								<strong>Final Payment</strong> <span class="badge badge-light"><strong>Ksh <?php echo $_SESSION["amount"]; ?></strong></span>
							</button>

							<button type="submit" name="send-stk" id="send-stk" class="btn btn-success btn-block"><strong>Make Payment</strong></button>

						</form>
					</div>
					<div class="card-footer"><span class="badge badge-warning">Payment powered by PAY HERO KENYA LTD</span> <a href="index.php" class="btn btn-outline-success btn-sm">Back To Merchant</a></div>
				</div>
				<!--MPESA ONLY-STK PAYMENT METHOD-->
			</div>
			
			<div class="col-xs-12 col-md-6">
				<!--ALTERNATIVE-ADVANCED PAYMENT CHECKOUT WHICH HAS MULTIPLE PAYMENT METHODS-->
				<div class="card">
					<div class="card-header bg-dark text-white"><strong>PAYMENT DETAILS|MULTIPLE PAYMENT METHODS</strong></div>
					<div class="card-body">
						<!-- POST parameters required: phone,email,amount,payment_reference,username,bussiness_account_number-->
						<form role="form" method="POST" action="https://payherokenya.com/sps/portal/app/web_checkout.php">
							<div><img src="https://www.ipayafrica.com/sites/default/files/slideshow-images/ipay%20banner%203.jpg" class="mx-auto d-block" width="100%"></div>
							<div class="form-group">
								<label for="phoneNumber">
									<!-- Customer phone number in international format ie 2547xxxxxxxx * required-->
								CUSTOMER PHONE NUMBER *</label>
								<div class="input-group">
									<input type="text" class="form-control" id="phone" name='phone' value="<?php echo $_SESSION["phone_number"]; ?>" placeholder="2547xxxxxxxx"
									required readonly autofocus />
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fa fa-phone"></span></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="email">
									<!-- Customer email address * required. -->
								CUSTOMER EMAIL *</label>
								<div class="input-group">
									<input type="email" class="form-control" id="email" name='email' value="<?php echo $_SESSION["email"]; ?>" placeholder="Customer Email"
									required readonly autofocus />
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fa fa-envelope"></span></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="amount">
									<!-- Amount to be paid * required -->
								AMOUNT *</label>
								<div class="input-group">
									<input type="number" class="form-control" id="amount" name='amount' value="<?php echo $_SESSION["amount"]; ?>" placeholder="Amount"
									required readonly autofocus />
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fa fa-credit-card"></span></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="accountRef">
									<!-- Payment reference, this could be an order number or invoice number etc * required -->
								PAYMENT REFERENCE *</label>
								<div class="input-group">
									<input type="text" class="form-control" id="payment_reference" name='payment_reference' value="<?php echo $_SESSION["payment_reference"]; ?>" placeholder="Payment Reference"
									required readonly autofocus />
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fa fa-list-alt"></span></span>
									</div>
								</div>
							</div>
							<!-- PROVIDE YOUR SPS ACCOUNTDETAILS IN THE value="" PARAMETER BELOW-->
							<!-- Your application username -->
							<input type="hidden" class="form-control" id="username" name='username' value="" />
							<!-- Your application account number. -->
							<input type="hidden" class="form-control" id="bussiness_account_number" name='bussiness_account_number' value=""/>
							<br>
							<button type="submit" class="btn btn-success btn-block btn-rounded"><strong>PAY NOW</strong></button>
						</form>
					</div>
					<div class="card-footer"><span class="badge badge-warning">Payment powered by PAY HERO KENYA LTD</span></div>
				</div>
				<!--ALTERNATIVE-ADVANCED PAYMENT CHECKOUT WHICH HAS MULTIPLE PAYMENT METHODS-->
			</div>
		</div>
	</div>
	<?php 
	if (isset($_POST['send-stk'])) {
    # code...send request to pay hero kenya
		$data=array(
        'api_key' =>$api_key,//provide api keyhere
        'username'=>$username,//provide username here
        'amount'=>$_SESSION["amount"],//provide amount here
        'phone'=>$_POST['phone'],//provide phone number here
        'user_reference'=>$_SESSION["payment_reference"] //provide user reference here
      );
		//Get post valued that were passed from checkout.php.
		$phone_number=$_SESSION['phone_number'];
		$name=$_SESSION['name'];
		$email=$_SESSION['email'];
		$address=$_SESSION['address'];
		$items=json_encode($_SESSION["cart_item"]);
		$payment_reference=$_SESSION['payment_reference'];
		$total_price=$_SESSION['amount'];
  		//insert order details
		$query = $db_handle->insertQuery("INSERT INTO orders SET `order_number`='$payment_reference',`customer_name`='$name',`phone_number`='$phone_number',`email`='$email',`delivery_address`='$address',`items`='$items',`total_amount`='$total_price',`order_date`='".date('Y-m-d')."'");
 	 	//send our payment request now
		$jdata=json_encode($data);
		$response=sendRequest("https://payherokenya.com/sps/portal/app/stk.php",$jdata);
		$decode=json_decode($response);
		$Status=$decode->response->Status;
		if ($Status=="Failed") {
   		# code...
			echo '<script type="text/javascript">swal("Ooops!", "We encountered a problem while processing your payment. Try again later or contact your merchant.", "error");</script>';
		}
		else{
			unset($_SESSION["cart_item"]);
			echo '<script type="text/javascript">swal("Congrats!", "Payment has been succesfully initiated.Advice customer to check their phone for an STK push and provide PIN to complete payment.", "success");</script>';
		}

	}
	function sendRequest($url,$data){
		//Initiate cURL.
		$ch = curl_init($url);

		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		//Set the content type to application/json.
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

		//Dont return result to screen,store in a variable.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

		//Execute the request.
		$result = curl_exec($ch);
		return $result;
	}

	?>
</body>
</html>