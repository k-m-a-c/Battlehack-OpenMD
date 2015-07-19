<?php
$app->get(
  '/accept/patient/:patientId', function($patientId) {
    $doctorId = $_SESSION['user_id'];
    foreach($db->query("SELECT * FROM accepted_doctors WHERE patientId = '$patientId' AND doctorId = '$doctorId'") as $row) {
      $id = $row['id'];
    }
    if (isset($id)) {
      global $app;
      $app->redirect('/patient/home');
    }
    $db->exec("INSERT INTO accepted_doctors
    (`patientId`, `doctorId`)
    VALUES
    ('$patientId', '$doctorId')");
    $db->exec("DELETE FROM doctorspatients WHERE patientId = '$patientId' AND doctorId = '$doctorId'");

    global $app;
    $app->redirect('/patient/home');
  }
);
?>
