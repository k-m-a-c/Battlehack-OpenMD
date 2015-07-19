<?php
error_reporting(-1);

require('Pusher.php');
$app_id = '130666';
$app_key = '64c1568039c2b37cc9da';
$app_secret = 'e12fb6a2a8eb232cc611';

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

session_start();

require('pages/home.php');
require('pages/login.php');
require('pages/patient_register.php');
require('pages/doctor_register.php');
require('pages/doctor_patient_list.php');
require('pages/health_status_update.php');
require('pages/admin.panel.php');

require('api/doctor.register.php');
require('api/doctor.login.php');
require('api/patient.register.php');
require('api/patient.login.php');
require('api/logout.php');

require('api/doctor.add.patient.php');

require('api/patient.new.status.php');

require('api/check.bt.token.php');
require('api/acquire.bt.token.php');
require('api/bt.pay.php');

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

$app->run();
