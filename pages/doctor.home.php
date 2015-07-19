<?php
$app->get('/doctor/home', function() {
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
      <title>Open MD | Doctor Home</title>

      $header_template

    </head>
   <body>

    $nav_template

    <div class="list"></div>

    $footer_template
    <script>
    $(document).ready(function() {
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
        $('.list').html(html);
      });
    });
    </script>
    </body>
  </html>
HTML;
});

$app->get('api/doctor/home', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "doctor") {
    global $app;
    $app->redirect('/');
  }
  $data = array();
  foreach($db->query("SELECT * FROM patients") as $row) {
    $d = array(
      'patient_profile_link' => "/patient/u/".$row['id'],
      'name' => $row['name'],
      'city' => $row['city'],
      'country' => $row['country'],
      'healthcard' => $row['healthcard'],
      'request_patient_link' => "/api/doctor/add/patient/".$row['id']
    );
    array_push($data,$d);
  }

  echo json_encode($data);
});

$app->get('/doctor/home', function() {
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
      <title>Open MD | Doctor Home</title>

      $header_template

    </head>
   <body>

    $nav_template

    <div class="list"></div>

    $footer_template
    <script>
    $(document).ready(function() {
      $.get('/api/doctor/home', function(data) {
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
        $('.list').html(html);
      });
    });
    </script>
    </body>
  </html>
HTML;
});

$app->get('api/doctor/requests', function() {
  require('connect.php');
  if ($_SESSION['user_type'] != "doctor") {
    global $app;
    $app->redirect('/');
  }
  $doctorId = $_SESSION['user_id'];

  $data = array();

  foreach($db->query("SELECT * FROM patients
  JOIN patients_wanting_doctors ON patients.id = patients_wanting_doctors.patientId
  WHERE patients_wanting_doctors.doctorId = '$doctorId'
  GROUP BY patients.id") as $row) {
    $d = array(
      "patient_profile_link" => '/patient/u/'.$row['id'],
      'name' => $row['name'],
      'city' => $row['city'],
      'country' => $row['country'],
      'healthcard' => $row['healthcard'],
      'accept_patient_link' => "/accept/patient/".$row['id']
    );
    array_push($data,$d);
  }

  echo json_encode($data);
});
?>
