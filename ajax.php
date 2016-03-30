<?php
 
  header('Content-type: text/html; charset=utf-8');
  require_once('conf.php');
 
  function httpGet ($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $return = curl_exec($curl);
    curl_close($curl);
    return $return;
  }
 
  $cmd        = $_REQUEST['cmd'];
  $val        = $_REQUEST['val'];
  $device_id  = $_REQUEST['device_id'];
  if($val == 'on'){$val = 255;}else {$val = 0;}
 
  // permet de changer l'état d'un module
  if($cmd == 'set'){
    $url = "http://".$pi_zway.":8083/ZWaveAPI/Run/devices[".$device_id."].instances[0].commandClasses[0x25].Set(".$val.")";
    echo httpGet ($url);
  }
 
  // permet de récupérer l'état d'un module
  else if($cmd == 'get'){
    $url = "http://".$pi_zway.":8083/ZWaveAPI/Run/devices[".$device_id."].instances[0].commandClasses[37].Get()";
    echo httpGet ($url);
  }
 
  // permet de modifier l'état de  tous les modules
  else if($cmd == 'set_all'){
    foreach($devices as $device_name => $device_id) {
      $url = "http://".$pi_zway.":8083/ZWaveAPI/Run/devices[".$device_id."].instances[0].commandClasses[0x25].Set(".$val.")";
      echo httpGet ($url);
    }
  }
 
  // recupère le dernier statut
  else if($cmd == 'status'){
    $url = "http://".$pi_zway.":8083/ZWaveAPI/Data/".time();
    echo httpGet ($url);
  }
 
  // default
  else{
    return "";
  }
 
?>

