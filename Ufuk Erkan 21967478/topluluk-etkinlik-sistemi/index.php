<?php
include_once("comp/sql.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta
      name="description"
      content="Web site created using create-react-app"
    />
    <link rel="apple-touch-icon" href="logo192.png" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="index.css">
    <title>Hacettepe Topluluklar</title>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-white bg-white">
    <div class="container-fluid">
      <img src="https://upload.wikimedia.org/wikipedia/tr/2/28/Hacettepe_%C3%9Cniversitesi_Logosu.svg" class="img-responsive "  width="3%" alt="">
      <a class="navbar-brand" href="#" style="color:rgb(255, 0, 0); margin-left: 10px;" ><b>Hacettepe Üniversitesi</b> <br>Topluluk Yönetim Sistemi</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mb-0 h1"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active mb-0 h5" aria-current="page" href="#" onClick="window.location.reload();" style="color: rgb(0, 0, 0);">
              Ana Sayfa
            </a>
          </li>
          <li>
            <a class="nav-link active mb-0 h5" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(0, 0, 0);">
              Topluluklar
            </a>
            <li class="nav-item">
                <a class="nav-link active mb-0 h5" aria-current="page" href="#" onClick="add_path();" style="color: rgb(0, 0, 0);">
                  Etkinlikler
                </a>
            </li>
          </li>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
        <div class="col-sm-12 ">
            <h2>Topluluk Ekle</h2>
            <div class="card">
              <div class="card-body">
                <div class="input-group mb-3">
                  <input type="text" id="clubs_add_name" class="form-control" placeholder="Topluluk Adı Giriniz" aria-label="Topluluk Adı Giriniz" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-outline-success" type="button" onclick="clubs_add()">Ekle</button>
                  </div>
                </div>
                <table>
                  <thead>
                    <th>Topluluk Adı</th>
                    <th>Topluluk Adını Düzenle</th>
                    <th>Topluluk Adını Sil</th>
                  </thead>
                  <tbody id="topluluk_list">
                    <?php
                      $clubs = search_all("clubs");
                      $colorize = 0;
                      for ($i=0; $i < count($clubs); $i++) {
                        if ($colorize == 0) {
                           echo'
                            <tr class="tr_0">
                              <td>'.$clubs[$i]["name"].'</td>
                              <td class="td_btn"><button type="button" class="tbl-btn btn btn-primary" onclick="clubs_update_modal('.$clubs[$i]["clubs_id"].',\''.$clubs[$i]["name"].'\')" data-toggle="modal" data-target="#clubs_update_modal">Düzenle</button></td>
                              <td class="td_btn"><button type="button" class="tbl-btn btn btn-danger" onclick="clubs_delete_modal('.$clubs[$i]["clubs_id"].',\''.$clubs[$i]["name"].'\')" data-toggle="modal" data-target="#clubs_delete_modal">Topluluğu Sil</button></td>
                            </tr>
                          ';
                          $colorize = 1;
                         } 
                         else if ($colorize == 1) {
                           echo'
                            <tr class="tr_1">
                              <td>'.$clubs[$i]["name"].'</td>
                              <td class="td_btn"><button type="button" class="tbl-btn btn btn-primary" onclick="clubs_update_modal('.$clubs[$i]["clubs_id"].',\''.$clubs[$i]["name"].'\')" data-toggle="modal" data-target="#clubs_update_modal">Düzenle</button></td>
                              <td class="td_btn"><button type="button" class="tbl-btn btn btn-danger" onclick="clubs_delete_modal('.$clubs[$i]["clubs_id"].',\''.$clubs[$i]["name"].'\')" data-toggle="modal" data-target="#clubs_delete_modal">Topluluğu Sil</button></td>
                            </tr>
                          ';
                          $colorize = 0;
                         } 
                        
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="col-sm-12 ">
            <h2>Etkinlik Ekle</h2>
            <div class="card">
              <div class="card-body">
                <div class="input-group mb-3">
                  <input type="text" id="events_add_detail" class="form-control" placeholder="Etkinlik Detayları" aria-label="Etkinlik Detayları" aria-describedby="basic-addon2">
                  <select id="events_add_clubs" class="form-control" aria-describedby="basic-addon2">
                    <option style="display: none;">Topluluk Seç</option>
                    <?php
                      $clubs = search_all("clubs");
                      for ($i=0; $i < count($clubs); $i++) {
                        echo '<option value="'.$clubs[$i]["clubs_id"].'">'.$clubs[$i]["name"].'</option>';
                      }
                    ?>
                  </select>
                  
                  <input type="datetime-local" id="events_add_date" class="form-control" placeholder="Etkinlik Tarihi" aria-label="Topluluk Adı Giriniz" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-outline-success" type="button" onclick="events_add()">Ekle</button>
                  </div>
                </div>
                <table>
                  <thead>
                    <th>Detaylar</th>
                    <th>Topluluk</th>
                    <th>Tarih</th>
                    <th>Etkinlik Düzenle</th>
                    <th>Etkinlik Sil</th>
                  </thead>
                  <tbody id="events_list">
                    <?php
                      $events = search_all("events INNER JOIN clubs ON events.event_organizer = clubs.clubs_id;");
                      $colorize = 0;
                      if ($events != "ERR") {
                        for ($i=0; $i < count($events); $i++) {
                          if ($colorize == 0) {
                           echo'
                           <tr class="tr_0">
                           <td>'.$events[$i]["event_details"].'</td>
                           <td>'.$events[$i]["name"].'</td>
                           <td>'.$events[$i]["event_date"].'</td>
                           <td class="td_btn"><button type="button" class="tbl-btn btn btn-primary" onclick="events_update_modal('.$events[$i]["event_id"].',\''.$events[$i]["event_details"].'\',\''.$events[$i]["name"].'\',\''.$events[$i]["event_organizer"].'\',\''.$events[$i]["event_date"].'\')" data-toggle="modal" data-target="#events_update_modal">Düzenle</button></td>
                           <td class="td_btn"><button type="button" class="tbl-btn btn btn-danger" onclick="events_delete_modal('.$events[$i]["event_id"].',\''.$events[$i]["event_details"].'\',\''.$events[$i]["name"].'\',\''.$events[$i]["event_date"].'\')" data-toggle="modal" data-target="#events_delete_modal">Topluluğu Sil</button></td>
                           </tr>
                           ';
                           $colorize = 1;
                         } 
                         else if ($colorize == 1) {
                           echo'
                           <tr class="tr_1">
                           <td>'.$events[$i]["event_details"].'</td>
                           <td>'.$events[$i]["name"].'</td>
                           <td>'.$events[$i]["event_date"].'</td>
                           <td class="td_btn"><button type="button" class="tbl-btn btn btn-primary" onclick="events_update_modal('.$events[$i]["event_id"].',\''.$events[$i]["event_details"].'\',\''.$events[$i]["name"].'\',\''.$events[$i]["event_organizer"].'\',\''.$events[$i]["event_date"].'\')" data-toggle="modal" data-target="#events_update_modal">Düzenle</button></td>
                           <td class="td_btn"><button type="button" class="tbl-btn btn btn-danger" onclick="events_delete_modal('.$events[$i]["event_id"].',\''.$events[$i]["event_details"].'\',\''.$events[$i]["name"].'\',\''.$events[$i]["event_date"].'\')" data-toggle="modal" data-target="#events_delete_modal">Topluluğu Sil</button></td>
                           </tr>
                           ';
                           $colorize = 0;
                         } 

                       }
                     }
                      
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>







<!-- CLUBS UPDATE MODAL -->
<div class="modal fade" id="clubs_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Topluluk Adını Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Topluluk Adı</label>
          <input type="text" class="form-control" id="guncelle_clubs_name" aria-describedby="emailHelp" placeholder="Topluluk Adı">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="btn btn-primary" id="update_clubs_save" onclick="clubs_update()">Kaydet</button>
      </div>
    </div>
  </div>
</div>
<!-- END CLUBS UPDATE MODAL -->
<!-- CLUBS DELETE MODAL -->
<div class="modal fade" id="clubs_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Topluluk Silmeyi Onayla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Silinecek topluluk adı: <span id="clubs_delete_topluk_adi" style="font-weight:700"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="btn btn-danger" id="delete_clubs_save" onclick="clubs_delete()">Sil</button>
      </div>
    </div>
  </div>
</div>
<!-- END CLUBS DELETE MODAL -->

<!-- EVENTS UPDATE MODAL -->
<div class="modal fade" id="events_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Topluluk Adını Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="guncelle_events_detail">Etkinlik Detayı</label>
          <input type="text" class="form-control" id="guncelle_events_detail" aria-describedby="Etkinlik Detayı" placeholder="Etkinlik Detayı">
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="guncelle_events_topluluk">Topluluk</label>
          <select id="guncelle_events_topluluk" class="form-control" aria-describedby="basic-addon2">
            <option style="display: none;">Topluluk Seç</option>
            <?php
            $clubs = search_all("clubs");
            for ($i=0; $i < count($clubs); $i++) {
              echo '<option value="'.$clubs[$i]["clubs_id"].'">'.$clubs[$i]["name"].'</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="guncelle_events_date">Tarih</label>
          <input type="datetime-local" class="form-control" id="guncelle_events_date">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="btn btn-primary" id="update_events_save" onclick="events_update()">Kaydet</button>
      </div>
    </div>
  </div>
</div>
<!-- END EVENTS UPDATE MODAL -->
<!-- EVENTS DELETE MODAL -->
<div class="modal fade" id="events_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Topluluk Silmeyi Onayla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Silinecek etkinlik detayı: <span id="events_delete_detail"style="font-weight:700"></span><br>
        Silinecek etkinlik topluluğu: <span id="events_delete_club"style="font-weight:700"></span><br>
        Silinecek etkinlik tarihi: <span id="events_delete_date"style="font-weight:700"></span><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="btn btn-danger" id="delete_events_save" onclick="events_delete()">Sil</button>
      </div>
    </div>
  </div>
</div>
<!-- END EVENTS DELETE MODAL -->
</body>


<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script src="js/club.js"></script>
<script src="js/event.js"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous"
></script>
<script
src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
crossorigin="anonymous"
></script>
</html>
