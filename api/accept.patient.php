<?php
$app->get(
  '/accept/patient/:patientId', function($patientId) {
    require('connect.php');
    $doctorId = $_SESSION['user_id'];
    foreach($db->query("SELECT * FROM accepted_patients WHERE patientId = '$patientId' AND doctorId = '$doctorId'") as $row) {
      $id = $row['id'];
    }
    if (isset($id)) {
      global $app;
      $app->redirect('/doctor/home');
    }
    $db->exec("INSERT INTO accepted_patients
    (`patientId`, `doctorId`)
    VALUES
    ('$patientId', '$doctorId')");
    $db->exec("DELETE FROM patients_wanting_doctors WHERE patientId = '$patientId' AND doctorId = '$doctorId'");

    global $app;
    $app->redirect('/doctor/home');
  }
);
?>
