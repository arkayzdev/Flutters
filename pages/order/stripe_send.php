<?php
session_start();

//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

$id_session = $_GET['id_session'];
$quantity = $_GET['quantity'];

// Verify is session exist
if(!isset($_SESSION['email'])){
    $msg = "Connection expirée.";
    header('location: /pages/order?id=' . $id_session . '&msg=' . $msg);
    exit;
}

// Get the price
$q = 'SELECT price FROM SESSION WHERE id_session = :id_session;';
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'id_session' => $_GET['id_session'],
]);
$price = $req -> fetch(PDO::FETCH_ASSOC);

$price = number_format($price['price'],2);

// Get movie infos
$q = 'SELECT id_movie,title FROM MOVIE WHERE id_movie = (SELECT id_movie FROM TAKE_PLACE WHERE id_session = :id_session)';
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'id_session' => $id_session,
]);
$movie = $req -> fetch(PDO::FETCH_ASSOC);

$title = $movie['title'];
$id_movie = $movie['id_movie'];


require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51N2ZOTJqbTsXagty8NGbxgOrbpSaqwsdeq3gDrfvEerthIIs4oiaalVd1Tr7cXTdTnRTrZ98IqVr3fIYNCOLxCRk00CiNepoLZ');
\Stripe\Stripe::setApiVersion('2022-11-15');

$session = \Stripe\Checkout\Session::create([
    'mode' => 'payment',

    'line_items' => [[
        'price_data' => [
          'currency' => 'eur',
          'product_data' => [
            'name' => $title,
          ],
          'unit_amount' => floatval($price)*100,
        ],
        'quantity' => $quantity,
      ]],

    'payment_method_types' => ['card'],
    'customer_email' => $_SESSION['email'],
    'client_reference_id' => $id_session,
    'success_url' => "https://Flutters.ovh/pages/order/stripe_success?session_id={CHECKOUT_SESSION_ID}",    
    'cancel_url' => 'https://Flutters.ovh/pages/order/session_order.php?id_session=' . $id_session . '&id_movie=' . $id_movie,
]);

  // logs
	// type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated 8-LogOut 9-FailedToSignUp 10-AccountCreated  
	// 11-StripePaymentSent 12-StripePaymentSuccessfull 13-DownloadPDF | $page = actual url
  $log_type=11; $email=$_SESSION['email']; $log_page = 'HH';
  include($_SERVER['DOCUMENT_ROOT']."/log.php");

?>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
      var stripe = Stripe('pk_test_51N2ZOTJqbTsXagtybVl3wxiFXioj9Pu6zaFqxFWkTGAmceByMQNgV4v4SLCXVli5DqrszVxUpDHb9KKwshnOi7ao00TMhGGuSf');
      addEventListener('load', function(e) {
        e.preventDefault();
        stripe.redirectToCheckout({
          sessionId: "<?php echo $session->id; ?>"
        });
      });
    </script>