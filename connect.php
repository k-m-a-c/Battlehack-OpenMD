<?php
//Variables for connecting to your database.
//These variable values come from your hosting account.
$hostname = "us-cdbr-iron-east-02.cleardb.net";
$username = "b9cfc4fb5418a8";
$dbname = "heroku_c064e84b2ed9524";

//These variable values need to be changed by you before deploying
$password = "03e316ec";


//Connecting to your database
$db = new PDO('mysql:host='.$hostname.';dbname='.$dbname.';charset=utf8', $username, $password);
?>
