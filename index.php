<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<HTML>
<HEAD>
	<TITLE>Simple PHP Shopping Cart</TITLE>
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
</HEAD>
<BODY>
	<?php include 'header.php'; ?>
	<div class="container">
		<div class="row">
			<div class="jumbotron text-center">
				<h1>PRODUCTS</h1>
				<p>Welcome to this simple shopping website with sps payment gateway.</p>
			</div>
			<?php
			$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
			if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
					?>
					<div class="col-md-3 col-lg-3 col-sm-12 panel panel-warning text-center" style="margin-left: 8px;">
						<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>" class="form-inline">
							<div class="product-image form-group"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
							<div class="product-tile-footer">
								<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
								<div class="product-price"><b><?php echo "Ksh ".$product_array[$key]["price"]; ?></b></div>
								<div class="form-group"><input type="number" class="product-quantity" name="quantity" value="1"/>
								</div>
								<div>
									<input type="submit" value="Add to Cart" class="btn btn-warning" /></div>
								</div>
							</form>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</BODY>
</HTML>
<?php 
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
						if($productByCode[0]["code"] == $k) {
							if(empty($_SESSION["cart_item"][$k]["quantity"])) {
								$_SESSION["cart_item"][$k]["quantity"] = 0;
							}
							$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
						}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					echo '<script>swal("Congrats!!!", "Item successfully added to cart.", "success");</script>';
					echo("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP 'meta'
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
				echo '<script>swal("Congrats!!!", "Item successfully added to cart.", "success");</script>';
				echo("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP 'meta'
			}
		}
		break;
		case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
				if($_GET["code"] == $k)
					unset($_SESSION["cart_item"][$k]);
				echo '<script>swal("Congrats!!!", "Item successfully removed from cart.", "success");</script>';				
				if(empty($_SESSION["cart_item"]))
					unset($_SESSION["cart_item"]);
				echo '<script>swal("Congrats!!!", "Item successfully removed from cart.", "success");</script>';
			}
		}
		break;
		case "empty":
		unset($_SESSION["cart_item"]);
		echo '<script>swal("Congrats!!!", "Cart successfully emptied", "success");</script>';
		break;	
	}
}
?>