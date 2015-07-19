<?php
$app->get(
  '/api/check/patient/payed', function() {
    require('connect.php');
    if (isset($_SESSION['user_id'])) {
      $userId = $_SESSION['user_id'];
      foreach($db->query("SELECT * FROM patients WHERE id = '$userId'") as $row) {
        $didPay = $row['didPay'];
        echo $didPay;
      }
    }
  }
);
?>
