var duzenle_club_name="";
var duzenle_club_id="";
var sil_club_name="";
var sil_club_id="";
function clubs_update_modal(clubs_id,name){
  //alert();
  document.getElementById("guncelle_clubs_name").value="";
  document.getElementById("guncelle_clubs_name").placeholder = name;
  duzenle_club_name = name;
  duzenle_club_id = clubs_id;
  console.log(duzenle_club_name+ " - " +duzenle_club_id);
}
function clubs_update(){
 //console.log("Update Save Click");
  var club_new_name = document.getElementById("guncelle_clubs_name").value;
  if (club_new_name != "") {
    document.getElementById("guncelle_clubs_name").style.border="1px solid #ced4da";
    $.post("comp/functions.php",{function:'update_clubs',c_id:duzenle_club_id,c_new_name:club_new_name},function(function_GET){
      if (function_GET != "ERR") {
        document.getElementById("topluluk_list").innerHTML = function_GET;
        $('#clubs_update_modal').modal('hide');
        list_clubs_select();
      }else{
        alert("ERROR");
      }
      
      //console.log(function_GET);
    });
  }else{
    document.getElementById("guncelle_clubs_name").style.border="1px solid red";
  }
  
}
function clubs_delete_modal(clubs_id,name){
  document.getElementById("clubs_delete_topluk_adi").innerHTML = name;
  sil_club_name = name;
  sil_club_id = clubs_id;
}
function clubs_delete(){
  $.post("comp/functions.php",{function:'delete_clubs',c_id:sil_club_id},function(function_GET){
    document.getElementById("topluluk_list").innerHTML = function_GET;
    $('#clubs_delete_modal').modal('hide');
    list_clubs_select();
  });
}
function clubs_add(){
  var clubs_add_name = document.getElementById("clubs_add_name").value;
  if (clubs_add_name != "") {
    document.getElementById("clubs_add_name").style.border="1px solid #ced4da";

    //PHP CONNECT
    $.post("comp/functions.php",{function:'add_clubs', c_add_name:clubs_add_name},function(function_GET){
      document.getElementById("topluluk_list").innerHTML = function_GET;
      $('#clubs_update_modal').modal('hide');
      list_clubs_select();
    });
    console.log("Add "+clubs_add_name);
  }else{
    document.getElementById("clubs_add_name").style.border="1px solid red";
  }
}