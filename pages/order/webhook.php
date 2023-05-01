<?php
// webhook.php
//
// Use this sample code to handle webhook events in your integration.
//
// 1) Paste this code into a new file (webhook.php)
//
// 2) Install dependencies
//   composer require stripe/stripe-php
//
// 3) Run the server on http://localhost:4242
//   php -S localhost:4242

//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");
require 'vendor/autoload.php';

// The library needs to be configured with your account's secret key.
// Ensure the key is kept out of any version control system you might be using.
$stripe = new \Stripe\StripeClient('sk_test_51N2ZOTJqbTsXagty8NGbxgOrbpSaqwsdeq3gDrfvEerthIIs4oiaalVd1Tr7cXTdTnRTrZ98IqVr3fIYNCOLxCRk00CiNepoLZ');

// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = 'whsec_cOLfWcKbT61Cyw08RZB39DokBEi5U7ym';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload, $sig_header, $endpoint_secret
  );
} catch(\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  http_response_code(400);
  exit();
}

$id = $event->data->object->id;
$price = $event->data->object->amount_total;
$user_email = $event->data->object->customer_details->email;
$user_name = $event->data->object->customer_details->name;
$account_email = $event->data->object->customer_email;
$id_movie_session = $event->data->object->client_reference_id;


// Handle the event
switch ($event->type) {
  case 'checkout.session.completed':
    $session = $event->data->object;

    // Insert to bdd
    $q = 'INSERT INTO PAYMENT(id,email,price,name,account_email,id_session) VALUES(:id, :email, :price, :name, :account_email,:id_session)';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id' => $id,
        'email' => $user_email,
        'price' => $price,
        'name' => $user_name,
        ':account_email' => $account_email,
        ':id_session' => $id_movie_session
    ]);
  // ... handle other event types
  default:
    echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);