<?php
$app->get(

  '/home', function() {

  require('header.php');
	require('nav.php');
	require('footer.php');

  echo <<<HTML
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Open MD</title>

    $header_template

  </head>
 <body>

 	$nav_template

    <div id="splash" class="container">
        <div class="row">
            <h1>Open MD</h1>
        </div>

        <div class="row">
            <h2>Providing the best possible care requires having the most recent information</h2>
        </div>

        <div class="row">
            <p>Sign Up!</p>
        </div>

        <div class="row">
          <p>$10 per month</p>
          <p>Free</p>
        </div>

        <div class="btn-group buttons" role="group" aria-label="...">
          <a href="patient_register"><button type="button" class="btn btn-default btn-group-lg">Patients</button></a>
          <a href="doctor_register"><button type="button" class="btn btn-default btn-group-lg">Doctors</button></a>
        </div>

    </div>

   $footer_template

  </body>
</html>
HTML;
  }
);
?>
