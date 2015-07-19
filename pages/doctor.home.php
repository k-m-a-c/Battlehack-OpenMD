<?php
$app->get('api/doctor/home', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "doctor") {
    global $app;
    $app->redirect('/');
  }
  $data = array();
  foreach($db->query("SELECT * FROM patients") as $row) {
    $d = array(
      'patient_profile_link' => "/patient/u/".$row['id'],
      'name' => $row['name'],
      'city' => $row['city'],
      'country' => $row['country'],
      'healthcard' => $row['healthcard'],
      'request_patient_link' => "/api/doctor/add/patient/".$row['id']
    );
    array_push($data,$d);
  }

  echo json_encode($data);
});

$app->get('api/doctor/requests', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "doctor") {
    global $app;
    $app->redirect('/');
  }
  $doctorId = $_SESSION['user_id'];

  $data = array();

  foreach($db->query("SELECT * FROM patients
  JOIN patients_wanting_doctors ON patients.id = patients_wanting_doctors.patientId
  WHERE patients_wanting_doctors.doctorId = '$doctorId'
  GROUP BY patients.id") as $row) {
    $d = array(
      "patient_profile_link" => '/patient/u/'.$row['id'],
      'name' => $row['name'],
      'city' => $row['city'],
      'country' => $row['country'],
      'healthcard' => $row['healthcard'],
      'accept_patient_link' => "/accept/patient/".$row['id']
    );
    array_push($data,$d);
  }

  echo json_encode($data);
});
?>
