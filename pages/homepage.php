<?php
$app->get(

  '/homepage', function() {
  	require('header.php');
  	require('footer.php');
    echo <<<HTML
   		$header_template;
   		<h1>OpenMD</h1>
   		$footer_template;
HTML;
  }
);
?>
