<?php
$app->get(
  '/api/doctor/add/patient/:patientId', function($patientId) {
    require('connect.php');

    $doctorId = $_SESSION['user_id'];

    foreach($db->query("SELECT * FROM doctorspatients WHERE doctorId = '$doctorId' AND patientId = '$patientId'") as $row) {
      $id = $row['id'];
    }

    if (isset($id)) {
      global $app;
      $app->redirect('/doctor/home');
    }

    $db->exec("INSERT INTO doctorspatients
    (`doctorId`, `patientId`)
    VALUES
    ('$doctorId', '$patientId')");

    global $app;
    $app->redirect('/doctor/home');
  }
);
?>
