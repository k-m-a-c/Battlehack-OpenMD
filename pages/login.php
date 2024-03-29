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

      <div class="login-forms">
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
                <input type="password" class="form-control" id="pWord" placeholder="" name="password">
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
      </div>

      <div class="row paypal">
        <h4>Please submit a one one time paymet of $25 to use OpenMD</h4>
        <form id="checkout" method="post" action="/patient/pay">
          <div id="payment-form"></div>
          <input class="btn btn-default" type="submit" value="Pay $25">
        </form>
      </div>
    </div>

   $footer_template

   <script>
      //ajax form submit
      $(document).ready(function(){
        $('#patientLoginForm').ajaxForm({
          success: function(responseText)  {
              submitHandler( responseText );
              return false;
          }
        });
        $('#doctorLoginForm').ajaxForm({
          success: function(responseText)  {
              submitHandler( responseText );
              return false;
          }
        });

        function submitHandler( response ) {
            // submit the form
              var resp = $.parseJSON( response );
              if (resp.response && resp.response == "error") {
                $('.alert-danger').text(resp.message).show();
              } else {
                  $('.alert-danger').hide();
                  if ( resp.user_type == "patient" ){
                    $.get( "/api/check/patient/payed", function( resp ) {
                        console.log('resp: ' + resp);
                        if ( resp == "0" ) {
                          $.get( "/get/braintree/token", function( data ) {
                            loadPayment(data);
                          });
                        } else {
                          console.log('redirect to main')
                          // redirect to main patient page
                          location.href = location.origin + '/patient/home';
                        }
                    });
                  } else {
                    console.log('redirect to main')
                    location.href = location.origin + '/doctor/home';
                  }
                }
        }

        function loadPayment(token) {
          $('.paypal').show();
          $('.login-forms').hide();
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
