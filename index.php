<?php
error_reporting(-1);

require('Pusher.php');
$app_id = '130666';
$app_key = '64c1568039c2b37cc9da';
$app_secret = 'e12fb6a2a8eb232cc611';

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

session_start();

require('pages/homepage.php');
require('pages/admin.panel.php');

require('api/doctor.register.php');
require('api/doctor.login.php');
require('api/patient.register.php');

$app->get(
  '/testing', function() {
    require("BrainTree/BrainTree.php");
    Braintree_Configuration::environment('sandbox');
    Braintree_Configuration::merchantId('b3sf2dmh5t9ff6ry');
    Braintree_Configuration::publicKey('b5g3zbfm4pxyppc8');
    Braintree_Configuration::privateKey('d026b5dee9b6aa1301a211f1d2481451');
    $clientToken = ($clientToken = Braintree_ClientToken::generate());
    echo <<<HTML
    <form id="checkout" method="post" action="/sub/checkout">
      <div id="payment-form"></div>
      <input type="submit" value="Pay $25">
    </form>

    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script>

    var braintree = Braintree.create('MIIBCgKCAQEAuZeCmRto9EPrR1l0lp/mF8a4bchRGobavGLBxSKll+kiMf7PO+qqKifu+PfyADyJxoo/Qwfo8uuU0ZXo5XO1MQP1EZDFuG53Emo+Hz2njXa+kRsJ21PTxsTjyPvOOA5Jt2aKx9oF3HWycM/LOJBG9yuMK0OjykOmKhbCnrjQ0KZ1pHpIbSm45KgL3xaivWCi+WHESS82TMYe2WLN9MDzt1ntrRJanET/qanvgReBOZKwNj8Vlre2xT30wDRCkjBvKPSdTJEtgySykp4AHs4coOXHsnjf9JZpdlIX3HXjPMbVXUKpoFHL8b1BMf4BlYON7+oIyuvufU2M5SKGce3d9QIDAQAB');
    // We generated a client token for you so you can test out this code
    // immediately. In a production-ready integration, you will need to
    // generate a client token on your server (see section below).
    var clientToken = "$clientToken";

    braintree.setup(clientToken, "dropin", {
      container: "payment-form"
    });
    </script>
HTML;
  }
);

$app->post(
  '/sub/checkout', function() {
    require('connect.php');
    $patientId = "12"; //To do verify patient ID

    $nonce = $_POST["payment_method_nonce"];

    $result = Braintree_Transaction::sale([
      'amount' => '25.00',
      'paymentMethodNonce' => $nonce,
      'options' => [
        'submitForSettlement' => True
      ]
    ]);

    if ($result->success == true) {
      $db->exec("UPDATE patients
        SET nonce='$nonce', didPay='1'
        WHERE id = '$id'");
    }
  }
);

$app->get(
  '/doctor_register', function() {
    echo <<<HTML
    <form action="/api/new/doctor" method="POST">
      <p>Email:</p>
      <input type="text" name="email">
      <p>Password:</p>
      <input type="text" name="password">
      <p>Confirm Password:</p>
      <input type="text" name="confirm_password">
      <p>Name:</p>
      <input type="text" name="name">
      <p>Specialty:</p>
      <input type="text" name="specialty">
      <p>Location:</p>
      <input type="text" name="location">
      <p>CPSO:</p>
      <input type="text" name="cpso">
      <p>Hospital/Institution:</p>
      <input type="text" name="hospital">
      <input type="submit" value="Submit">
    </form>
    </html>
HTML;
  }
);

$app->get(
  '/patient_register', function() {
    echo <<<HTML
    <form action="/api/new/patient" method="POST">
      <p>Email:</p>
      <input type="text" name="email">
      <p>Password:</p>
      <input type="text" name="password">
      <p>Confirm Password:</p>
      <input type="text" name="confirm_password">
      <p>Name:</p>
      <input type="text" name="name">
      <p>Gender:</p>
      <input type="text" name="gender">
      <p>Birthday:</p>
      <input type="text" name="birthday">
      <p>Healthcard:</p>
      <input type="text" name="healthcard">
      <input type="submit" value="Submit">
    </form>
    </html>
HTML;
  }
);


$app->run();
