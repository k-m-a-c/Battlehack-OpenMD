<?php
$app->get(

  // THIS IS THE LIST OF PATIENTS
  // THE PAGE IS INTENDED FOR USE BY DOCTORS

  '/patient_doctor_list', function() {

  require('header.php');
  require('nav-internal.php');
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
      <p>Click one of the tabs below to browse your existing patients, add new
      patients, and respond to patient requests.</p>

      <ul class="nav nav-tabs inline-list" role="tablist" id="navList">

        <li class="nav-tab active">
          <a href="#yourPatients" aria-controls="yourPatients" role="tab" data-toggle="tab" id="yourPatients-tab">Your Doctors</a>
        </li>

        <li class="nav-tab">
          <a href="#addPatient" aria-controls="addPatient" role="tab" data-toggle="tab" id="addPatient-tab">Add a Doctor</a>
        </li>

        <li class="nav-tab">
          <a href="#patientRequests" aria-controls="patientRequests" role="tab" data-toggle="tab" id="patientRequests-tab">Doctor Requests</a>
        </li>
      </ul>
    </div>

    <!-- TAB PANES -->
    <div id="doctor-patient-list-panes" class="container-fluid tab-content">

      <div role="tabpanel" class="tab-pane fade active in" aria-labelled-by="yourPatients-tab" id="yourPatients">

        <div class="your-patient inline-list" id="yourPatient">
          <span>First Name</span>
          <span>Second Name</span>
          <span>City</span>
          <span>Country</span>
          <button><a href="#">See Patient Profile</a></button>
        </div>

      </div>

      <div role="tabpanel" class="tab-pane fade in" id="addPatient" aria-labelled-by="addPatient-tab">
      </div>

      <div role="tabpanel" class="tab-pane fade in" id="patientRequests" aria-labelled-by="patientRequests-tab">
      </div>
    </div>

   $footer_template

    <script>
      $('#navList a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      });

      $.get('/api/patient/my/doctors', function(data) {
        data = JSON.parse(data);
        var html = "<table border='1'>";
        $.each(data, function(i,d) {
          html += "<tr>";
            html += "<td><a href='"+d.doctor_profile_link+"'>"+d.name+"</a></td>";
            html += "<td>"+d.city+" "+d.country+"</td>";
            html += "<td>"+d.healthcard+"</td>";
          html += "</tr>";
        });
        html += "</table>";
        $('#yourPatients').html(html);
      });

      $.get('/api/patient/home', function(data) {
        data = JSON.parse(data);
        var html = "<table border='1'>";
        $.each(data, function(i,d) {
          html += "<tr>";
            html += "<td><a href='"+d.doctor_profile_link+"'>"+d.name+"</a></td>";
            html += "<td>"+d.location+"</td>";
            html += "<td>"+d.hospital+"</td>";
            html += "<td><a href='"+d.request_doctor_link+"'>Request Doctor</a></td>";
          html += "</tr>";
        });
        html += "</table>";
        $('#addPatient').html(html);
      });

      $.get('/api/patient/requests', function(data) {
        data = JSON.parse(data);
        var html = "<table border='1'>";
        $.each(data, function(i,d) {
          html += "<tr>";
            html += "<td><a href='"+d.doctor_profile_link+"'>"+d.name+"</a></td>";
            html += "<td>"+d.location+"</td>";
            html += "<td>"+d.hospital+"</td>";
            html += "<td><a href='"+d.accept_doctor_link+"'>Accept Doctor</a></td>";
          html += "</tr>";
        });
        html += "</table>";
        $('#patientRequests').html(html);
      });

    </script>
  </body>
</html>
HTML;
  }
);

$app->get(

  // THIS IS THE LIST OF PATIENTS
  // THE PAGE IS INTENDED FOR USE BY DOCTORS

  '/doctor_patient_list', function() {

  require('header.php');
  require('nav-internal.php');
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
      <p>Click one of the tabs below to browse your existing patients, add new
      patients, and respond to patient requests.</p>

      <ul class="nav nav-tabs inline-list" role="tablist" id="navList">

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
    <div id="doctor-patient-list-panes" class="container-fluid tab-content">

      <div role="tabpanel" class="tab-pane fade active in" aria-labelled-by="yourPatients-tab" id="yourPatients">

        <div class="your-patient inline-list" id="yourPatient">
          <span>First Name</span>
          <span>Second Name</span>
          <span>City</span>
          <span>Country</span>
          <button><a href="#">See Patient Profile</a></button>
        </div>

      </div>

      <div role="tabpanel" class="tab-pane fade in" id="addPatient" aria-labelled-by="addPatient-tab">
      </div>

      <div role="tabpanel" class="tab-pane fade in" id="patientRequests" aria-labelled-by="patientRequests-tab">
      </div>
    </div>

   $footer_template

    <script>
      $('#navList a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      });

      $.get('/api/doctor/my/patients', function(data) {
        data = JSON.parse(data);
        var html = "<table border='1'>";
        $.each(data, function(i,d) {
          html += "<tr>";
            html += "<td><a href='"+d.patient_profile_link+"'>"+d.name+"</a></td>";
            html += "<td>"+d.city+" "+d.country+"</td>";
            html += "<td>"+d.healthcard+"</td>";
          html += "</tr>";
        });
        html += "</table>";
        $('#yourPatients').html(html);
      });

      $.get('/api/doctor/home', function(data) {
        data = JSON.parse(data);
        var html = "<table border='1'>";
        $.each(data, function(i,d) {
          html += "<tr>";
            html += "<td><a href='"+d.patient_profile_link+"'>"+d.name+"</a></td>";
            html += "<td>"+d.city+" "+d.country+"</td>";
            html += "<td>"+d.healthcard+"</td>";
            html += "<td><a href='"+d.request_patient_link+"'>Request Patient</a></td>";
          html += "</tr>";
        });
        html += "</table>";
        $('#addPatient').html(html);
      });

      $.get('/api/doctor/requests', function(data) {
        data = JSON.parse(data);
        var html = "<table border='1'>";
        $.each(data, function(i,d) {
          html += "<tr>";
            html += "<td><a href='"+d.patient_profile_link+"'>"+d.name+"</a></td>";
            html += "<td>"+d.city+" "+d.country+"</td>";
            html += "<td>"+d.healthcard+"</td>";
            html += "<td><a href='"+d.accept_patient_link+"'>Accept Patient</a></td>";
          html += "</tr>";
        });
        html += "</table>";
        $('#patientRequests').html(html);
      });

    </script>
  </body>
</html>
HTML;
  }
);
?>
