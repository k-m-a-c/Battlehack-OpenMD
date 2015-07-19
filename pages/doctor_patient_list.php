<?php
$app->get(

  '/doctor_register', function() {

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
    <title>Open MD | Patient List</title>

    $header_template

  </head>
 <body>

  $nav_template

    <div id="doctor-patient-list" class="container-fluid">
      <h1>Your Patient List</h1>
      <ul class="nav nav-tabs inline-list">
        <li class="active"><a href="#">Your Patients</a></li>
        <li class="active"><a href="#">Add a Patient</a></li>
        <li class="active"><a href="#">Patient Requests</a></li>
      </ul>
    </div>

   $footer_template

  </body>
</html>
HTML;
  }
);
?>
