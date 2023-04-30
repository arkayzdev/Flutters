<?php
session_start();

//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

$id_session = $_GET['session_id'];
$quantity = $_GET['quantity'];

// Verify is session exist
if(!isset($_SESSION['email'])){
    $msg = "Connection expirée.";
    header('location: /pages/order?id=' . $id_session . '&msg=' . $msg);
    exit;
}

$price = 7;

require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51N2ZOTJqbTsXagty8NGbxgOrbpSaqwsdeq3gDrfvEerthIIs4oiaalVd1Tr7cXTdTnRTrZ98IqVr3fIYNCOLxCRk00CiNepoLZ');
\Stripe\Stripe::setApiVersion('2022-11-15');

$session = \Stripe\Checkout\Session::create([
    'mode' => 'payment',

    'line_items' => [[
        'price_data' => [
          'currency' => 'eur',
          'product_data' => [
            'name' => 'Super Mario Bros',
          ],
          'unit_amount' => 780,
        ],
        'quantity' => 3,
      ]],

    'payment_method_types' => ['card'],
    'success_url' => 'http://localhost:4242/success', // Send hash password
    'cancel_url' => 'http://example.com/cancel',
]);

?>

<html>
  <head>
    <title>Buy cool new product</title>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <button id="checkout-button">Checkout</button>
    <script>
      var stripe = Stripe('pk_test_51N2ZOTJqbTsXagtybVl3wxiFXioj9Pu6zaFqxFWkTGAmceByMQNgV4v4SLCXVli5DqrszVxUpDHb9KKwshnOi7ao00TMhGGuSf');
      const btn = document.getElementById("checkout-button")
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        stripe.redirectToCheckout({
          sessionId: "<?php echo $session->id; ?>"
        });
      });
    </script>
  </body>
</html>