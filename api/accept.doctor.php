<?php
$app->get(
  '/accept/doctor/:doctorId', function($doctorId) {
    require('connect.php');
    $patientId = $_SESSION['user_id'];
    foreach($db->query("SELECT * FROM accepted_doctors WHERE patientId = '$patientId' AND doctorId = '$doctorId'") as $row) {
      $id = $row['id'];
    }
    if (isset($id)) {
      global $app;
      $app->redirect('/patient/requests');
    }
    $db->exec("INSERT INTO accepted_doctors
    (`patientId`, `doctorId`)
    VALUES
    ('$patientId', '$doctorId')");
    $db->exec("DELETE FROM doctorspatients WHERE patientId = '$patientId' AND doctorId = '$doctorId'");

    global $app;
    $app->redirect('/patient/requests');
  }
);
?>
