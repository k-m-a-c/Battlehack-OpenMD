<?php
$app->get('/patient/health/:patientId', function($patientId) {
  require('connect.php');
  $data = array();
  foreach($db->query("SELECT * FROM patients_status
  WHERE patientId = '$patientId'
  ORDER BY dateCreated DESC") as $row) {
    $d = array(
      'id' => $row['id'],
      'physical_health' => $row['physicalHealth'],
      'mental_health' => $row['mentalHealth'],
      'body_temp' => $row['bodyTemp'],
      'blood_pressure' => $row['bloodPressure'],
      'heart_rate' => $row['heartRate'],
      'respiratory_rate' => $row['respiratoryRate'],
      'additional_info' => $row['additionalInfo'],
      'date_created' => $row['dateCreated']
    );
    array_push($data,$d);
  }
  echo json_encode($data);
});
?>
