<?php
$app->get(
  '/api/doctor/add/patient/:doctorId', function($doctorId) {
    require('connect.php');

    $patientId = $_SESSION['user_id'];

    foreach($db->query("SELECT * FROM patients_wanting_doctors WHERE doctorId = '$doctorId' AND patientId = '$patientId'") as $row) {
      $id = $row['id'];
    }

    if (isset($id)) {
      global $app;
      $app->redirect('/patient/home');
    }

    $db->exec("INSERT INTO patients_wanting_doctors
    (`doctorId`, `patientId`)
    VALUES
    ('$doctorId', '$patientId')");

    global $app;
    $app->redirect('/patient/home');
  }
);
?>
