<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      INSERT TIMETOUCH KOMMEN API
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      id= User-ID
      v_name= Surname
      n_name= Familyname
      pinnrHash= sha256 Hash vom Passwort
      timetouchIDHash= sha256 Hash von User-ID (=TimeTouchID)
      generalKeyHash= sha256 Hash von pinnerHash + timetouchIdHash
      u_name = Benutzername für anonymisierung der perönlichen Daten
      pLevel = Permission Level (1=normaler User, 5=Admin | 2=nicht vergeben, 3=nicht vergeben, 4=nicht vergeben)
    */
  ///////////////////HEADERS
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  ///////////////////INCLUDES
  include_once('../../config/Database.php');
  include_once('../../models/Alluser.php');

  ///////////////////INICIATE DB
  $database = new Database();
  $db = $database->connect();

  ///////////////////INICIATE OBJECT
  $Alluser=new Alluser($db);

  ///////////////////GET RAW DATA
  $data = json_decode(file_get_contents("php://input"));
  ///////////////////PREPARE DATA
  $Alluser->MID = $data->MID;
  $Alluser->Personalnr = $data->Personalnr;
  $Alluser->Monat = $data->Monat;
  $Alluser->Jahr = $data->Jahr;
  $Alluser->Datum = $data->Datum;
  $Alluser->Uhrzeit = $data->Uhrzeit;
  $Alluser->Buchung = $data->Buchung;
  $Alluser->ImportDatum = $data->ImportDatum;
  $Alluser->User = $data->Benutzer;
  $Alluser->Vorgang = $data->Vorgang;
  $Alluser->ExtDate = $data->ExtDate;
  $Alluser->ExtDateTime = $data->ExtDateTime;
        
  ///////////////////NEW ENTRY
  ///////////////////CREATE QUERY
  if($Alluser->createTimeTouchKommen()) {
    echo json_encode(
      array('message' => 'Ihre Zeit wurde erfasst!')
    );
  } else {
    echo json_encode(
      array('message' => 'Fehler bei der Buchung!')
    );
  }  

  
?>