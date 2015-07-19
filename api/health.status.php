<?php
$app->get('/patient/health/:patientId', function($patientId) {
  $data = array();
  foreach($db->query("SELECT * FROM patient_status
  WHERE patientId = '$patientId'") as $row) {
    $d = array(
      'id' => $row['id'],
      'physical_health' => $row['physicalHealth'],
      'mental_health' => $row['mentalHealth'],
      'body_temp' => $row['bodyTemp'],
      'blood_pressure' => $row['bloodPressure'],
      'heart_rate' => $row['heartRate'],
      'respiratory_rate' => $row['respiratoryRate'],
      'additional_info' => $row['additionalInfo']
    );
    array_push($data,$d);
  }
  echo json_encode($data);
});
?>
