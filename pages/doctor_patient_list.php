<?php
$app->get(

  '/doctor_patient_list', function() {

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

    <!-- TABBED NAV -->
    <div id="doctor-patient-list-nav" class="container-fluid">
      <h1>Your Patient List</h1>
      <ul class="nav nav-tabs inline-list">
        <li class="nav-tab active">
          <a href="#yourPatients" aria-controls="yourPatients" role="tab" data-toggle="tab" id="yourPatients-tab">Your Patients</a>
        </li>

        <li class="nav-tab">
          <a href="#addPatient" aria-controls="addPatient" role="tab" data-toggle="tab" id="addPatient-tab">Add a Patient</a>
        </li>

        <li class="nav-tab">
          <a href="#patientRequests" aria-controls="patientRequests" role="tab" data-toggle="tab" id="patientRequests-tab">Patient Requests</a>
        </li>
      </ul>
    </div>

    <!-- TAB PANES -->
    <div id="doctor-patient-list-panes" class="container-fluid">

      <div role="tabpanel" class="tab-pane fade active in active" aria-labelled-by="yourPatients-tab" id="yourPatients">
        <p>All ze patients!</p>
      </div>
      <div role="tabpanel" class="tab-pane fade active in" id="addPatient" aria-labelled-by="addPatient-tab">
        <p>Add a patient</p>
      </div>
      <div role="tabpanel" class="tab-pane fade active in" id="patientRequests" aria-labelled-by="patientRequests-tab">
        <p>Respond to patient requests</p>
      </div>
    </div>

   $footer_template

    <script>
      $('#nav-tabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      });

      $('#myTabs li:eq(0) a').tab('show') // Select first tab (0-indexed)
      $('#myTabs li:eq(1) a').tab('show') // Select second tab (0-indexed)
      $('#myTabs li:eq(2) a').tab('show') // Select third tab (0-indexed)

    </script>
  </body>
</html>
HTML;
  }
);
?>
