<?php
$app->get(
  '/get/doctors', function() {
    require('connect.php');

    $data = array();
    foreach($db->query("SELECT * FROM doctors") as $row) {
      $id = $row['id'];
      $name = $row['name'];
      $location = $row['location'];
      $hospital = $row['hospital'];
      $d = array(
        'id' => $id,
        'name' => $name,
        'location' => $location,
        'hospital' => $hospital
      );
      array_push($data,$d);
    }
    echo json_encode($data);
  }
);
?>
