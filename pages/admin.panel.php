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

      // using SendGrid's PHP Library - https://github.com/sendgrid/sendgrid-php
      $sendgrid = new SendGrid($api_user, $api_key);
      $email    = new SendGrid\Email();

      $email->addTo($db_email)
            ->setFrom("info@openmd.io")
            ->setSubject("OpenMD has approved your account!")
            ->setHtml("you can login at: http://openmd.io\nThank you so much for the support");

      $sendgrid->send($email);

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

      // using SendGrid's PHP Library - https://github.com/sendgrid/sendgrid-php
      $sendgrid = new SendGrid($api_user, $api_key);
      $email    = new SendGrid\Email();

      $email->addTo($db_email)
            ->setFrom("info@openmd.io")
            ->setSubject("OpenMD has rejected your account!")
            ->setHtml("Your account has been rejected.
            \nPlease reply to this email if you want to voice any concerns.");

      $sendgrid->send($email);

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
