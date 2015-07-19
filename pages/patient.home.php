<?php
$app->get('/patient/home', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "patient") {
    global $app;
    $app->redirect('/');
  }
  $patientId = $_SESSION['user_id'];
  $html = "<a href='/logout'>Logout</a>";
  $html .= "<table style='border: 1;'>";
  foreach($db->query("SELECT * FROM doctors") as $row) {
    $html .= <<<HTML
    <tr>
      <td><a href="/doctor/u/{$row['id']}">{$row['name']}</a></td>
      <td>{$row['location']}</td>
      <td>{$row['hospital']}</td>
      <td><a href="/api/patient/add/doctor/{$row['id']}">Add Doctor</a></td>
    </tr>
HTML;
  }
  $html .= "</table>";

  echo $html;
});

$app->get('/patient/requests', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "patient") {
    global $app;
    $app->redirect('/');
  }
  $patientId = $_SESSION['user_id'];

  $html .= "<table style='border: 1;'>";

  foreach($db->query("SELECT * FROM doctors
  JOIN doctorspatients ON doctorspatients.doctorId = doctors.id
  WHERE doctorspatients.patientId = '$patientId'
  GROUP BY doctors.id") as $row) {
    $html .= <<<HTML
    <tr>
      <td><a href='/doctor/u/{$row['id']}'>{$row['name']}</a></td>
      <td>{$row['location']}</td>
      <td>{$row['hospital']}</td>
      <td><a href="/accept/doctor/{$row['id']}">Accept Doctor</a></td>
    </tr>
HTML;
  }

  $html .= "</table>";
});

?>
