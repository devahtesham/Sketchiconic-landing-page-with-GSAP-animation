<?php
 
require_once('config.php');
 
// ============================================================
// Utility functions
// ============================================================
function json_error($msg) {
    return json_encode([
        "error" => [
            "message" => $msg,
        ],
    ]);
}
 
 
 
// ====================================================================
// Step 1: Make sure we received correct parameters from the frontend
// ====================================================================
 
if ($_SERVER["CONTENT_TYPE"] !== 'application/json') {
    header(400);
    die(json_error("Only JSON requests allowed"));
}
 
 
$json_obj = json_decode(file_get_contents('php://input'));
if (!$json_obj) {
    die(json_error("Could not parse JSON request"));
}

// We expect the frontend to send an object like this:
// {
//   payment_method_id: "pm_123…",
//   firstname: "customer first name",
//   lastname: "customer last name",
//   email: "customer email"
// }
//
// Let's verify that all of that data is present before continuing.
//
if (!isset($json_obj->payment_method_id)) {
    die(json_error("No payment_method_id provided"));
}
if (!isset($json_obj->email)) {
    die(json_error("No email provided"));
}
if (!isset($json_obj->country)) {
    die(json_error("No country provided"));
}
if (!isset($json_obj->zip)) {
    die(json_error("No zip provided"));
}
if (!isset($json_obj->state)) {
    die(json_error("No state provided"));
}
if (!isset($json_obj->city)) {
    die(json_error("No city provided"));
}
if (!isset($json_obj->address2)) {
    die(json_error("No address2 provided"));
}
if (!isset($json_obj->address)) {
    die(json_error("No address provided"));
}if (!isset($json_obj->phone)) {
    die(json_error("No phone provided"));
}
if (!isset($json_obj->link_token)) {
    die(json_error("No link_token provided"));
}
if (!isset($json_obj->p_name)) {
    die(json_error("No Client's name provided"));
}
if (!isset($json_obj->currency)) {
    die(json_error("No currency provided"));
}if (!isset($json_obj->amount)) {
    die(json_error("No amount provided"));
}
if (!isset($json_obj->firstname)) {
    die(json_error("No firstname provided"));
}
if (!isset($json_obj->lastname)) {
    die(json_error("No lastname provided"));
}
 
require_once 'db-connect.php'; 

    
    $sql = "SELECT * FROM orders WHERE link_token = '" .$json_obj->link_token . "'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['project_name'];
        $description = $row['description'];
        $itemPrice = $row['item_price'];
        $packages = $row['packages'];
        $currency = $row['item_price_currency'];
        $sale_mail = $row['sales_email'];
    }





// ====================================================================
// Step 2: Create or update customer
// ====================================================================
 
$customer = null;

 
    try {
 
      $customer = \Stripe\Customer::create([
        'name'  => $json_obj->firstname,
        'email' => $json_obj->email,
        'payment_method' => $json_obj->payment_method_id,
        'metadata' => [
            'firstname' => $json_obj->firstname,
            'lastname' => $json_obj->lastname,
            'user_id' => '572e7063b91f505c5c4e44867402ec23',
        ],
    ]);
 
}


catch(\Stripe\Exception\CardException $e) { die(json_error('FAIL')); }
catch (\Stripe\Exception\RateLimitException $e) { die(json_error('FAIL')); } 
catch (\Stripe\Exception\InvalidRequestException $e) { die(json_error('FAIL')); } 
catch (\Stripe\Exception\AuthenticationException $e) { die(json_error('FAIL')); } 
catch (\Stripe\Exception\ApiConnectionException $e) { die(json_error('FAIL')); } 
catch (\Stripe\Exception\ApiErrorException $e) { die(json_error('FAIL')); } 
catch (Exception $e) { die(json_error('FAIL')); }

    $_SESSION['customer_id'] = $customer->id;
 
if ($customer === null) {
    die(json_error("Error creating or updating customer"));
}
 
$Total = $itemPrice * 100;
 
$ProductName = $name;
  
$metadata = [
    "first_name" => $json_obj->firstname,
    "last_name" => $json_obj->lastname,
    "product_name" => $ProductName,
];
for($loo=1;$loo<4;$loo++)
 {
     if($loo == 1)
     {
         $Total = ($itemPrice - 3) * 100;
     }
     elseif($loo == 2)
     {
         $Total = 2 * 100;
     }
     elseif($loo == 3)
     {
         $Total = 1 * 100;
     }
      try {
    $intent = \Stripe\PaymentIntent::create([
        'payment_method' => $json_obj->payment_method_id,
        'amount' => $Total,
        'currency' => $currency,
        'customer' => $customer,
        'metadata' => $metadata,
        'statement_descriptor_suffix' => 'Sketch Iconic',
        'confirmation_method' => 'manual',
        'confirm' => true,
        'description'=> (isset($description) ? substr(strip_tags($description), 0, 900)."..." : 'New payment by ' . $name)
    ]);
    }
    catch(\Stripe\Exception\CardException $e) { die(json_error('FAIL')); }
    catch (\Stripe\Exception\RateLimitException $e) { die(json_error('FAIL')); } 
    catch (\Stripe\Exception\InvalidRequestException $e) { die(json_error('FAIL')); } 
    catch (\Stripe\Exception\AuthenticationException $e) { die(json_error('FAIL')); } 
    catch (\Stripe\Exception\ApiConnectionException $e) { die(json_error('FAIL')); } 
    catch (\Stripe\Exception\ApiErrorException $e) { die(json_error('FAIL')); } 
    catch (Exception $e) { die(json_error('FAIL')); }
 }

session_start();
 
$_SESSION['payment_intent_id'] = $intent->id;
$_SESSION['link_token'] = $json_obj->link_token;


if ($intent->status == 'requires_action' &&
    $intent->next_action->type == 'use_stripe_sdk') {
    # Tell the client to handle the action
    echo json_encode([
        'requires_action' => true,
        'payment_intent_client_secret' => $intent->client_secret
    ]);

 $sql = "UPDATE orders SET fname = '".$json_obj->firstname."',lname='".$json_obj->lastname."',address='".$json_obj->address."',address2='".$json_obj->address2."',city='".$json_obj->city."',state='".$json_obj->state."',zip='".$json_obj->zip."',country='".$json_obj->country."', paid_amount='".$itemPrice."',paid_amount_currency='".$currency."',txn_id='".$intent->id."',phone='".$json_obj->phone."',payment_status='". $intent->status."', modified=NOW() WHERE link_token = '". $json_obj->link_token ."'"; 
                $insert = $db->query($sql) ;



} else if ($intent->status == 'succeeded') {



 $sql = "UPDATE orders SET fname = '".$json_obj->firstname."',lname='".$json_obj->lastname."',address='".$json_obj->address."',address2='".$json_obj->address2."',city='".$json_obj->city."',state='".$json_obj->state."',zip='".$json_obj->zip."',country='".$json_obj->country."', paid_amount='".$itemPrice."',paid_amount_currency='".$currency."',txn_id='".$intent->id."',phone='".$json_obj->phone."',payment_status='". $intent->status."', modified=NOW() WHERE link_token = '". $json_obj->link_token ."'"; 
                $insert = $db->query($sql) ;


    echo json_encode([
        'success' => true
    ]);
} else {
    # Invalid status
    http_response_code(500);
    echo json_encode(['error' => 'Invalid PaymentIntent status']);
}
}
