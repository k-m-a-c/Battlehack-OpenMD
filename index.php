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

require('pages/homepage.php');

require('api/doctor.register.php');
require('api/doctor.login.php');
require('api/patient.register.php');

$app->get(
  '/', function() {
    echo "Home Route";
  }
);

$app->get(
  '/doctor_register', function() {
    echo <<<HTML
    <form action="/api/new/doctor" method="POST">
      <p>Email:</p>
      <input type="text" name="email">
      <p>Password:</p>
      <input type="text" name="password">
      <p>Confirm Password:</p>
      <input type="text" name="confirm_password">
      <p>Name:</p>
      <input type="text" name="name">
      <p>Specialty:</p>
      <input type="text" name="specialty">
      <p>Location:</p>
      <input type="text" name="location">
      <p>CPSO:</p>
      <input type="text" name="cpso">
      <p>Hospital/Institution:</p>
      <input type="text" name="hospital">
      <input type="submit" value="Submit">
    </form>
    </html>
HTML;
  }
);

$app->get(
  '/patient_register', function() {
    echo <<<HTML
    <form action="/api/new/patient" method="POST">
      <p>Email:</p>
      <input type="text" name="email">
      <p>Password:</p>
      <input type="text" name="password">
      <p>Confirm Password:</p>
      <input type="text" name="confirm_password">
      <p>Name:</p>
      <input type="text" name="name">
      <p>Gender:</p>
      <input type="text" name="gender">
      <p>Birthday:</p>
      <input type="text" name="birthday">
      <p>Healthcard:</p>
      <input type="text" name="healthcard">
      <input type="submit" value="Submit">
    </form>
    </html>
HTML;
  }
);


$app->run();
