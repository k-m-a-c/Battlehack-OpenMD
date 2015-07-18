<?php
  $app->get(
    '/admin', function() {
      require('connect.php');
      global $app;
      if (!isset($_SESSION['admin'])) {
        $app->redirect('/admin/login');
      }
      if ($_SESSION['admin'] != 1) {
        $app->redirect('/admin/login');
      }

      $html = <<<HTML
      <table border="1">
      <tr>
        <td>Email</td>
        <td>Name</td>
        <td>Speciality</td>
        <td>Location</td>
        <td>CPSO</td>
        <td>Hospital</td>
        <td>-</td>
        <td>-</td>
      </tr>
HTML;

      foreach($db->query("SELECT * FROM doctors WHERE verified = '0'") as $row) {
        $id = $row['id'];
        $db_email = $row['email'];
        $name = $row['name'];
        $specialty = $row['specialty'];
        $location = $row['location'];
        $cpso = $row['cpso'];
        $hospital = $row['hospital'];
        $html .= <<<HTML
        <tr>
          <td>$db_email</td>
          <td>$name</td>
          <td>$specialty</td>
          <td>$location</td>
          <td>$cpso</td>
          <td>$hospital</td>
          <td><a href="/api/action/accept/doctor/$id">Accept</td>
          <td><a href="/api/action/reject/doctor/$id">Reject</td>
        </tr>
HTML;
      }

      echo <<<HTML
      $html;

      </table>
HTML;
    }
  );

  $app->get(
    '/api/action/accept/doctor/:id', function($id) {
      require('connect.php');
      require('SendGrid.php');
      $db->exec("UPDATE doctors SET verified='1' WHERE id = '$id'");

      foreach($db->query("SELECT * FROM doctors WHERE id = '$id'") as $row) {
        $db_email = $row['email'];
      }

      $url = 'https://api.sendgrid.com/';

      $params = array(
          'api_user'  => "app39048283@heroku.com",
          'api_key'   => "5ccsfdcx5919",
          'to'        => $db_email,
          'subject'   => 'OpenMD has accepted your application!',
          'html'      => '<p>Please email back if you need to voice any questions about Open MD.</p>
          <p>You can go to http://openmd.io and start using the app right away!</p>
          <p>Thank you, the Open MD team.</p>',
          'from'      => 'info@openmd.io',
        );


      $request =  $url.'api/mail.send.json';

      // Generate curl request
      $session = curl_init($request);
      // Tell curl to use HTTP POST
      curl_setopt ($session, CURLOPT_POST, true);
      // Tell curl that this is the body of the POST
      curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
      // Tell curl not to return headers, but do return the response
      curl_setopt($session, CURLOPT_HEADER, false);
      // Tell PHP not to use SSLv3 (instead opting for TLS)
      curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
      curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

      // obtain response
      $response = curl_exec($session);
      curl_close($session);

      global $app;
      $app->redirect('/admin');
    }
  );

  $app->get(
    '/api/action/reject/doctor/:id', function($id) {
      require('connect.php');
      require('SendGrid.php');
      $db->exec("UPDATE doctors SET verified='-1' WHERE id = '$id'");

      foreach($db->query("SELECT * FROM doctors WHERE id = '$id'") as $row) {
        $db_email = $row['email'];
      }

      $url = 'https://api.sendgrid.com/';

      $params = array(
          'api_user'  => "app39048283@heroku.com",
          'api_key'   => "5ccsfdcx5919",
          'to'        => $db_email,
          'subject'   => 'OpenMD has rejected your application!',
          'html'      => '<p>Please email back if you need to voice any concerns about your application.</p>
          <p>Thank you, the Open MD team.</p>',
          'from'      => 'info@openmd.io',
        );


      $request =  $url.'api/mail.send.json';

      // Generate curl request
      $session = curl_init($request);
      // Tell curl to use HTTP POST
      curl_setopt ($session, CURLOPT_POST, true);
      // Tell curl that this is the body of the POST
      curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
      // Tell curl not to return headers, but do return the response
      curl_setopt($session, CURLOPT_HEADER, false);
      // Tell PHP not to use SSLv3 (instead opting for TLS)
      curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
      curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

      // obtain response
      $response = curl_exec($session);
      curl_close($session);

      global $app;
      $app->redirect('/admin');
    }
  );

  $app->get(
    '/admin/login', function() {
      echo <<<HTML
      <h1>Please type in the password:</h1>
      <form action="/admin/login/auth" method="POST">
      <input type="password" name="password">
      <input type="submit" value="Login">
      </form>
HTML;
    }
  );

  $app->post(
    '/admin/login/auth', function() {
      require('connect.php');
      global $app;
  		$request = $app->request();
  		$data = $request->params();

      $password = $data['password'];

      if ($password == "moosehead123") {
        $_SESSION['admin'] = 1;
        $app->redirect('/admin');
      } else {
        $_SESSION['admin'] = 0;
        $app->redirect('/admin/login');
      }
    }
  );
?>
