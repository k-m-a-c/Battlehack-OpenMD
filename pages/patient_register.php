<?php
$app->get(
 
  '/patient_register', function() {
  	
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
    <title>Open MD Patient Registration</title>

    $header_template
    
  </head>
 <body>
    
 	$nav_template

    <div id="patient-registers" class="form-page">
      <h1 class="col-md-4">Sign Up for a Patient Account</h1>

      <div class="col-md-4">
        <form action="/api/new/patient" method="POST">
          <div class="form-group">
            <label for="rpEmail">Email address</label>
            <input type="email" class="form-control" id="rmEmail" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="rpPassword1">Password</label>
            <input type="password" class="form-control" id="rpPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="rpPassword2">Confirm Password</label>
            <input type="password" class="form-control" id="rpPassword2" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="rpName">Name</label>
            <input type="text" class="form-control" id="rpName" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="rpGender">Gender</label>
            <input type="text" class="form-control" id="rpGender" placeholder="Gender">
          </div>
          <div class="form-group">
            <label for="rpBirthday">Birthday</label>
            <input type="text" class="form-control" id="rpBirthday" placeholder="Birthday">
          </div>
          <div class="form-group">
            <label for="rpHealthcard">Healthcard Nubmer</label>
            <input type="text" class="form-control" id="rpHealthcard" placeholder="Healthcard Number">
          </div>
         
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div>

   $footer_template

  </body>
</html>
HTML;
  }
);
?>