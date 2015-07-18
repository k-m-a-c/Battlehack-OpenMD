<?php

require('Pusher.php');
$app_id = '130666';
$app_key = '64c1568039c2b37cc9da';
$app_secret = 'e12fb6a2a8eb232cc611';

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

require('pages/homepage.php');

$app->get(
  '/api/new/doctor', function() {
    require('connect.php');
    global $app;
		$request = $app->request();
		$data = $request->params();

    $email = $data['email'];
    /*
    $password = $data['password'];
    $password2 = $data['confirm_password'];
    $name = $data['name'];
    $specialty = $data['specialty'];
    $location = $data['location'];
    $cpso = $data['cpso'];
    */

    if (strlen($email, "@") < 0) {
      $response = array(
        "response":"error",
        "message":"invalid email"
      )
      echo json_encode($response);
      exit;
    }
  }
);

$app->get(
  '/', function() {
    echo <<<HTML
    <form action="/api/new/doctor" method="POST">
      <input type="text" name="email">
      <input type="submit" value="Submit">
    </form>
HTML;
  }
);


$app->run();
