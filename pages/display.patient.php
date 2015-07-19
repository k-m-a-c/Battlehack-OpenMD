<?php
$app->get(
  '/patient/:patientId', function($patientId) {
    require('connect.php');
    if ($_SESSION['user_type'] != "doctor") {
      global $app;
      $app->redirect('/');
    }

    foreach($db->query("SELECT * FROM patients WHERE id = '$patientId'") as $row) {
      echo <<<HTML
        <h1>{$row['name']}</h1>
        <p>Email: {$row['email']}</p>
        <p>Gender: {$row['gender']}</p>
        <p>Birthday: {$row['birthday']}</p>
        <p>Healthcard: {$row['healthcard']}</p>
        <p>City: {$row['city']}</p>
        <p>Country: {$row['country']}</p>
        <p>Med Name: {$row['medName']}</p>
        <p>Med Dosage: {$row['medDosage']}</p>
        <p>Med Freq: {$row['medFreq']}</p>
        <p>Surgery Type: {$row['surgeryType']}</p>
        <p>Surgery Date: {$row['surgeryDate']}</p>
        <p>Allergy: {$row['allergy']}</p>
        <p>Condition: {$row['condition']}</p>
HTML;
    }
  }
);
?>
