# sps-online-shop
Welcome to this simple shopping website with sps payment gateway.You can check it out live: http://payherokenya.com/onlineshop/

This is a shopping website which has implemented the two payment checkout forms that we have. With this you can have an idea how they work. You will need an account with us first before proceeding to use this project .If you do not have an account kindly create one here: https://payherokenya.com/sps/portal/

## INSTRUCTIONS FOR SETUP
1. Create your database and import the file named tblproduct.sql
2. Go to the file named dbcontroller.php and provide your database credentials at the very top. Variables have been commented so you an easily see them.
3. Go to the payment.php(Most important file of this setup) This file has all the code and the two payment forms for your reference. You can choose to use either of them, but for this purpose we have provided both of them so that you can experience how they work.
4. In the payment.php file on line number 2 and 3 provide your username and api_key. This can be found in your sps account business application details. This is used for the basic checkout form with MPESA-STK alone.
5. In the payment.php file go to line number 158 and 160 and provide your username and business_account_number as instructed in the comments there. This is used for the advanced payment checkout form alone.
6. You will need to set a callback URL in your sps account business application details, your call back should be a valid domain name pointing to the file callback.php this has sample code on how your order will be updated upon successfull payment.


Thats all, incase of any problem or challanges setting up or using our checkout forms, contct us asap +254765344101 via whatsapp or info@payherokenya.com
