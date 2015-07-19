<?php
$app->post(
  '/api/login/patient', function() {
    require('connect.php');
    global $app;
		$request = $app->request();
		$data = $request->params();

    $email = $data['email'];
    $password = $data['password'];

    $password = md5($password);

    foreach($db->query("SELECT * FROM patients WHERE email = '$email'") as $row) {
      $id = $row['id'];
      $db_email = $row['email'];
      $db_password = $row['password'];
    }

    if (!isset($db_email)) {
      $response = array(
        "response"=>"error", "message"=>"email not in database."
      );
      echo json_encode($response);
      exit;
    }

    if ($email != $db_email) {
      $response = array(
        "response"=>"error", "message"=>"emails do not match."
      );
      echo json_encode($response);
      exit;
    }

    if ($password != $db_password) {
      $response = array(
        "response"=>"error", "message"=>"passwords do not match."
      );
      echo json_encode($response);
      exit;
    }

    $_SESSION['user_type'] = "patient";
    $_SESSION['user_id'] = $id;
    $response = array(
      "response"=>"success", "message"=>"logged in as ".$email.".", "user_type" => $_SESSION['user_type'], "user_id" => $_SESSION['user_id']
    );
    echo json_encode($response);
    exit;
  }
);
?>
