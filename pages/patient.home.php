<?php
$app->get('/api/patient/home', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "patient") {
    global $app;
    $app->redirect('/');
  }
  $patientId = $_SESSION['user_id'];
  $data = array();
  foreach($db->query("SELECT * FROM doctors") as $row) {
    $d = array(
      'doctor_profile_link' => "/doctor/u/".$row['id'],
      'location' => $row['location'],
      'hospital' => $row['hospital'],
      'request_doctor_link' => "/api/patient/add/doctor/".$row['id']
    );
    array_push($data,$d);
  }
  echo json_encode($data);
});

$app->get('/api/patient/requests', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "patient") {
    global $app;
    $app->redirect('/');
  }
  $patientId = $_SESSION['user_id'];

  $data = array();

  foreach($db->query("SELECT * FROM doctors
  JOIN doctorspatients ON doctorspatients.doctorId = doctors.id
  WHERE doctorspatients.patientId = '$patientId'
  GROUP BY doctors.id") as $row) {
    $d = array(
      'doctor_profile_link' => "/doctor/u/".$row['id'],
      'location' => $row['location'],
      'hospital' => $row['hospital'],
      'accept_doctor_link' => "/accept/doctor/".{$row['id']
    );
    array_push($data,$d);
  }

  echo json_encode($data);
});

?>
