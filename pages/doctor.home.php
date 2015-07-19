<?php
$app->get('/doctor/home', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "doctor") {
    global $app;
    $app->redirect('/');
  }
  $html = "<a href='/logout'>Logout</a>";
  $html .= "<table style='border: 1;'>";
  foreach($db->query("SELECT * FROM patients") as $row) {
    $html .= <<<HTML
    <tr>
      <td>{$row['name']}</td>
      <td>{$row['city']}, {$row['country']}</td>
      <td>{$row['healthcard']}</td>
      <td><a href="/api/doctor/add/patient/{$row['id']}">Add Patient</a></td>
    </tr>
HTML;
  }
  $html .= "</table>";

  echo $html;
});
?>
