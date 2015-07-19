<?php
$app->post(
  '/api/new/patient', function() {
    require('connect.php');
    global $app;
		$request = $app->request();
		$data = $request->params();

    $email = $data['email'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $name = $first_name." ".$last_name;
    $password = $data['password'];
    $password2 = $data['confirm_password'];
    $gender = $data['gender'];
    $birthday = $data['birthday'];
    $healthcard = $data['healthcard'];

    $city = $data['city'];
    $country = $data['country'];

    $drugs = $data['med_name'];
    $drugs_list = "";
    foreach($drugs AS $drug) {
      $drugs_list .= $drug.",";
    }

    $dosage = $data['med_dosage'];
    $dosage_list = "";
    foreach($dosage AS $dose) {
      $dosage_list .= $dose.",";
    }

    $freq = $data['med_freq'];
    $freq_list = "";
    foreach($freq AS $amount) {
      $freq_list .= $amount.",";
    }

    $surgery = $data['surgery_type'];
    $surgery_list = "";
    foreach($surgery AS $procedure) {
      $surgery_list .= $procedure.",";
    }

    $surgeryDate = $data['surgery_date'];
    $surgeryDate_list = "";
    foreach($surgeryDate AS $surgery) {
      $surgeryDate_list .= $surgery.",";
    }

    $allergy = $data['allergy'];
    $allergy_list = "";
    foreach($allergy AS $allergy_one) {
      $allergy_list .= $allergy_one.",";
    }

    $condition = $data['condition'];
    $condition_list = "";
    foreach($condition AS $condition_one) {
      $condition_list .= $condition_one.",";
    }

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
    (`email`, `password`, `name`, `gender`, `birthday`, `healthcard`, `city`, `country`, `medName`, `medDosage`, `medFreq`
    `surgeryType`, `surgeryDate`, `allergy`, `condition`)
    VALUES
    ('$email', '$password', '$name', '$gender', '$birthday', '$healthcard', '$city', '$country', '$drugs_list', '$dosage_list',
      '$freq_list', '$surgery_list', '$surgeryDate_list', '$allergy_list', '$condition_list')");

    $response = array(
      "response"=>"success", "message"=>"patient email: ".$email." registered."
    );
    echo json_encode($response);
    exit;
  }
);
?>
