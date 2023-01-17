<?php
include_once("sql.php");
function clubs_list_get(){
		$new_clubs_table='';
		$clubs = search_all("clubs");
		$colorize = 0;
		for ($i=0; $i < count($clubs); $i++) {
			if ($colorize == 0) {
				$new_clubs_table .='
				<tr class="tr_0">
				<td>'.$clubs[$i]["name"].'</td>
				<td class="td_btn"><button type="button" class="tbl-btn btn btn-primary" onclick="clubs_update_modal('.$clubs[$i]["clubs_id"].',\''.$clubs[$i]["name"].'\')" data-toggle="modal" data-target="#clubs_update_modal">Düzenle</button></td>
				<td class="td_btn"><button type="button" class="tbl-btn btn btn-danger" onclick="clubs_delete_modal('.$clubs[$i]["clubs_id"].',\''.$clubs[$i]["name"].'\')" data-toggle="modal" data-target="#clubs_delete_modal">Topluluğu Sil</button></td>
				</tr>
				';
				$colorize = 1;
			} 
			else if ($colorize == 1) {
				$new_clubs_table .='
				<tr class="tr_1">
				<td>'.$clubs[$i]["name"].'</td>
				<td class="td_btn"><button type="button" class="tbl-btn btn btn-primary" onclick="clubs_update_modal('.$clubs[$i]["clubs_id"].',\''.$clubs[$i]["name"].'\')" data-toggle="modal" data-target="#clubs_update_modal">Düzenle</button></td>
				<td class="td_btn"><button type="button" class="tbl-btn btn btn-danger" onclick="clubs_delete_modal('.$clubs[$i]["clubs_id"].',\''.$clubs[$i]["name"].'\')" data-toggle="modal" data-target="#clubs_delete_modal">Topluluğu Sil</button></td>
				</tr>
				';
				$colorize = 0;
			} 

		}
		return $new_clubs_table;
}
function events_list_get(){
	$new_events_table='';
	$events = search_all("events INNER JOIN clubs ON events.event_organizer = clubs.clubs_id;");
	$colorize = 0;
	if ($events != "ERR") {
		for ($i=0; $i < count($events); $i++) {
			if ($colorize == 0) {
				$new_events_table .='
				<tr class="tr_0">
				<td>'.$events[$i]["event_details"].'</td>
				<td>'.$events[$i]["name"].'</td>
				<td>'.$events[$i]["event_date"].'</td>
				<td class="td_btn"><button type="button" class="tbl-btn btn btn-primary" onclick="events_update_modal('.$events[$i]["event_id"].',\''.$events[$i]["event_details"].'\',\''.$events[$i]["name"].'\',\''.$events[$i]["event_organizer"].'\',\''.$events[$i]["event_date"].'\')" data-toggle="modal" data-target="#events_update_modal">Düzenle</button></td>
				<td class="td_btn"><button type="button" class="tbl-btn btn btn-danger" onclick="clubs_delete_modal('.$events[$i]["event_id"].',\''.$events[$i]["event_details"].'\',\''.$events[$i]["name"].'\',\''.$events[$i]["event_organizer"].'\',\''.$events[$i]["event_date"].'\')" data-toggle="modal" data-target="#events_delete_modal">Topluluğu Sil</button></td>
				</tr>
				';
				$colorize = 1;
			} 
			else if ($colorize == 1) {
				$new_events_table .='
				<tr class="tr_1">
				<td>'.$events[$i]["event_details"].'</td>
				<td>'.$events[$i]["name"].'</td>
				<td>'.$events[$i]["event_date"].'</td>
				<td class="td_btn"><button type="button" class="tbl-btn btn btn-primary" onclick="events_update_modal('.$events[$i]["event_id"].',\''.$events[$i]["event_details"].'\',\''.$events[$i]["name"].'\',\''.$events[$i]["event_organizer"].'\',\''.$events[$i]["event_date"].'\')" data-toggle="modal" data-target="#events_update_modal">Düzenle</button></td>
				<td class="td_btn"><button type="button" class="tbl-btn btn btn-danger" onclick="clubs_delete_modal('.$events[$i]["event_id"].',\''.$events[$i]["event_details"].'\',\''.$events[$i]["name"].'\',\''.$events[$i]["event_organizer"].'\',\''.$events[$i]["event_date"].'\')" data-toggle="modal" data-target="#events_delete_modal">Topluluğu Sil</button></td>
				</tr>
				';
				$colorize = 0;
			} 

		}
	}
	return $new_events_table;
}
if ($_POST["function"] == "update_clubs") {
	$data = [
		'clubs_id' => $_POST["c_id"],
		'name' => $_POST["c_new_name"]
	];
	$sql = "UPDATE clubs SET name=:name WHERE clubs_id=:clubs_id";
	$stmt= $conn->prepare($sql);
	$stmt->execute($data);
	if ($stmt) {
		echo clubs_list_get();
	}else{

		echo "ERR";
	}
}else if($_POST["function"] == "delete_clubs"){
	$data = [
		'clubs_id' => $_POST["c_id"]
	];
	$sql = "DELETE FROM clubs WHERE clubs_id = :clubs_id";
	$stmt= $conn->prepare($sql);
	$stmt->execute($data);
	if ($stmt) {
		echo clubs_list_get();
	}
}else if($_POST["function"] == "add_clubs"){
	$data = [
		':clubs_id' => null,
		':name' => $_POST["c_add_name"]
	];
	$sql = "INSERT INTO clubs(clubs_id, name) VALUES (:clubs_id, :name)";
	$stmt= $conn->prepare($sql);
	$stmt->execute($data);
	if ($stmt) {
		echo clubs_list_get();
	}else{
		return 'NO';
	}
}else if($_POST["function"] == "list_clubs_select"){
	$list = "";
	$clubs = search_all("clubs");
	for ($i=0; $i < count($clubs); $i++) {
		$list .= '<option value="'.$clubs[$i]["clubs_id"].'">'.$clubs[$i]["name"].'</option>';
	}
	echo $list;
}else if($_POST["function"] == "update_events"){
	$data = [
		'event_id' => $_POST["e_id"],
		'event_details' => $_POST["e_new_detay"],
		'event_organizer' => $_POST["e_new_topluluk"],
		'event_date' => $_POST["e_new_date"],
	];
	$sql = "UPDATE events SET event_details=:event_details, event_organizer=:event_organizer,event_date=:event_date WHERE event_id=:event_id";
	$stmt= $conn->prepare($sql);
	$stmt->execute($data);
	if ($stmt) {
		echo events_list_get();
	}else{

		echo "ERR";
	}
}else if($_POST["function"] == "delete_events"){
	$data = [
		'event_id' => $_POST["e_id"]
	];
	$sql = "DELETE FROM events WHERE event_id = :event_id";
	$stmt= $conn->prepare($sql);
	$stmt->execute($data);
	if ($stmt) {
		echo events_list_get();
	}
}else if($_POST["function"] == "add_events"){
	$data = [
		'event_id' => null,
		'event_details' => $_POST["e_new_detay"],
		'event_organizer' => $_POST["e_new_topluluk"],
		'event_date' => $_POST["e_new_date"],
	];
	$sql = "INSERT INTO events(event_id, event_details, event_organizer, event_date) VALUES (:event_id, :event_details, :event_organizer, :event_date)";
	$stmt= $conn->prepare($sql);
	$stmt->execute($data);
	if ($stmt) {
		echo events_list_get();
	}else{
		return 'NO';
	}
}
?>