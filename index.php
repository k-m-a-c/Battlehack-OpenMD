<?php
error_reporting(-1);

require('Pusher.php');
$app_id = '130666';
$app_key = '64c1568039c2b37cc9da';
$app_secret = 'e12fb6a2a8eb232cc611';

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

session_start();

require('pages/home.php');
require('pages/login.php');
require('pages/patient_register.php');
require('pages/doctor_register.php');
require('pages/doctor_patient_list.php'); // The list of patients FOR doctors
require('pages/patient_doctor_list'); // The list of doctors FOR patients
require('pages/health_status_update.php');
require('pages/admin.panel.php');

require('api/doctor.register.php');
require('api/doctor.login.php');
require('api/patient.register.php');
require('api/patient.login.php');
require('api/logout.php');

require('api/doctor.add.patient.php');
require('api/patient.add.doctor.php');
require('pages/doctor.home.php');
require('pages/display.patient.php');
require('pages/patient.home.php');
require('pages/display.doctor.php');

require('api/accept.doctor.php');
require('api/accept.patient.php');

require('api/get.doctors.php');
require('api/get.patients.php');

require('api/patient.new.status.php');

require('api/check.bt.token.php');
require('api/acquire.bt.token.php');
require('api/bt.pay.php');


$app->run();
