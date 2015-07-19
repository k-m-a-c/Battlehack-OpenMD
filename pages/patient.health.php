<?php
$app->get(

  '/patient/health', function() {

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
    <title>Open MD | Home</title>

    $header_template

  </head>
 <body>

 	$nav_template

    <div id="health-status-update" class="container-fluid">
        <div class="update-header row">
          <h1>Update your Health Status</h1>
          <a class="col-md-4" href="health_status_update"><div class="btn btn-default btn-group-lg">+ Add Status Entry</div></a>
        </div>

        <h3 id="chart-header">Your vitals over time</h3>
        <canvas id="chart" width="640" height="400"></canvas>
        <div class="row">
          <div class="buttons col-md-4 chart-buttons" role="group" >
            <div class="btn btn-default btn-group-lg col-md-4" data-id="vital">Vital Signs</div>
            <div class="btn btn-default btn-group-lg col-md-4" data-id="health_status">Physical Health Score</div>
            <div class="btn btn-default btn-group-lg col-md-4" data-id="mental_status">Mental Health Score</div>
          </div>
        </div>

        <div id="details" class="col-md-8">
          <h4>Health status at: <span class="date_created"></span></h4>
          <p class="additional_info"></p>
          <table class="table table-stripped">
              <thead>
                  <tr>
                      <th>Indicator</th>
                      <th>Value</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>Physical Health Score</td>
                      <td class="physical_health"></td>
                  </tr>
                  <tr>
                      <td>Mental Health Score</td>
                      <td class="mental_health"></td>
                  </tr>
                  <tr>
                      <td>Body Temperature</td>
                      <td class="body_temp"></td>
                  </tr>
                  <tr>
                      <td>Blood Pressure</td>
                      <td class="blood_pressure"></td>
                  </tr>
                  <tr>
                      <td>Heart Rate</td>
                      <td class="heart_rate"></td>
                  </tr>
                  <tr>
                      <td>Respiratory Rate</td>
                      <td class="respiratory_rate"></td>
                  </tr>
              </tbody>
          </table>
        </div>
    </div>

   $footer_template

    <script>
      var myData;
      $.getJSON('/patient/health/$user_id', function( data ){
        myData = data;
        initializePage();
      });
    </script>
    <script src="js/lib/charts.min.js"></script>
    <script src="js/healthchart.js"></script>

  </body>
</html>
HTML;
  }
);
?>