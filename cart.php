<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();?>
<!DOCTYPE html>
<html>
<head>
	<title>MY CART</title>
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
	<div id="shopping-cart">
		<div class="text-heading text-center">
			<a class="btn btn-danger" href="index.php?action=empty">Empty Cart</a>
		<a class="btn btn-warning" href="index.php">Continue Shopping</a>
	</div>
	</div><hr>

		
		<?php
		if(isset($_SESSION["cart_item"])){
			$total_quantity = 0;
			$total_price = 0;
			?>	
			<div class="container">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Code</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th>Price</th>
							<th>Remove</th>
						</tr>	
					</thead>
				<tbody>
					<?php		
					foreach ($_SESSION["cart_item"] as $item){
						$item_price = $item["quantity"]*$item["price"];
						?>
						<tr>
							<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
							<td><?php echo $item["code"]; ?></td>
							<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
							<td  style="text-align:right;"><?php echo "Ksh ".$item["price"]; ?></td>
							<td  style="text-align:right;"><?php echo "Ksh ". number_format($item_price,2); ?></td>
							<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
						</tr>
						<?php
						$total_quantity += $item["quantity"];
						$total_price += ($item["price"]*$item["quantity"]);
					}
					?>

					<tr>
						<td colspan="2" align="right"><b>Total:</b></td>
						<td align="right"><?php echo $total_quantity; ?></td>
						<td align="right" colspan="2"><strong><?php echo "Ksh ".number_format($total_price, 2); ?></strong></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			</div>
			</div>		
			<?php
		} else {
			?>
			<div class="alert alert-danger">Your Cart is Empty</div>
			<?php 
		}
		?>
	</div><hr>
	<?php
		if(isset($_SESSION["cart_item"])){?>
	<div class="text-center"><a href="checkout.php" class="btn btn-success"><b>Proceed To Checkout</b></a></div>
<?php } ?>
</body>
</html>