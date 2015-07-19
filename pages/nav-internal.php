<?php
$nav_template = <<<HTML
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">OpenMD</a>
    </div>

    <div class="$_SESSION['user_type'] doctor-link collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="doctor_patient_list">Home</a></li>
      </ul>
    </div>

    <div class="$_SESSION['user_type'] patient-link collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="patient_health">Home</a></li>
      </ul>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
HTML;
?>