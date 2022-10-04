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
    ///////////////////INCLUDES
    include_once('../../../config/Database.php');
    include_once('../../../models/Mitarbeiter.php');




    ///////////////////GET DATA
    if(isset($_GET['id'])&&($_GET['qType'])&&($_GET['API'])){
    ///////////////////INICIATE DB
    $database = new Database();
    $db = $database->connect();
    ///////////////////INICIATE OBJECT
    $mitarbeiter=new Mitarbeiter($db);

    ///////////////////UDER-ID
    $mitarbeiter->id=$_GET['id'];
    ///////////////////QUERY TYPE
    $mitarbeiter->qType=$_GET['qType'];
    ///////////////////REQUESTTOKEN OR GENERALKEYHASH
    $mitarbeiter->requestToken=$_GET['API'];
    ///////////////////PREPARE ARRAY FOR OUTPUT
    $mit_arr=array();
    $mit_arr['data']=array();

    $result = $mitarbeiter->read();

    ///////////////////GET ROWS
    $num= $result ->rowCount();
    ///////////////////IF GREATER 0 THEN
    if($num > 0){
        ///////////////////CHECK QUERY TYPE
        switch($mitarbeiter->qType){
            case 0:
                ///////////////////CHECK IF LOGGED IN 
                //  $mitarbeiter->id = User-ID
                //  $mitarbeiter->requestToken = hash256 requestToken  => SessionToken           
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
                ///////////////////LOGIN WITH PASS AND USER-ID
                //  $mitarbeiter->id = hash User-ID
                //  $mitarbeiter->requestToken = hash256 Password
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
                ///////////////////SELECT USER ON V_NAME
                //  $mitarbeiter->id = User V_Name
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
                ///////////////////SELECT ALL USERS ON PERMISSION LEVEL
                //  $mitarbeiter->id = Permission Level
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
                ///////////////////SELECT U_NAME ON USER-ID
                //  $mitarbeiter->id = User-ID
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
                ///////////////////LOGIN WITH GENERALKEYHASH
                //  $mitarbeiter->requestToken = hash256 GKey
                while($row=$result->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    
                    $mit_item= array(
                        'generalKeyHash' => $generalKeyHash,        
                        'pinnrHash' => $pinnrHash        
                        'timetouchIdHash' => $timetouchIdHash        
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
                ///////////////////GET GENERALKEYHASH DATA
                //  $mitarbeiter->id = User-ID
                //  $mitarbeiter->requestToken = hash256 GKey
                while($row=$result->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    
                    $mit_item= array(
                        'generalKeyHash' => $generalKeyHash,        
                    );
            
                    array_push($mit_arr['data'],$mit_item);
                }
                echo json_encode($mit_arr);
                break;
            case 7:
                ///////////////////GET PROVEN IF OLD PASSWORD EXISTS FOR PASSWORD CHANGE
                //  $mitarbeiter->id = hash256 newPasswort
                //  $mitarbeiter->requestToken = hash256 GKey
                while($row=$result->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    
                    $to = $mail;
                    $subject = "Neues Passwort aktivieren";
                
                    $message = "<h1>Passwort Aktivierung</h1>";
                    $message .= "<b>Damit Ihr Passwort aktiviert ist, müssen Sie folgenden Link bestätigen</b>";
                    $message .= '<a href="localhost/updateMitarbeiter.php?id='.$mitarbeiter->requestToken.'&uid='.$mitarbeiter->id.'">Passwort aktivieren</a>';
                
                    $header = "From:abc@somedomain.com \r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";
                
                    $retval = mail ($to,$subject,$message,$header);
                    $msg='';
                    if( $retval == true ) {
                        $msg.="Nachricht versendet";
                    } else {
                        $msg.="Nachricht konnte nicht versendet werden.";
                    }
                }             
                echo json_encode(
                    array('message' => $msg)
                );
                break;
            default:
            ///////////////////RETURN NOTHING
            echo json_encode(
                array('message' => 'Kein Eintrag vorhanden!')
            );
            break;
        }
        
        
        
        
    }else{
        ///////////////////IF NOT DATA FOUND IN DB RETURN ON QUERY TYPE
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
                    array('message' => 'Kein Eintrag vorhanden!')
                );
                break;
            case 3:
                echo json_encode(
                    array('message' => 'Kein Eintrag vorhanden!')
                );
                break;
            case 4:
                echo json_encode(
                    array('message' => 'Kein Eintrag vorhanden!')
                );
                break;
            case 5:
                array_push($mit_arr['data'],array('check'=>false));
                echo json_encode($mit_arr);
                break;
            default:
            array_push($mit_arr['data'],array('message' => 'Kein Eintrag vorhanden!'));
            echo json_encode($mit_arr);
            break;
        }
        
    }
    }

?>