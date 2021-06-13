<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
//Get callback response.
$response= file_get_contents('php://input');
$data=json_decode($response);

//Callback response values. You can now use this values for your own good.
$Transaction_Type=$data->response->Transaction_Type; //can either be C2B or B2C
$Source=$data->response->Source;//contains customer name and phone for C2B transaction
//$Destination=$data->response->Destination;//contains the receipient of funds name and phone for B2C transaction
$Amount=$data->response->Amount;//Contains transaction amount
$MPESA_Reference=$data->response->MPESA_Reference;//Contains MPESA reference number for the transaction
$Provider_Reference=$data->response->Provider_Reference;//This contains the provider payment reference, if you used the advanced payment checkout form.
$Channel=$data->response->Channel;//This contains the payment channel used for advanced checkout form eg: Credit card,Aitel money,Pesalink,Equity etc.
$Account=$data->response->Account;//Contains your account number;
$User_Reference=$data->response->User_Reference; //this is the unique payment reference provided for C2B transaction
$Transaction_Date=$data->response->Transaction_Date;//Contains the date and time when transaction happened

#You can now write your logic to process the above below here.Below is a sample for our shopping cart.
$query=$db_handle->insertQuery("UPDATE orders SET order_status='Confirmed',payment_status='Paid' WHERE order_number='$User_Reference'");