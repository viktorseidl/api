<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      CALENDAR API -- POST
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      MID= Mitarbeiter-ID
      MTH= Monat
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
    $Alluser->MID=$data->MID;
    ///////////////////MONTH
    $Alluser->Monat=$data->MTH;
    ///////////////////PREPARE ARRAY FOR OUTPUT
    $mit_arr=array();
    $mit_arr['data']=array();
    ///////////////////EXECUTE QUERY
    $result = $Alluser->getCalenderMonth();
    ///////////////////GET ROWS
    $num= $result ->rowCount();
    ///////////////////IF GREATER 0 THEN
    if($num > 0){        
                ///////////////////RETURN CALENDAR DATA
                while($row=$result->fetch(PDO::FETCH_ASSOC)){
                    extract($row);                    
                    $mit_item= array(
                        'Belegung' => $Belegung,        
                        'Urlaubstage' => $Urlaubstage,        
                        'RestUrlaub' => $RestUrlaub,        
                        'Sonderurlaub' => $Sonderurlaub,        
                        'Ausbezahlt' => $Ausbezahlt
                    );
                    array_push($mit_arr['data'],$mit_item);
                }            
                echo json_encode($mit_arr);        
    }else{
            echo json_encode(
                array('message' => 'Daten konnten nicht abgerufen werden!')
            );
    }
?>