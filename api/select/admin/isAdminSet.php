<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA API
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      Aid= kann mehrere Zustände haben, hängt vom Query (qType) ab
      qType= QueryTyp
      API= Kann entweder den requestToken oder den generalKeyHash enthalten
    */

    ///////////////////HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    ///////////////////INCLUDES
    include_once('../../../config/Database.php');
    include_once('../../../models/Admin.php');
    
    ///////////////////INICIATE DB
    $database = new Database();
    $db = $database->connect();
    ///////////////////INICIATE OBJECT
    $admin=new Admin($db);
    ///////////////////GET RAW DATA
    $data = json_decode(file_get_contents("php://input"));
    ///////////////////UDER-ID
    $admin->Aid=$data->Id;
    ///////////////////PREPARE ARRAY FOR OUTPUT

    $result = $admin->isAdminSet();

    ///////////////////GET ROWS
    $num= $result ->rowCount();
    ///////////////////IF GREATER 0 THEN
    if($num > 0){
        
                ///////////////////CHECK IF LOGGED IN 
                //  $mitarbeiter->id = User-ID
                //  $mitarbeiter->requestToken = hash256 requestToken  => SessionToken           
                while($row=$result->fetch(PDO::FETCH_ASSOC)){
                    if($row['checkIfSet']>0){
                        echo json_encode(true);
                    }else{
                        echo json_encode(false);
                    }
                }
            
        
    }else{
        echo json_encode(false);
    }

?>