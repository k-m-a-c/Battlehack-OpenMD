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
      <td><a href="/doctor/{$row['id']}">{$row['name']}</a></td>
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
  $doctorId = $_SESSION['user_id'];

  $html .= "<table style='border: 1;'>";

  foreach($db->query("SELECT patients.id AS id, patients.name AS name, patients.city AS city,
  patients.country AS country, patients.healthcard AS healthcard
  FROM doctorspatients JOIN
  patients ON patients.id = doctorspatients.patientId
  WHERE doctorspatients.doctorId = '$doctorId'
  GROUP BY patients.id") as $row) {
    $html .= <<<HTML
    <tr>
      <td><a href='/patient/{$row['id']}'>{$row['name']}</a></td>
      <td>{$row['city']}, {$row['country']}</td>
      <td>{$row['healthcard']}</td>
      <td><a href="/accept/doctor/{$row['id']}">Accept Doctor</a></td>
    </tr>
HTML;
  }

  $html .= "</table>";
});

?>
