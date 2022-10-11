<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      UPDATE MYDATA API
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      n_name= Familyname
      u_name= Username
      requestToken= sha256 Hash SessionToken or GeneralKeyHash depends on Query
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
      ///////////////////UPDATE MYDATA
      $mitarbeiter->n_name = $data->Nn;
      $mitarbeiter->u_name = $data->Un;
      $mitarbeiter->requestToken = $data->RequestToken;
      ///////////////////EXECUTE QUERY
      if($mitarbeiter->updateMyData()) {
        echo json_encode(
          array('message' => 'True')
        );
      } else {
        echo json_encode(
          array('message' => 'False')
        );
      }
  


?>