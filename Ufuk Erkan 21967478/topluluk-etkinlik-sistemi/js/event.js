var duzenle_event_id="";
var delete_event_id="";
function events_update_modal(event_id,event_detail,club_name,club_id,event_date){
  document.getElementById("guncelle_events_detail").value = event_detail;
  document.getElementById("guncelle_events_topluluk").value = club_id;
  document.getElementById("guncelle_events_date").value = event_date;
  duzenle_event_id=event_id;
}
function events_update(){
  var events_new_detay = document.getElementById("guncelle_events_detail").value;
  var events_new_topluluk = document.getElementById("guncelle_events_topluluk").value;
  var events_new_date = document.getElementById("guncelle_events_date").value;
  if (events_new_detay != "") {
    document.getElementById("guncelle_events_detail").style.border="1px solid #ced4da";
    $.post("comp/functions.php",{function:'update_events',e_id:duzenle_event_id,e_new_detay:events_new_detay,e_new_topluluk:events_new_topluluk,e_new_date:events_new_date},function(function_GET){
      if (function_GET != "ERR") {
        document.getElementById("events_list").innerHTML = function_GET;
        $('#events_update_modal').modal('hide');
        list_clubs_select();
      }else{
        alert("ERROR");
      }
    });
  }else{
    document.getElementById("guncelle_events_detail").style.border="1px solid red";
  }
}
function events_delete_modal(event_id,event_detail,club_name,date){
  document.getElementById("events_delete_detail").innerHTML = event_detail;
  document.getElementById("events_delete_club").innerHTML = club_name;
  document.getElementById("events_delete_date").innerHTML = date;
  delete_event_id=event_id;
}
function events_delete(){
  $.post("comp/functions.php",{function:'delete_events',e_id:delete_event_id},function(function_GET){
    document.getElementById("events_list").innerHTML = function_GET;
    $('#events_delete_modal').modal('hide');
    list_clubs_select();
  });
}
function list_clubs_select(){
  $.post("comp/functions.php",{function:'list_clubs_select'},function(function_GET){
    document.getElementById("events_add_clubs").innerHTML = '<option style="display: none;">Topluluk Seç</option>'+function_GET;
    });
}
function events_add(){
  var events_add_detail = document.getElementById("events_add_detail").value;
  var events_add_clubs = document.getElementById("events_add_clubs").value;
  var events_add_date = document.getElementById("events_add_date").value;
  if (events_add_detail != "" && events_add_clubs != "" && events_add_date != "") {
    document.getElementById("events_add_detail").style.border="1px solid #ced4da";
    document.getElementById("events_add_clubs").style.border="1px solid #ced4da";
    document.getElementById("events_add_date").style.border="1px solid #ced4da";
    $.post("comp/functions.php",{function:'add_events',e_new_detay:events_add_detail,e_new_topluluk:events_add_clubs,e_new_date:events_add_date},function(function_GET){
      if (function_GET != "ERR") {
        document.getElementById("events_list").innerHTML = function_GET;
        $('#events_update_modal').modal('hide');
        list_clubs_select();
      }else{
        alert("ERROR");
      }
    });
  }else{
    document.getElementById("events_add_detail").style.border="1px solid red";
    document.getElementById("events_add_clubs").style.border="1px solid red";
    document.getElementById("events_add_date").style.border="1px solid red";
  }
}