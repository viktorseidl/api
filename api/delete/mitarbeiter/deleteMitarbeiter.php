<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      DELETE DATA API 
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      id= User-ID to be deleted
      pinnr= Admin-ID
      requestToken= requestToken of Admin (SessionToken)
    */
    ///////////////////HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    ///////////////////INCLUDES
    include_once('../../../config/Database.php');
    include_once('../../../models/Mitarbeiter.php');

    ///////////////////INICIALISE DB
    $database = new Database();
    $db = $database->connect();

    ///////////////////INICIATE OBJECT
    $mitarbeiter=new Mitarbeiter($db);

    ///////////////////GET RAW DATA
    $data = json_decode(file_get_contents("php://input"));
    ///////////////////PREPARE DATA
    $mitarbeiter->id = $data->did;
    $mitarbeiter->pinnr = $data->pid;
    $mitarbeiter->requestToken = $data->API;

        ///////////////////EXECUTE QUERY
        if($mitarbeiter->deleteMitarbeiter()) {
        echo json_encode(
            array('message' => 'Mitarbeiter wurde gelöscht')
        );
        } else {
        echo json_encode(
            array('message' => 'Fehler aufgetreten!')
        );
        }
        


?>