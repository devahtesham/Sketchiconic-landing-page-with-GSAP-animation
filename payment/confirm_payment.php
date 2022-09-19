<?php
// ============================================================
// confirm_payment.php -- confirm a PaymentIntent sent by the
// browser. handleAction() in the frontend Javascript makes an
// AJAX request to this file if the user completed an SCA action
// such as 3D Secure.
// ============================================================
 
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
 
if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
    header(400);
    die(json_error("Only JSON requests allowed"));
}
 
 
$json_obj = json_decode(file_get_contents('php://input'));
if (!$json_obj) {
    die(json_error("Could not parse JSON request"));
}
 
// We expect the frontend to send an object like this:
// {
//   payment_intent_id: "pi_123…",
// }
//
// Let's verify that all of that data is present before continuing.
//
if (!isset($json_obj->payment_intent_id)) {
    die(json_error("No payment_intent_id provided"));
}
 
session_start();
 
// TODO: here you want to check that the user is logged in, etc
if ($_SESSION["payment_intent_id"] !== $json_obj->payment_intent_id) {
    die(json_error("Payment intent ID passed doesn't match session."));
}
 
// ====================================================================
// Step 2: Confirm the PaymentIntent
// ====================================================================
//
// At this point, we already created the customer and calculated the order
// total in create_payment.php. Now, we just need to retrieve the PaymentIntent
// and confirm() it again.
 
 
$intent = \Stripe\PaymentIntent::retrieve($json_obj->payment_intent_id);
try {
    $intent->confirm();
}
catch (\Stripe\Error\InvalidRequest $err) {
    die(json_error($err->getMessage()));
}
catch (\Stripe\Error\Card $err) {
    die(json_error($err->getMessage()));
}
catch(\Stripe\Exception\CardException $e) {
     die(json_error($e->getMessage()));
} catch (\Stripe\Exception\RateLimitException $e) {
  // Too many requests made to the API too quickly
      die(json_error($e->getMessage()));
} catch (\Stripe\Exception\InvalidRequestException $e) {
  // Invalid parameters were supplied to Stripe's API
      die(json_error($e->getMessage()));
} catch (\Stripe\Exception\AuthenticationException $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)
      die(json_error($e->getMessage()));
} catch (\Stripe\Exception\ApiConnectionException $e) {
  // Network communication with Stripe failed
      die(json_error($e->getMessage()));
} catch (\Stripe\Exception\ApiErrorException $e) {
    die(json_error($e->getMessage()));
  // Display a very generic error to the user, and maybe send
  // yourself an email
} catch (Exception $e) {
        die(json_error($e->getMessage()));
  // Something else happened, completely unrelated to Stripe
}
 
if ($intent->status == 'requires_action' &&
    $intent->next_action->type == 'use_stripe_sdk') {
    # Tell the client to handle the action
    echo json_encode([
        'requires_action' => true,
        'payment_intent_client_secret' => $intent->client_secret
    ]);
} else if ($intent->status == 'succeeded') {

    require_once 'db-connect.php';


 $sql = "UPDATE orders SET payment_status='". $intent->status."', modified=NOW() WHERE link_token = '". $_SESSION['link_token'] ."'"; 
$insert = $db->query($sql) ;


    echo json_encode([
        'success' => true
    ]);
} else {
    # Invalid status
    http_response_code(500);
    echo json_encode(['error' => 'Invalid PaymentIntent status']);
}