<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

require('connect.php');
require('Pusher.php');

$app_id = '130666';
$app_key = '64c1568039c2b37cc9da';
$app_secret = 'e12fb6a2a8eb232cc611';

$app->get(
  '/', function() {
    $db->exec("INSERT INTO test (`test`) VALUES ('It Works2!')");
  }
);

$app->run();
