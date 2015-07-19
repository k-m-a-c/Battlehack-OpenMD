<?php
$app->get(
  '/api/doctor/add/patient/:patientId', function($patientId) {
    require('connect.php');

    $doctorId = $_SESSION['user_id'];

    $db->exec("INSERT INTO doctorspatients
    (`doctorId`, `patientId`)
    VALUES
    ('$doctorId', '$patientId')");

    global $app;
    $app->redirect('/doctor/home');
  }
);
?>
