<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA 
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      id= kann mehrere Zustände haben, hängt vom Query (qType) ab
      qType= QueryTyp
      API= Kann entweder den requestToken oder den generalKeyHash enthalten
    */

///////////////////Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
//include Classes
include_once('../../../config/Database.php');
include_once('../../../models/Mitarbeiter.php');




///////////////////Get Data
if(isset($_GET['id'])&&($_GET['qType'])&&($_GET['API'])){
///////////////////Create Variables
///////////////////Iniciate DB connection
$database = new Database();
$db = $database->connect();
///////////////////Iniciate Object
$mitarbeiter=new Mitarbeiter($db);

///////////////////User-ID
$mitarbeiter->id=$_GET['id'];
///////////////////Type of Query
$mitarbeiter->qType=$_GET['qType'];
///////////////////RequestToken or generalKeyHash
$mitarbeiter->requestToken=$_GET['API'];
///////////////////Create Query on read() function
///////////////////prepare Array for Output
$mit_arr=array();
$mit_arr['data']=array();

$result = $mitarbeiter->read();

///////////////////Get row count
$num= $result ->rowCount();
///////////////////if Data returned greater 0
if($num > 0){
    ///////////////////Check Output Type
    switch($mitarbeiter->qType){
        case 0:
            ///////////////////Check Log Status             
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                $mit_item= array(
                    'requestToken' => $requestToken,        
                );
                     
                if($requestToken===urldecode($mitarbeiter->requestToken)){        
                    array_push($mit_arr['data'],array('check'=>true));            
                    echo json_encode($mit_arr);
                }else{
                    array_push($mit_arr['data'],array('check'=>false));            
                    echo json_encode($mit_arr);
                }
            }
            break;
        case 1:
            ///////////////////Login with Pin and Pass
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                $mit_item= array(
                    'id' => $id,        
                    'v_name' => $v_name,        
                    'n_name' => $n_name,        
                    'u_name' => $u_name,        
                    'pLevel' => $pLevel        
                );
                array_push($mit_arr['data'],$mit_item);
            }            
            echo json_encode($mit_arr);
            break;
        case 2:
            ///////////////////Select Mitarbeiter on V_Name
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $mit_item= array(
                    'id' => $id,
                    'v_name' => $v_name,         
                    'u_name' => $u_name         
                );
                array_push($mit_arr['data'],$mit_item);
            }
            echo json_encode($mit_arr);
            break;
        case 3:
            ///////////////////Select Mitarbeiter on Permission Level
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $mit_item= array(
                    'id' => $id,
                    'v_name' => $v_name,
                    'n_name' => $n_name,
                    'u_name' => $u_name,
                    'pLevel' =>  $pLevel         
                );
        
                array_push($mit_arr['data'],$mit_item);
            }
            echo json_encode($mit_arr);
            break;
        case 4:
            ///////////////////Select U_Name on ID
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $mit_item= array(
                    'id' => $id,
                    'u_name' => $u_name         
                );
        
                array_push($mit_arr['data'],$mit_item);
            }
            echo json_encode($mit_arr);
            break;
        case 5:
            ///////////////////Login on GKey
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                $mit_item= array(
                    'generalKeyHash' => $generalKeyHash,        
                );
                     
                if($generalKeyHash===urldecode($mitarbeiter->requestToken)){        
                    array_push($mit_arr['data'],array('check'=>true));            
                    echo json_encode($mit_arr);
                }else{
                    array_push($mit_arr['data'],array('check'=>false));            
                    echo json_encode($mit_arr);
                }
            }
            break;
        case 6:
            ///////////////////Get GKey Data
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                $mit_item= array(
                    'generalKeyHash' => $generalKeyHash,        
                );
        
                array_push($mit_arr['data'],$mit_item);
            }
            echo json_encode($mit_arr);
            break;
        default:
        echo json_encode(
            array('message' => 'Keine Mitarbeiter gefunden!')
        );
        break;
    }
    
    
    
    
}else{
    switch($mitarbeiter->qType){
        case 0:
            array_push($mit_arr['data'],array('check'=>false));
            echo json_encode($mit_arr);
            break;
        case 1:
            array_push($mit_arr['data'],array('check'=>false));
            echo json_encode($mit_arr);
            break;
        case 2:
            echo json_encode(
                array('message' => 'Keine Mitarbeiter gefunden!')
            );
            break;
        case 3:
            echo json_encode(
                array('message' => 'Keine Mitarbeiter gefunden!')
            );
            break;
        case 4:
            echo json_encode(
                array('message' => 'Keine Mitarbeiter gefunden!')
            );
            break;
        case 5:
            array_push($mit_arr['data'],array('check'=>false));
            echo json_encode($mit_arr);
            break;
        default:
        array_push($mit_arr['data'],array('message' => 'Keine Mitarbeiter gefunden!'));
        echo json_encode($mit_arr);
        break;
    }
    
}
}

?>