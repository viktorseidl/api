<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      UPDATE DATA API
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      id= User-ID
      v_name= Surname
      n_name= Familyname
      u_name= Username
      pinnr= sha256 Hash of Password
      pinnrNew= sha256 Hash of new Password
      requestToken= sha256 Hash SessionToken or GeneralKeyHash depends on Query
      pLevel = Permission Level (1=normal User, 5=Admin | 2=N/A, 3=N/A, 4=N/A)
    */
  ///////////////////HEADERS
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  ///////////////////INCLUDES
  include_once('../../../config/Database.php');
  include_once('../../../models/Mitarbeiter.php');

  ///////////////////INICIALISE DB
  $database = new Database();
  $db = $database->connect();

  ///////////////////INICIALISE OBJECT
  $mitarbeiter=new Mitarbeiter($db);

  ///////////////////GET RAW DATA
  $data = json_decode(file_get_contents("php://input"));
  ///////////////////PREPARE DATA
  $mitarbeiter->qType = $data->qType;
  ///////////////////SWITCH FOR QUERY OPTION
  switch($mitarbeiter->qType){
    case 0:
      ///////////////////UPDATE N_NAME
      $mitarbeiter->n_name = $data->n_name;
      $mitarbeiter->id = $data->id;
      $mitarbeiter->requestToken = $data->API;
      ///////////////////EXECUTE QUERY
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
      ///////////////////NO QUERY OPTION FOR THIS
      return false;  
      break;
    case 2:
      ///////////////////UPDATE U_NAME
      $mitarbeiter->u_name = $data->u_name;
      $mitarbeiter->id = $data->id;
      $mitarbeiter->requestToken = $data->API;
      ///////////////////EXECUTE QUERY
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
    case 3:
      ///////////////////UPDATE PERMISSION LEVEL
      $mitarbeiter->pLevel = $data->pLevel;
      $mitarbeiter->id = $data->id;
      $mitarbeiter->requestToken = $data->API;
      ///////////////////EXECUTE QUERY
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
    case 4:
      ///////////////////UPDATE SESSIONTOKEN 
      $mitarbeiter->id = $data->id;
      $mitarbeiter->requestToken = $data->API;
      $mitarbeiter->pinnrNew = $data->NRQ;
      ///////////////////EXECUTE QUERY
      if($mitarbeiter->updateMitarbeiter()) {
        echo json_encode(
          array('message' => true)
        );
      } else {
        echo json_encode(
          array('message' => false)
        );
      }
      break;
  }


?>