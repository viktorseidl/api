<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      LOGIN API --POST
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      TID= Mitarbeiter-ID - Chipnummer
      PIN= Passwort
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
    ///////////////////USER-ID
    $Alluser->TimeTouchNr=$data->TID;
    ///////////////////PASS
    $Alluser->Pin=$data->PIN;
    ///////////////////PREPARE ARRAY FOR OUTPUT
    $mit_arr=array();
    $mit_arr['data']=array();
    ///////////////////EXECUTE QUERY
    $result = $Alluser->loginAll();
    ///////////////////GET ROWS
    $num= $result ->rowCount();
    ///////////////////IF GREATER 0 THEN
    if($num > 0){        
                ///////////////////LOGIN WITH PASS AND USER-ID
                while($row=$result->fetch(PDO::FETCH_ASSOC)){
                    extract($row);                    
                    $mit_item= array(
                        'ID' => $ID,        
                        'Name1' => $Name1,        
                        'Name2' => $Name2
                    );
                    array_push($mit_arr['data'],$mit_item);
                }            
                echo json_encode($mit_arr);        
    }else{
            echo json_encode(
                array('message' => 'Passwort oder Benutzer-ID ist falsch!')
            );
    }
?>