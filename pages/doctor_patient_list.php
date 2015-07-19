<?php
$app->get(

  '/doctor_register', function() {

  require('header.php');
  require('nav.php');
  require('footer.php');

    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Open MD | Patient List</title>

    $header_template

  </head>
 <body>

  $nav_template

    <div id="doctor-register" class="form-page container-fluid">
      <h1>Your Patient List</h1>

    </div>

   $footer_template

   <script>
      //ajax form submit
      $(document).ready(function(){
        $('#doctorRegisterForm').ajaxForm();

        // attach handler to form's submit event
        $('#doctorRegisterForm').submit(function() {
            // submit the form
            $(this).ajaxSubmit({ 'success': function(responseText, statusText, xhr, form)  {
                  var resp = $.parseJSON( responseText );
                  if (resp.response && resp.response == "error") {
                    $('.alert-danger').text(resp.message).show();
                  }
              }
            });
            // return false to prevent normal browser submit and page navigation
            return false;
        });
    </script>

  </body>
</html>
HTML;
  }
);
?>
