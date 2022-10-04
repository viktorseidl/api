<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      UPDATE PASSWORD 
    //      REQUEST COMES FROM ACTIVATION E-MAIL
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables
      id= hash Gkey
      uid= hash Password
    */
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
//include Classes
include_once('../../../config/Database.php');
include_once('../../../models/Mitarbeiter.php');

//Iniciate DB connection
$database = new Database();
$db = $database->connect();

//Iniciate Object
$mitarbeiter=new Mitarbeiter($db);
if(isset($_GET['id'])&&($_GET['uid'])){

///////////////////HASH GENERAL KEY
$mitarbeiter->requestToken=$_GET['id'];
///////////////////Type of Query
$mitarbeiter->qType=5;
///////////////////HASH PASSWORD
$mitarbeiter->pinnrNew=$_GET['uid'];
///////////////////Get Data for Update
$result = $mitarbeiter->read();
$num= $result ->rowCount();
///////////////////if Data returned greater 0
if($num > 0){
    $oldTTIDHash='';
    ///////////////////GET TIMETOUCHIDHASH
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        $oldTTIDHash=$row['timetouchIdHash'];
    }
    ///////////////////CHANGE QUERY TYPE TO 1 ON UPDATES
    $mitarbeiter->qType=1;
    ///////////////////SAVE TIMETOUCHIDHASH
    $mitarbeiter->timetouchIdHash=$oldTTIDHash;
    ///////////////////EXECUTE UPDATE
    if($mitarbeiter->updateMitarbeiter()) {
        ///////////////////ON SUCCESS CONFIRM
        echo json_encode(
          array('message' => 'Mitarbeiter wurde aktualisiert')
        );
      } else {
        ///////////////////ON FAILURE CONFIRM ALSO
        echo json_encode(
          array('message' => 'Fehler bei der Aktualisierung aufgetreten!')
        );
      }

}else{
    ///////////////////NO MITARBEITER FOUND
    echo "Fehler bei der Aktualisierung aufgetreten!";
    exit();
}
}
?>