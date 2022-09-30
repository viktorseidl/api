<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      UPDATE DATA 
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      id= User-ID
      v_name= Vorname
      n_name= Nachname
      pinnr= Passwort (änderbar)
      pinnrHash= sha256 Hash vom Passwort
      timetouchIDHash= sha256 Hash von User-ID (=TimeTouchID)
      generalKeyHash= sha256 Hash von pinnerHash + timetouchIdHash
      u_name = Benutzername für anonymisierung der perönlichen Daten
      pLevel = Permission Level (1=normaler User, 5=Admin | 2=nicht vergeben, 3=nicht vergeben, 4=nicht vergeben)
    */
//Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
//include Classes
include_once('../../../config/Database.php');
include_once('../../../models/Mitarbeiter.php');

//Iniciate DB connection
$database = new Database();
$db = $database->connect();

//Iniciate Object
$mitarbeiter=new Mitarbeiter($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
//prepare Data
$mitarbeiter->qType = $data->qType;

switch($mitarbeiter->qType){
  case 0:
    //Update N_Name
    $mitarbeiter->n_name = $data->n_name;
    $mitarbeiter->id = $data->id;
    $mitarbeiter->requestToken = $data->API;
    // Create query
    if($mitarbeiter->updateMitarbeiter()) {
      echo json_encode(
        array('message' => 'Mitarbeiter wurde aktualisiert')
      );
    } else {
      echo json_encode(
        array('message' => 'Fehler bei der Aktualisierung aufgetreten!')
      );
    }
    break;
  case 1:
    //Update Password
    $mitarbeiter->id = $data->id;
    $mitarbeiter->pinnr = $data->UKey;
    $mitarbeiter->pinnrNew = $data->NKey;
    $mitarbeiter->timetouchId = $data->TKey;
    $mitarbeiter->requestToken = $data->API;
    // Create query
    if($mitarbeiter->updateMitarbeiter()) {
      echo json_encode(
        array('message' => 'Passwort wurde aktualisiert')
      );
    } else {
      echo json_encode(
        array('message' => 'Fehler bei der Aktualisierung aufgetreten!')
      );
    }
    
    break;
  case 2:
    //Update U_Name
    $mitarbeiter->n_name = $data->n_name;
    $mitarbeiter->id = $data->id;
    $mitarbeiter->requestToken = $data->API;
    break;
  case 3:
    //Update GeneralKeyHash
    $mitarbeiter->n_name = $data->n_name;
    $mitarbeiter->id = $data->id;
    $mitarbeiter->requestToken = $data->API;
    break;
  case 4:
    //Update pLevel
    $mitarbeiter->n_name = $data->n_name;
    $mitarbeiter->id = $data->id;
    $mitarbeiter->requestToken = $data->API;
    break;
  case 5:
    //Update requestToken
    $mitarbeiter->n_name = $data->n_name;
    $mitarbeiter->id = $data->id;
    $mitarbeiter->requestToken = $data->API;
    break;
}


?>