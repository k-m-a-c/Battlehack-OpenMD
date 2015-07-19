<?php
$app->get(

  '/health_status_update', function() {

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
    <title>Open MD Health Status Update Form</title>

    $header_template

  </head>
 <body>

  $nav_template

    <div id="health-status-update" class="form-page">
      <h1>OpenMD | Create your Health Status Update</h1>

      <div>
        <div class="alert alert-danger" role="alert"></div>
        <form id="healthStatusUpdateForm" action="/api/new/patient" method="POST">

          <div class="form-group">
            <label for="rpPhysicalHealthScore">Physical Health Score</label>
            <input type="number" class="form-control" id="rmPhysicalHealthScore" placeholder="number">
          </div>

          <div class="form-group">
            <label for="rpMentalHealthScore">Mental Health Score</label>
            <input type="number" class="form-control" id="rmMentalHealthScore" placeholder="number">
          </div>

          <div class="form-group">
            <label for="rpBodyTemperature">Body Temperature</label>
            <input type="number" class="form-control" id="rpBodyTemperature" placeholder="Type in your body temperature">
          </div>

          <div class="form-group">
            <label for="rpBloodPressure">Blood Pressure</label>
            <input type="number" class="form-control" id="rpBloodPressure" placeholder="Type in your blood pressure">
          </div>

          <div class="form-group">
            <label for="rpName">Heart Rate</label>
            <input type="number" class="form-control" id="rpHeartRate" placeholder="Type in your heart rate">
          </div>

          <div class="form-group">
            <label for="rpRespiratoryRate">Respiratory Rate</label>
            <input type="number" class="form-control" id="rpRespiratoryRate" placeholder="Type in your respiratory rate">
          </div>

          <div class="form-group">
            <label for="rpAdditionalInformation">Additional Information</label>
            <input type="text" class="form-control" id="rpAdditionalInformation" placeholder="Say more about how you're feeling today!">
          </div>

          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div>

   $footer_template

   <script>
    $(document).ready(function(){
      $('#healthStatusUpdateForm').ajaxForm();

      // attach handler to form's submit event
      $('#healthStatusUpdateForm').submit(function() {
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

    });
    </script>

  </body>
</html>
HTML;
  }
);
?>