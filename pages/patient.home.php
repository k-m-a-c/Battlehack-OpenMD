<?php
$app->get('/patient/home', function() {
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
      <title>Open MD | Patient Home</title>

      $header_template

    </head>
   <body>

    $nav_template

    <div class="list"></div>

    $footer_template
    <script>
    $(document).ready(function() {
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
        $('.list').html(html);
      });
    });
    </script>
    </body>
  </html>
HTML;
});

$app->get('/api/patient/home', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "patient") {
    global $app;
    $app->redirect('/');
  }
  $patientId = $_SESSION['user_id'];
  $data = array();
  foreach($db->query("SELECT * FROM doctors") as $row) {
    $d = array(
      'doctor_profile_link' => "/doctor/u/".$row['id'],
      'name' => $row['name'],
      'location' => $row['location'],
      'hospital' => $row['hospital'],
      'request_doctor_link' => "/api/patient/add/doctor/".$row['id']
    );
    array_push($data,$d);
  }
  echo json_encode($data);
});

$app->get('/patient/requests', function() {
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
      <title>Open MD | Patient Home</title>

      $header_template

    </head>
   <body>

    $nav_template

    <div class="list"></div>

    $footer_template
    <script>
    $(document).ready(function() {
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
        $('.list').html(html);
      });
    });
    </script>
    </body>
  </html>
HTML;
});

$app->get('/api/patient/requests', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "patient") {
    global $app;
    $app->redirect('/');
  }
  $patientId = $_SESSION['user_id'];

  $data = array();

  foreach($db->query("SELECT * FROM doctors
  JOIN doctorspatients ON doctorspatients.doctorId = doctors.id
  WHERE doctorspatients.patientId = '$patientId'
  GROUP BY doctors.id") as $row) {
    $d = array(
      'doctor_profile_link' => "/doctor/u/".$row['id'],
      'name' => $row['name'],
      'location' => $row['location'],
      'hospital' => $row['hospital'],
      'accept_doctor_link' => "/accept/doctor/".$row['id']
    );
    array_push($data,$d);
  }

  echo json_encode($data);
});

$app->get('/api/patient/my/doctors', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "patient") {
    global $app;
    $app->redirect('/');
  }
  $patientId = $_SESSION['user_id'];

  $data = array();

  foreach($db->query("SELECT * FROM doctors
  JOIN accepted_doctors ON accepted_doctors.doctorId = doctors.id
  WHERE accepted_doctors.patientId = '$patientId'
  GROUP BY doctors.id") as $row) {
    $d = array(
      'doctor_profile_link' => "/doctor/u/".$row['id'],
      'name' => $row['name'],
      'location' => $row['location'],
      'hospital' => $row['hospital'],
    );
    array_push($data,$d);
  }

  echo json_encode($data);
});

?>
