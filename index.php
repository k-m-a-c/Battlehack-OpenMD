<?php
error_reporting(-1);

require('Pusher.php');
$app_id = '130666';
$app_key = '64c1568039c2b37cc9da';
$app_secret = 'e12fb6a2a8eb232cc611';

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

require('pages/homepage.php');

require('api/doctor.register.php');
require('api/patient.register.php');

$app->get(
  '/', function() {
    echo <<<HTML
    <form action="/api/new/doctor" method="POST">
      <input type="text" name="email">
      <input type="submit" value="Submit">
    </form>
    </html>
HTML;
  }
);


$app->run();
