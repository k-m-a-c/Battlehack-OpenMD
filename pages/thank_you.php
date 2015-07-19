<?php
$app->get(
  '/doctor_thank_you', function() {

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
	    <title>Open MD | Doctor Thank You</title>

	    $header_template

	  </head>
	 <body>

	  $nav_template

	    <div id="thank-you" class="form-page container-fluid">
	        <div class="row">
	          <div class="alert alert-success col-md-12" role="alert">Registration Successful</div>
	        </div>
	        <div class="row">
	          <h4 class="col-md-12">Thank you for signing up for OpenMD! We'll get in touch as soon as we verify your identity.</h4>
	        </div>
	      </div>

	      
	   $footer_template


	  </body>
	</html>
HTML;

  }
);
?>
