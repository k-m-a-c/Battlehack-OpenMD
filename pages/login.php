<?php
$app->get(

  '/login', function() {

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

    <div id="login-page" class="form-page container-fluid">
      <h1>Login</h1>

      <div class="row">
        <div class="form-group col-md-12">
          <label class="check-label">I am a </label>
          <label class="radio-inline">
            <input type="radio"  name="radio" class="radio" value="Patient" checked="checked"> Patient
          </label>
          <label class="radio-inline">
            <input type="radio"  name="radio" class="radio" value="Doctor"> Doctor
          </label>
        </div>
      </div>
      
      <div id="patient-login">
        <div class="alert alert-danger" role="alert"></div>
        <form id="patientLoginForm" action="/api/login/patient" method="POST">
          
          <div class="row">
            <div class="form-group col-md-12">
              <label for="uName">Email</label>
              <input type="text" class="form-control" id="uName" placeholder="" name="email">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="pWord">Password</label>
              <input type="text" class="form-control" id="pWord" placeholder="" name="password">
            </div>
          </div>

          <button type="submit" class="btn btn-default">Login</button>
        </form>
      </div>

      <div id="doctor-login">
        <div class="alert alert-danger" role="alert"></div>
        <form id="doctorLoginForm" action="/api/login/doctor" method="POST">
          
          <div class="row">
            <div class="form-group col-md-12">
              <label for="uName">Email</label>
              <input type="text" class="form-control" id="uName" placeholder="" name="email">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="pWord">Password</label>
              <input type="text" class="form-control" id="pWord" placeholder="" name="password">
            </div>
          </div>

          <button type="submit" class="btn btn-default">Login</button>
        </form>
      </div>

      <div class="row">
        <form id="checkout" method="post" action="/checkout">
          <div id="payment-form"></div>
          <input type="submit" value="Pay $20">
        </form>
      </div>
    </div>

   $footer_template

   <script>
      //ajax form submit
      $(document).ready(function(){
        $('#patientLoginForm').ajaxForm();
        $('#doctorLoginForm').ajaxForm();

        // attach handler to form's submit event
        $('#patientLoginForm').submit(submitHandler);
        $('#doctorLoginForm').submit(submitHandler);

        function submitHandler() {
            // submit the form
            $(this).ajaxSubmit({ 'success': function(responseText, statusText, xhr, form)  {
                  var resp = $.parseJSON( responseText );
                  if (resp.response && resp.response == "error") {
                    $('.alert-danger').text(resp.message).show();
                  } else {
                    $('.alert-danger').hide();
                    if ( resp.user_type == "patient" ){ 
                      $.get( "/api/check/patient/payed", function( resp ) {
                          console.log('resp: ' + resp);
                          //if ( resp == "0" ) {
                            $.get( "/get/braintree/token", function( data ) {
                              loadPayment(data);
                            });
                          /*} else {
                            console.log('redirect to main')
                            // redirect to main
                          }*/
                      });
                    } else {
                      console.log('redirect to main')
                      // redirect to main
                    }
                  }
              }
            });
            // return false to prevent normal browser submit and page navigation
            return false;
        }

        function loadPayment(token) {
          $('#checkout').show();
          braintree.setup(token, "dropin", {
              container: "payment-form"
          });
        }
        
      });

    $(document).ready(function() {
      $('.radio').on('change', function() {
        var name = $(this).val();
        if ( name == "Doctor" ) {
          $('#patient-login').hide();
          $('#doctor-login').show();
        } else {
          $('#patient-login').show();
          $('#doctor-login').hide();
        }
      });
    });
    </script>

  </body>
</html>
HTML;
  }
);
?>
