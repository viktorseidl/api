<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      UPDATE SESSION TOKEN
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
  include_once('../../config/Database.php');
  include_once('../../models/Mitarbeiter.php');

  ///////////////////INICIALISE DB
  $database = new Database();
  $db = $database->connect();

  ///////////////////INICIALISE OBJECT
  $mitarbeiter=new Mitarbeiter($db);

  ///////////////////GET RAW DATA
  $data = json_decode(file_get_contents("php://input"));
  ///////////////////PREPARE DATA
      ///////////////////UPDATE SESSIONTOKEN 
      $mitarbeiter->id = $data->id;
      $mitarbeiter->timetouchIdHash = $data->API;
      $mitarbeiter->requestToken = $data->NRQ;
      ///////////////////EXECUTE QUERY
      if($mitarbeiter->updateSessionAll()) {
        echo json_encode(
          array('message' => true)
        );
      } else {
        echo json_encode(
          array('message' => false)
        );
      }
  

?>