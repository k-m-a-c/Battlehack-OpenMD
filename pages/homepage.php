<?php
$app->get(
  '/homepage', function() {
    echo <<<HTML
    this is the homepage.
HTML;
  }
);
?>
