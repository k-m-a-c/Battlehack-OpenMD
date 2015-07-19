<?php
$app->get('/doctor/home', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "doctor") {
    global $app;
    $app->redirect('/');
  }
  $doctorId = $_SESSION['user_id'];
  $html = "<a href='/logout'>Logout</a>";
  $html .= "<table style='border: 1;'>";
  foreach($db->query("SELECT * FROM patients") as $row) {
    $html .= <<<HTML
    <tr>
      <td><a href="/patient/u/{$row['id']}">{$row['name']}</a></td>
      <td>{$row['city']}, {$row['country']}</td>
      <td>{$row['healthcard']}</td>
      <td><a href="/api/doctor/add/patient/{$row['id']}">Add Patient</a></td>
    </tr>
HTML;
  }
  $html .= "</table>";

  echo $html;
});

$app->get('/doctor/requests', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "doctor") {
    global $app;
    $app->redirect('/');
  }
  $doctorId = $_SESSION['user_id'];

  $html = "<table style='border: 1;'>";

  foreach($db->query("SELECT * FROM patients
  JOIN patients_wanting_doctors ON patients.id = patients_wanting_doctors.patientId
  WHERE patients_wanting_doctors.doctorId = '$doctorId'
  GROUP BY patients.id") as $row) {
    $html .= <<<HTML
    <tr>
      <td><a href='/patient/u/{$row['id']}'>{$row['name']}</a></td>
      <td>{$row['city']}, {$row['country']}</td>
      <td>{$row['healthcard']}</td>
      <td><a href="/accept/patient/{$row['id']}">Accept Patient</a></td>
    </tr>
HTML;
  }

  $html .= "</table>";

  echo $html;
});
?>
