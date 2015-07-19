<?php
$app->get(
  '/doctor/u/:doctorId', function($doctorId) {
    require('connect.php');
    if ($_SESSION['user_type'] != "patient") {
      global $app;
      $app->redirect('/');
    }

    foreach($db->query("SELECT * FROM doctors WHERE id = '$doctorId'") as $row) {
      echo <<<HTML
        <h1>{$row['name']}</h1>
        <p>Email: {$row['email']}</p>
        <p>Location: {$row['location']}</p>
        <p>Hospital: {$row['hospital']}</p>
HTML;
    }
  }
);
?>
