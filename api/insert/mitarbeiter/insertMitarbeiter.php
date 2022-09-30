<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      INSERT DATA 
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
///////////////////Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
///////////////////include Classes
include_once('../../../config/Database.php');
include_once('../../../models/Mitarbeiter.php');

///////////////////Iniciate DB connection
$database = new Database();
$db = $database->connect();

///////////////////Iniciate Object
$mitarbeiter=new Mitarbeiter($db);

///////////////////Get raw posted data
$data = json_decode(file_get_contents("php://input"));
///////////////////prepare Data
$mitarbeiter->v_name = $data->v_name;
$mitarbeiter->n_name = $data->n_name;
$mitarbeiter->pinnr = $data->pinnr;
$mitarbeiter->pinnrHash = $data->pinnrHash;
$mitarbeiter->timetouchIdHash = $data->timetouchIdHash;
$mitarbeiter->generalKeyHash = $data->generalKeyHash;
$mitarbeiter->u_name = $data->u_name;
$mitarbeiter->pLevel = $data->pLevel;
///////////////////Create query
if($mitarbeiter->createMitarbeiter()) {
    echo json_encode(
      array('message' => 'Mitarbeiter wurde erstellt')
    );
  } else {
    echo json_encode(
      array('message' => 'Fehler beim Speichern aufgetreten')
    );
  }
?>