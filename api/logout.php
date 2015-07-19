<?php
$app->get('/logout', function() {
  session_destroy();
  global $app;
  $app->redirect('/');
});
?>
