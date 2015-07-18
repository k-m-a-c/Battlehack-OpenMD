<?php
//Variables for connecting to your database.
//These variable values come from your hosting account.
$hostname = "us-cdbr-iron-east-02.cleardb.net";
$username = "b9cfc4fb5418a8";
$dbname = "heroku_c064e84b2ed9524";

//These variable values need to be changed by you before deploying
$password = "03e316ec";


//Connecting to your database
mysql_connect($hostname, $username, $password) or die("error connecting to mysql");
mysql_select_db($dbname) or die("error connecting to database");
?>
