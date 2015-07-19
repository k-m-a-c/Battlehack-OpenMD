<?php
$app->get(
  '/patient/new/status', function() {
    require('connect.php');
    global $app;
    $request = $app->request();
    $data = $request->params();

    $physicalHealth = $data['physicalHealth'];
    $mentalHealth = $data['mentalHealth'];
    $bodyTemp = $data['bodyTemp'];
    $bloodPressure = $data['bloodPressure'];
    $heartRate = $data['heartRate'];
    $respiratoryRate = $data['respiratoryRate'];
    $additionalInfo = $data['additionalInfo'];

    $db->exec("INSERT INTO patients_status
    (`physicalHealth`, `mentalHealth`, `bodyTemp`, `bloodPressure`, `heartRate`, `respiratoryRate`, `additionalInfo`)
    VALUES
    ('$physicalHealth', '$mentalHealth', '$bodyTemp', '$bloodPressure', '$heartRate', '$respiratoryRate', '$additionalInfo')
    ");
  }
);
?>
