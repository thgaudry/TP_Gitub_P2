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

function zWave_AN157_get (device_id) {
  $.ajax({
    async : false,
    type: "POST",
    url: "ajax.php",
    data: "cmd=get&device_id="+device_id,
    success: function(html){
      zWay_status (device_id);
    }
  });
}

function zWay_status (device_id) {
  $.ajax({
    async : false,
    dataType: "json",
    type: "POST",
    url: "ajax.php",
    data: "cmd=status",
    success: function(html){
      var updatetime = html['updateTime'];

      if(typeof html['devices.'+device_id+'.instances.0.commandClasses.37.data.level'] != 'undefined'){
        var level      = html['devices.'+device_id+'.instances.0.commandClasses.37.data.level']['value'];
        if(level == '255'){
          $("#light_"+device_id).attr('src', 'light_on.png');
        }
        else{
          $("#light_"+device_id).attr('src', 'light_off.png');
        }
        $("#status_"+device_id).val(level);
      }

      $("#status").html(updatetime);
    }
  });
}

function zWay_status_all () {
  $(".device_status").each(function (index) {
    var ds_id = $(this).attr('id').split("_");
    var d_id  = ds_id[1];
    zWave_AN157_get (d_id);
  });
}

function updateStatus () {
  zWay_status_all ();
  status_timeout = setTimeout("updateStatus()", 10000);
}

