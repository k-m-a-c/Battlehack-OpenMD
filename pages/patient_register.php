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

    <div id="patient-register" class="form-page">
      <h1>Sign Up for a Patient Account</h1>

      <div>
        <form id="patientRegisterForm" action="/api/new/patient" method="POST">
          <div class="form-group">
            <label for="rpEmail">Email address</label>
            <input type="email" class="form-control" id="rmEmail" placeholder="Email" name="email">
          </div>
          <div class="form-group">
            <label for="rpPassword1">Password</label>
            <input type="password" class="form-control" id="rpPassword1" placeholder="Password" name="password">
          </div>
          <div class="form-group">
            <label for="rpPassword2">Confirm Password</label>
            <input type="password" class="form-control" id="rpPassword2" placeholder="Password" name="confirm_password">
          </div>
          <div class="form-group">
            <label for="rpName">Name</label>
            <input type="text" class="form-control" id="rpName" placeholder="Name" name="name">
          </div>
          <div class="form-group">
            <label for="rpGender">Gender</label>
            <input type="text" class="form-control" id="rpGender" placeholder="Gender" name="gender">
          </div>
          <div class="form-group">
            <label for="rpBirthday">Birthday</label>
            <input type="text" class="form-control" id="rpBirthday" placeholder="Birthday" name="birthday">
          </div>
          <div class="form-group">
            <label for="rpHealthcard">Healthcard Nubmer</label>
            <input type="text" class="form-control" id="rpHealthcard" placeholder="Healthcard Number" name="healthcard">
          </div>
         
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div>

   $footer_template

   <script>
    $(document).ready(function(){
      $('#patientRegisterForm').ajaxForm();

      // attach handler to form's submit event 
      $('#patientRegisterForm').submit(function() { 
          // submit the form 
          $(this).ajaxSubmit({ 'success': function(responseText, statusText, xhr, form)  { 
                console.log('responseText: ' + responseText);
                console.log('statusText: ' + statusText);
            } 
          }); 
          // return false to prevent normal browser submit and page navigation 
          return false; 
      });

    });
    </script>

  </body>
</html>
HTML;
  }
);
?>