<?php
$app->get(

  // THIS IS THE LIST OF DOCTORS
  // THE PAGE IS INTENDED FOR USE BY PATIENTS

  '/patient_doctor_list', function() {

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
    <title>Open MD | Doctor List</title>

    $header_template

  </head>
 <body>

  $nav_template

    <!-- TABBED NAV -->
    <div id="patient-doctor-list-nav" class="container-fluid">
      <h1>Your Doctor List</h1>
      <p>Click one of the tabs below to browse your existing doctors, add new
      doctors, and respond to doctor requests.</p>

      <ul class="nav nav-tabs inline-list" role="tablist" id="navList">

        <li class="nav-tab active">
          <a href="#yourDoctors" aria-controls="yourDoctors" role="tab" data-toggle="tab" id="yourDoctors-tab">Your Doctors</a>
        </li>

        <li class="nav-tab">
          <a href="#addDoctor" aria-controls="addDoctor" role="tab" data-toggle="tab" id="addDoctor-tab">Add a Doctor</a>
        </li>

        <li class="nav-tab">
          <a href="#doctorRequests" aria-controls="doctorRequests" role="tab" data-toggle="tab" id="doctorRequests-tab">Doctor Requests</a>
        </li>
      </ul>
    </div>

    <!-- TAB PANES -->
    <div id="patient-doctor-list-panes" class="container-fluid tab-content">

      <div role="tabpanel" class="tab-pane fade active in" aria-labelled-by="yourDoctors-tab" id="yourDoctors">

        <div class="your-doctor inline-list" id="yourDoctor">
          <span>First Name</span>
          <span>Second Name</span>
          <span>Institution Name</span>
          <span>Area of Specialty</span>
          <button><a href="#">See Doctor Profile</a></button>
        </div>

      </div>

      <div role="tabpanel" class="tab-pane fade in" id="addDoctor" aria-labelled-by="addDoctor-tab">

        <div class="doctor inline-list" id="doctor">
          <span>First Name</span>
          <span>Second Name</span>
          <span>Institution Name</span>
          <span>Area of Specialty</span>
          <button><a href="#">Add as Your Doctor</a></button>
        </div>

      </div>

      <div role="tabpanel" class="tab-pane fade in" id="doctorRequests" aria-labelled-by="doctorRequests-tab">

        <div class="doctor-request inline-list" id="doctor-request">
          <span>First Name</span>
          <span>Second Name</span>
          <span>Institution Name</span>
          <span>Area of Specialty</span>
          <button><a href="#">Accept Doctor</a></button>
        </div>

      </div>
    </div>

   $footer_template

    <script>
      //handle tab navigation
      $('#navList a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      });

      //get all doctors and append to #addDoctor div
      $.getJSON( "api/patient/home", function( data ) {
        var items = [];
        $.each( data, function( key, val ) {
          items.push( "<li id='" + key + "'>" + val + "</li>" );
        });

        $( "<ul/>", {
          "class": "doctor",
          html: items.join( "" )
        }).appendTo( "#addDoctor" );
      });

      //get all doctor requests and append to #doctorRequests div
      $.getJSON( "api/patient/home", function( data ) {
        var items = [];
        $.each( data, function( key, val ) {
          items.push( "<li id='" + key + "'>" + val + "</li>" );
        });

        $( "<ul/>", {
          "class": "doctor-request",
          html: items.join( "" )
        }).appendTo( "#doctorRequests" );
      });

    </script>
  </body>
</html>
HTML;
  }
);
?>
