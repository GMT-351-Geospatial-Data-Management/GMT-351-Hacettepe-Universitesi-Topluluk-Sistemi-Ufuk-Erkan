<?php
include_once("db-conn.php");
function search_all($tableName, $orderType =""){
  $newSearch = array();
  $sorgu = "SELECT * FROM $tableName ".$orderType;
  global $conn;
  $bul = $conn->query($sorgu, PDO::FETCH_ASSOC);
  if ( $bul->rowCount() ){
    foreach( $bul as $gosterSearch ){
      array_push($newSearch,$gosterSearch);
    }
    return $newSearch;
  }else{
    return "ERR";
  }
}
?>