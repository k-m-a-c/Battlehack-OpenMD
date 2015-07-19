<?php
$app->get(
  '/get/braintree/token', function() {
    require("BrainTree/Braintree.php");
    Braintree_Configuration::environment('sandbox');
    Braintree_Configuration::merchantId('b3sf2dmh5t9ff6ry');
    Braintree_Configuration::publicKey('b5g3zbfm4pxyppc8');
    Braintree_Configuration::privateKey('d026b5dee9b6aa1301a211f1d2481451');
    $clientToken = ($clientToken = Braintree_ClientToken::generate());
    echo $clientToken;
  }
);
?>
