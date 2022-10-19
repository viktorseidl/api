<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      2 FACTOR AUTHENTICATION
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    */
  ///////////////////HEADERS

    if(isset($_GET['M'])&&($_GET['PP'])&&($_GET['PT'])){
    
        ///////////////////PREPARE DATA
        $TID = str_replace('5ded1cad640d14abdb9f6589c7a2e23c153ee804','',$_GET['M']);
        $TID = base64_decode(base64_decode(urldecode($TID)));
        $PASS = str_replace('ad640d14abc589c7a2e23c153edb9f65ded1e804','',$_GET['PP']);
        $PASS = base64_decode(base64_decode(urldecode($PASS)));
        $TIME = str_replace('e23c1535ded1cad640d14aee804bdb9f6589c7a2','',$_GET['PT']);
        $TIME = base64_decode(base64_decode(urldecode($TIME)));
        if(time()>$TIME){
            echo "Link ist abgelaufen";
        }else{
            include_once('../../config/Database.php');
            include_once('../../models/Alluser.php');
            ///////////////////INICIATE DB
            $database = new Database();
            $db = $database->connect();
            ///////////////////INICIATE OBJECT
            $Alluser=new Alluser($db);
            $Alluser->TimeTouchNr = $TID;
            $Alluser->Pin = $PASS;
            if($Alluser->updatePass()){
                echo "Passwort ist jetzt aktiviert";
            }else{
                echo "Aktivierung fehlgeschlagen";
            }
        }
    
    
  
    }else{  
        http_response_code(404);
        exit();
    }
?>