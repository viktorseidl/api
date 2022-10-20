<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA API
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      id= kann mehrere Zustände haben, hängt vom Query (qType) ab
      qType= QueryTyp
      API= Kann entweder den requestToken oder den generalKeyHash enthalten
    */

    ///////////////////HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    ///////////////////INCLUDES
    include_once('../../config/Database.php');
    include_once('../../models/Alluser.php');




    ///////////////////GET DATA
    
    ///////////////////INICIATE DB
    $database = new Database();
    $db = $database->connect();
    ///////////////////INICIATE OBJECT
    $Alluser=new Alluser($db);
    ///////////////////GET RAW DATA
    $data = json_decode(file_get_contents("php://input"));
    ///////////////////UDER-ID
    $Alluser->Pin=$data->NGK;
    ///////////////////PREPARE ARRAY FOR OUTPUT
    $mit_arr=array();
    $mit_arr['data']=array();

    $result = $Alluser->loginAllQR();

    ///////////////////GET ROWS
    $num= $result ->rowCount();
    ///////////////////IF GREATER 0 THEN
    if($num > 0){
        
                ///////////////////LOGIN WITH PASS AND USER-ID
                //  $mitarbeiter->id = hash User-ID
                //  $mitarbeiter->generalkeyHash =
                while($row=$result->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    
                    $mit_item= array(
                        'ID' => $ID,        
                        'Name1' => $Name1,        
                        'Name2' => $Name2,
                        'Pin' => $Pin,
                        'TimeTouchNr' => $TimeTouchNr
                    );
                    array_push($mit_arr['data'],$mit_item);
                }            
                echo json_encode($mit_arr);        
    }else{
        echo json_encode(
            array('message' => 'QR Code ist falsch oder nicht lesbar.')
          );
    }
?>