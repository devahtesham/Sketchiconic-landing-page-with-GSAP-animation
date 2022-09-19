<?php
 
require_once('config.php');
 
// ==============================================================
// Final step: finalize the order in your database, show receipt
// ==============================================================
 
 
session_start();
try {
    $intent = \Stripe\PaymentIntent::retrieve($_SESSION['payment_intent_id']);
}

catch(\Stripe\Exception\CardException $e) { header("Location: https://sketchiconic.com/payment/fail.php");die(); }
catch (\Stripe\Exception\RateLimitException $e) { header("Location: https://sketchiconic.com/payment/fail.php");die(); } 
catch (\Stripe\Exception\InvalidRequestException $e) { header("Location: https://sketchiconic.com/payment/fail.php");die(); } 
catch (\Stripe\Exception\AuthenticationException $e) { header("Location: https://sketchiconic.com/payment/fail.php");die(); } 
catch (\Stripe\Exception\ApiConnectionException $e) { header("Location: https://sketchiconic.com/payment/fail.php");die(); } 
catch (\Stripe\Exception\ApiErrorException $e) { header("Location: https://sketchiconic.com/payment/fail.php");die(); } 
catch (Exception $e) { header("Location: https://sketchiconic.com/payment/fail.php");die(); }


 
if ($intent->status !== 'succeeded') {
    die("Final order step reached, but PaymentIntent status is '{$intent->status}'");
}
// TODO: update your database now that the PaymentIntent is complete and your customer has paid
include_once 'db-connect.php';

 $link_token = $_POST['link_token'];
 $paid_amount = ($intent['charges']['data'][0]['amount_captured'])/100;
 $txn_id = $intent['charges']['data'][0]['id'];
 $fname = $_POST['fname'];
 $paid_amount_currency = $intent['currency'];
 $lname = $_POST['lname'];
 $address = $_POST['address'];
 $address2 = $_POST['address2'];
 $city = $_POST['city'];
 $state = $_POST['state'];
 $zip = $_POST['zip'];
 $country = $_POST['country'];
 $currency = $_POST['currency'];
 $phone = $_POST['phone'];
 $payment_status = $intent['charges']['data'][0]['status'];
$sqlUp = "UPDATE orders SET paid_amount='".$paid_amount."',zip='".$zip."',paid_amount_currency='".$paid_amount_currency."',city='".$city."',payment_status='".$payment_status."',phone='".$phone."',country='".$country."',state='$state',txn_id='".$txn_id."',fname='".$fname."',lname='".$lname."',address='".$address."',address2='".$address2."' WHERE link_token='".$link_token."'";
$update = $db->query($sqlUp); 

// TODO: demo only: reset the session
 $link_token = $_SESSION['link_token'];
 $_SESSION['link_token'] = null;
 $_SESSION['payment_intent_id'] = null;


$sql = "SELECT * FROM orders WHERE link_token = '" . $link_token . "'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $name = $row['project_name'];
    $email = $row['email'];
    $description = $row['description'];
    $item_price = $row['item_price'];
    $total_paid = $row['item_price'];
    $item_price_currency = $row['item_price_currency'];
    $paid_amount = $row['paid_amount'];
    $paid_amount_currency = $row['paid_amount_currency'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $phone = $row['phone'];
    $address = $row['address'];
    $address2 = $row['address2'];
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $country = $row['country'];
    $payment_status	 = $row['payment_status'];
    $packages = $row['packages'];
    $link_token = $row['link_token'];
    $sale_mail = $row['sales_email'];
    $transactionID = $row['txn_id'];
}


require 'sendPaymentMail.php';

 ?>





<!DOCTYPE html>
<html>
<head>
    <title>Payment Sketch Iconic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	        		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
					<style type="text/css">
						
						body, *{
							font-family: 'Poppins', sans-serif;
						}
					</style>
                     <?php include '../global.php'?>
</head>
<body>
<div class="container col-md-6 py-5">

	<img src="https://sketchiconic.com/assets/images/logo.png" class="mb-4" style="width: 300px;">
    <div class="status">
      
            <p>Payment successfully charged.</p>
            <p>A receipt of this transaction has been sent to your email address on file. </p>
            <p>Please feel free to send us an email at<a href="mailto:billing@sketchiconic.com"> billing@sketchiconic.com</a> or call us at<a href="tel:<?php echo $no;?>"><?php echo $no;?></a> for billing related queries.</p>
            <p>Thank you for choosing <a href="http://sketchiconic.com/">Sketch Iconic</a>.</p>
            

    </div>
</div>

</body>
</html>
<?php } ?>