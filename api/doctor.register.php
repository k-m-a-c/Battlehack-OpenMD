<?php
$app->post(
  '/api/new/doctor', function() {
    require('connect.php');
    global $app;
		$request = $app->request();
		$data = $request->params();

    $email = $data['email'];
    $password = $data['password'];
    $password2 = $data['confirm_password'];
    $name = $data['name'];
    $specialty = $data['specialty'];
    $location = $data['location'];
    $cpso = $data['cpso'];
    $hospital = $data['hospital'];

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

    foreach($db->query("SELECT * FROM doctors WHERE email = '$email'") as $row) {
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

    $db->exec("INSERT INTO doctors
    (`email`, `password`, `name`, `specialty`, `location`, `cpso`, `hospital`)
    VALUES
    ('$email', '$password', '$name', '$specialty', '$location', '$cpso', '$hospital')");

    $response = array(
      "response"=>"success", "message"=>"email: ".$email." registered."
    );
    echo json_encode($response);
    exit;
  }
);

?>
