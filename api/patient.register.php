<?php
$app->post(
  '/api/new/patient', function() {
    require('connect.php');
    global $app;
		$request = $app->request();
		$data = $request->params();

    $email = $data['email'];
    $name = $data['name'];
    $password = $data['password'];
    $gender = $data['gender'];
    $birthday = $data['birthday'];
    $healthcard = $data['healthcard'];

    if (strlen($email) < 1 OR strlen($name) < 1 OR strlen($password) < 1) {
      $response = array(
        "response"=>"error", "message"=>"invalid email or name, or password too short."
      );
      echo json_encode($response);
      exit;
    }

    if ($password != $password2) {
      $response = array(
        "response"=>"error", "message"=>"passwords don't match."
      );
      echo json_encode($response);
      exit;
    }

    if (strlen($cpso) < 3) {
      $response = array(
        "response"=>"error", "message"=>"invalid cpso number."
      );
      echo json_encode($response);
      exit;
    }

    foreach($db->query("SELECT * FROM patients WHERE email = '$email'") as $row) {
      $db_email = $row['email'];
    }

    if (isset($db_email)) {
      $response = array(
        "response"=>"error", "message"=>"email already taken."
      );
      echo json_encode($response);
      exit;
    }

    $password = md5($password);

    $db->exec("INSERT INTO patients
    (`email`, `password`, `name`, `gender`, `birthday`, `healthcard`)
    VALUES
    ('$email', '$password', '$name', '$gender', '$birthday', '$healthcard')");

    $response = array(
      "response"=>"success", "message"=>"patient email: ".$email." registered."
    );
    echo json_encode($response);
    exit;
  }
);
?>
