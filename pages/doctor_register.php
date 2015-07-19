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
    <title>Open MD Doctor Registration</title>

    $header_template

  </head>
 <body>

  $nav_template

    <div id="doctor-register" class="form-page container-fluid">
      <h1>Sign Up for a Doctor Account</h1>

      <h3>Basic Information</h3>

      <div>
        <div class="alert alert-danger" role="alert"></div>
        <form id="doctorRegistrationForm" action="/api/new/doctor" method="POST">
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="rpName">First Name</label>
              <input type="text" class="form-control" id="rpName" placeholder="Name" name="name">
            </div>
            <div class="form-group col-xs-6">
              <label for="rpName">Last Name</label>
              <input type="text" class="form-control" id="rpName" placeholder="Name" name="name">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="rpCity">City</label>
              <input type="text" class="form-control" id="rpCity" placeholder="City" name="city">
            </div>
            <div class="form-group col-xs-6">
              <label for="rpCountry">Country</label>
              <input type="text" class="form-control" id="rpCountry" placeholder="Country" name="country">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="rpNameOfInstitution">Name of Institution</label>
              <input type="text" class="form-control" id="rpNameOfInstitution" placeholder="Add the name of your hospital or institution here" name="institution">
            </div>
            <div class="form-group col-xs-6">
              <label for="rpCSPONumber">CSPO #</label>
              <input type="text" class="form-control" id="rpCSPONumber" placeholder="Add your CSPO # here" name="cspo">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="rpInstitutionalEmail">Institutional email address</label>
              <input type="email" class="form-control" id="rmEmail" placeholder="Tpye in your institutional email address" name="email">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="rpPassword1">Password</label>
              <input type="password" class="form-control" id="rpPassword1" placeholder="Password" name="password">
            </div>
            <div class="form-group col-xs-6">
              <label for="rpPassword2">Confirm Password</label>
              <input type="password" class="form-control" id="rpPassword2" placeholder="Password" name="confirm_password">
            </div>
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div>

   $footer_template

   <script>
      //ajax form submit
      $(document).ready(function(){
        $('#doctorRegisterForm').ajaxForm();

        // attach handler to form's submit event
        $('#doctorRegisterForm').submit(function() {
            // submit the form
            $(this).ajaxSubmit({ 'success': function(responseText, statusText, xhr, form)  {
                  var resp = $.parseJSON( responseText );
                  if (resp.response && resp.response == "error") {
                    $('.alert-danger').text(resp.message).show();
                  }
              }
            });
            // return false to prevent normal browser submit and page navigation
            return false;
        });
    </script>

  </body>
</html>
HTML;
  }
);
?>