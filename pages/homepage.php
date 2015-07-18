<?php
$app->get(
  require('header.php');
  require('footer.php');

  '/homepage', function() {
    echo <<<HTML
   		$header_template;
   		<h1>OpenMD</h1>
   		$footer_template;
HTML;
  }
);
?>
