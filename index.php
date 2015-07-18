<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

require('Pusher.php');

$app_id = '130666';
$app_key = '64c1568039c2b37cc9da';
$app_secret = 'e12fb6a2a8eb232cc611';

$app->get(
  '/', function() {
    echo "Test2";
  }
);

$app->get(
  '/pusher/check_users', function() {
    $response = $pusher->get( '/channels/presence-channel-name/users' );
    if( $response[ 'status'] == 200 ) {
      // convert to associative array for easier consumption
      $users = json_encode($response['body']);
    }
    echo $users;
  }
);

$app->get(
    '/test',
    function () {
      echo <<<HTML
      <!DOCTYPE html>
      <html>
        <head>
          <title>Pusher Test</title>
          <script src="https://js.pusher.com/2.2/pusher.min.js"></script>
          <script>
            // Enable pusher logging - don't include this in production
            Pusher.log = function(message) {
              if (window.console && window.console.log) {
                window.console.log(message);
              }
            };

            var pusher = new Pusher('64c1568039c2b37cc9da', {
              encrypted: true
            });
            var channel = pusher.subscribe('test_channel');
            channel.bind('my_event', function(data) {
              alert(data.name+" Message:"+data.message);
            });
          </script>
        </head>
        <body>
          <h1>Pusher Template</h1>
        </body>
      </html>
HTML;
    }
);

$app->run();
