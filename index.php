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
require('pages/patient_register.php');
require('pages/health_status_update.php');
require('pages/admin.panel.php');

require('api/doctor.register.php');
require('api/doctor.login.php');
require('api/patient.register.php');

require('api/patient.new.status.php');

require('api/acquire.bt.token.php');
require('api/bt.pay.php');

$app->get(
  '/doctor_login', function() {
    echo <<<HTML
    <form action="/api/login/doctor" method="POST">
      <input type="text" name="email">
      <input type="password" name="password">
      <input type="submit" value="Login">
    </form>
  }
);

$app->get(
  '/patient_login', function() {
    echo <<<HTML
    <form action="/api/login/patient" method="POST">
      <input type="text" name="email">
      <input type="password" name="password">
      <input type="submit" value="Login">
    </form>
  }
);

$app->run();
