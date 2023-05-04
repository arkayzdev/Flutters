<?php
session_start();

//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

$id_event = $_GET['id_event'];
$quantity = $_GET['quantity'];

// Verify is session exist
if(!isset($_SESSION['email'])){
    $msg = "Connection expirée.";
    header('location: /pages/order?id=' . $id_session . '&msg=' . $msg);
    exit;
}

// Get All
    $q = 'SELECT * FROM EVENT WHERE id_event = :id_event';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
      'id_event' => htmlspecialchars($id_event)
    ]);
    $result = $req -> fetch(PDO::FETCH_ASSOC);


    $id = $result['id_event'];
    $name= $result['name'];
    $description= $result['description'];
    $date_event= $result['date_event'];
    $capacity= $result['capacity'];
    $price=number_format($result['price'],2);
    $image=$result['image'];
    $start_time= date('G:i',strtotime($result['start_time']));


require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51N3bEXD78c8ktjaCyfCjCqMTWqjYm5yP2uE8pqSOrejm5R6Q8tECXgyBDw4sMDoOjcDtrVitq3PrS6fel3dodsG300fYFE0oN1');
\Stripe\Stripe::setApiVersion('2022-11-15');

$session = \Stripe\Checkout\Session::create([
    'mode' => 'payment',

    'line_items' => [[
        'price_data' => [
          'currency' => 'eur',
          'product_data' => [
            'name' => $name,
          ],
          'unit_amount' => floatval($price)*100,
        ],
        'quantity' => $quantity,
      ]],

    'payment_method_types' => ['card'],
    'customer_email' => $_SESSION['email'],
    'client_reference_id' => $id_event,
    'success_url' => "https://Flutters.ovh/pages/events/stripe_success?event_id={CHECKOUT_SESSION_ID}",    
    'cancel_url' => 'https://Flutters.ovh/pages/events/event_page.php?id=' . $id_event,
]);

  // logs
	// type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated 8-LogOut 9-FailedToSignUp 10-AccountCreated  
	// 11-StripePaymentSent 12-StripePaymentSuccessfull 13-DownloadPDF | $page = actual url
  $log_type=11; $email=$_SESSION['email']; $log_page = 'HH';
  include($_SERVER['DOCUMENT_ROOT']."/log.php");

?>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
      var stripe = Stripe('pk_test_51N3bEXD78c8ktjaCynTYx45v8G51wYbL14SahiMITNw6GHviaIJ9kPD11TtScKPTQwlawGhZSaM8aFrZ7V4hrJJi00pqvxSXMF');
      addEventListener('load', function(e) {
        e.preventDefault();
        stripe.redirectToCheckout({
          sessionId: "<?php echo $session->id; ?>"
        });
      });
    </script>