<?php
$app->post(
  '/patient/pay', function() {
    require('connect.php');
    require("BrainTree/Braintree.php");
    Braintree_Configuration::environment('sandbox');
    Braintree_Configuration::merchantId('b3sf2dmh5t9ff6ry');
    Braintree_Configuration::publicKey('b5g3zbfm4pxyppc8');
    Braintree_Configuration::privateKey('d026b5dee9b6aa1301a211f1d2481451');

    $patientId = $_POST["patient_id"];
    $nonce = $_POST["payment_method_nonce"];

    $result = Braintree_Transaction::sale([
      'amount' => '25.00',
      'paymentMethodNonce' => $nonce,
      'options' => [
        'submitForSettlement' => True
      ]
    ]);
    if ($result->success == 'true') {
      $db->exec("UPDATE patients
        SET nonce='$nonce', didPay='1'
        WHERE id = '$patientId'");

      $response = array('response'=>'success','message'=>'you have successfully paid!');
      echo json_encode($response);
      exit;
    } else {
      $response = array('response'=>'error','message'=>'you werent able to pay!');
      echo json_encode($response);
      exit;
    }
  }
);
?>
