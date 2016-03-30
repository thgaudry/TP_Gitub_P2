<?php
  header('Content-type: text/html; charset=utf-8');
  require_once('conf.php');
?>
 
<!DOCTYPE html>
<html>
  <head>
    <title>Z-Way - BOAs</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="Content-Language" content="Fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css">
  </head>
  <body>
 
    <?php foreach ($devices as $device_name => $device_id) { ?>
      <div onClick="zWave_AN157_set('<?php echo $device_id; ?>');">
        <img id="light_<?php echo $device_id; ?>" src="light_off.png">
        <p><?php echo $device_name; ?></p>
        <input style="width : 50px;" type="hidden" value="" id="status_<?php echo $device_id; ?>">
      </div>
    <?php } ?>
 
    <div onClick="zWave_AN157_set_all('on');">
      <img id="light_all_on" src="light_on.png">
      <p>All ON</p>
    </div>
 
    <div onClick="zWave_AN157_set_all('off');">
      <img id="light_all_off" src="light_off.png">
      <p>All OFF</p>
    </div>
 
    <script type="text/javascript" src="jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script>
      $( document ).ready(function() {
        console.log( "ready!" );
        updateStatus ();
      });
    </script>
 
  </body>
</html>
