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

    <div id="patient-register" class="form-page container-fluid">
      <h1>Sign Up for a Patient Account</h1>

      <h3>Basic Information</h3>

      <div>
        <div class="alert alert-danger" role="alert"></div>
        <form id="patientRegisterForm" action="/api/new/patient" method="POST">
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
              <label for="rpBirthday">Birthday</label>
              <input type="date" class="form-control" id="rpBirthday" placeholder="Birthday" name="birthday">
            </div>
            <div class="form-group col-xs-6">
              <label for="rpGender">Gender</label><br/>
              <label class="radio-inline">
                <input type="radio" name="gender" id="inlineRadio1" value="Male"> Male
              </label>
              <label class="radio-inline">
                <input type="radio" name="gender" id="inlineRadio2" value="Female"> Female
              </label>
              <label class="radio-inline">
                <input type="radio" name="gender" id="inlineRadio3" value="Other"> Other
              </label>
            </div>
          </div> 
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="rpHealthcard8">City</label>
              <input type="text" class="form-control" id="rpHealthcard8" placeholder="City" name="city">
            </div>
            <div class="form-group col-xs-6">
              <label for="rpHealthcard8">Country</label>
              <input type="text" class="form-control" id="rpHealthcard8" placeholder="Country" name="country">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="rpHealthcard">Healthcard Nubmer</label>
              <input type="text" class="form-control" id="rpHealthcard" placeholder="Healthcard Number" name="healthcard">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="rpEmail">Email address</label>
              <input type="email" class="form-control" id="rmEmail" placeholder="Email" name="email">
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


          <h3>Medical History</h3>

          <h4>Current Medication</h4>
          <p>Please list all the medications you are currently taking</p>

          <div class="row">
            <div class="form-group col-xs-3">
              <label for="">Name of drug</label>
              <input type="text" class="form-control" id="" name="med_name[]">
            </div>
            <div class="form-group col-xs-3">
              <label for="">Dosage</label>
              <input type="text" class="form-control" id="" name="med_dosage[]">
            </div>
            <div class="form-group col-xs-3">
              <label for="">Frequency (weekly)</label>
              <input type="text" class="form-control" id="" name="med_freq[]">
            </div>
          </div>
          <div class="btn btn-default col-xs-3 add-row">+ Add a medication</div><br/><br/><br/>

          <h4>Past Surgeries</h4>
          <p>Please list all the surgeries you have had</p>

          <div class="row">
            <div class="form-group col-xs-3">
              <label for="">Type of Procedure</label>
              <input type="text" class="form-control" id="" name="surgery_type[]">
            </div>
            <div class="form-group col-xs-4">
              <label for="">Date of Procedure</label>
              <input type="date" class="form-control" id="" name="surgery_date[]">
            </div>
          </div>
          <div class="btn btn-default col-xs-3 add-row">+ Add a surgery</div><br/><br/><br/>


          <h4>Allergies</h4>
          <p>Please list all the allergies you have</p>

          <div class="row">
            <div class="form-group col-xs-6">
              <label for="">Name of allergy</label>
              <input type="text" class="form-control" id="" name="allergy[]">
            </div>
          </div>
          <div class="btn btn-default col-xs-3 add-row">+ Add an allergy</div><br/><br/><br/>


          <h4>Pre-existing conditions</h4>
          <p>Please list all of your existing medical conditions</p>

          <div class="row">
            <div class="form-group col-xs-6">
              <label for="">Name of condition</label>
              <input type="text" class="form-control" id="" name="condition[]">
            </div>
          </div>
          <div class="btn btn-default col-xs-3 add-row">+ Add a condition</div><br/><br/><br/>


          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div>

   $footer_template

   <script>
      //ajax form submit
      $(document).ready(function(){
        $('#patientRegisterForm').ajaxForm();

        // attach handler to form's submit event 
        $('#patientRegisterForm').submit(function() { 
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

      //dynamic form elements
      $(document).ready(function(){
        $('.add-row').on('click',function(){
            var inputs = $(this).prev().clone();
            inputs.find('label').remove();
            inputs.find('input').val('');
            $(this).before(inputs.get(0));
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