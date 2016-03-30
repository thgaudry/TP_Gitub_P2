var status_timeout;

/* Z-Way */

function zWave_AN157_set_all (val) {
  $.ajax({
    async : false,
    type: "POST",
    url: "ajax.php",
    data: "cmd=set_all&val="+val,
    success: function(html){
      zWay_status_all ();
    }
  });
}

function zWave_AN157_set (device_id) {
  var status = $("#status_"+device_id).val();
  if(status == '255'){
    var val = 'off';
  }
  else{
    var val = 'on';
  }
  $.ajax({
    async : false,
    type: "POST",
    url: "ajax.php",
    data: "cmd=set&device_id="+device_id+"&val="+val,
    success: function(html){
      zWave_AN157_get (device_id);
    }
  });
}
