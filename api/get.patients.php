<?php
$app->get(
  '/get/patients', function() {
    require('connect.php');
    $data = array();
    foreach($db->query("SELECT * FROM patients") as $row) {
      $d = array(
        'id' => $row['id'],
        'city' => $row['city'],
        'country' => $row['country']
      );
      array_push($data,$d);
    }
    echo json_encode($data);
  }
);
?>
