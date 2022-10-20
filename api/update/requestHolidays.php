<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      INSERT DATA API
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
   
    */
  ///////////////////HEADERS
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  ///////////////////GET RAW DATA
  $data = json_decode(file_get_contents("php://input"));
  ///////////////////PREPARE DATA

        $Mid = htmlspecialchars(strip_tags($data->MID));
        $Mvname = htmlspecialchars(strip_tags($data->Mvname));
        $Mnname = htmlspecialchars(strip_tags($data->Mnname));
        $FromDate = htmlspecialchars(strip_tags($data->Datum));
        $ToDate = htmlspecialchars(strip_tags($data->BisDatum));
        $Antragtyp = htmlspecialchars(strip_tags($data->Antragtyp));
        $AnzahlTage = htmlspecialchars(strip_tags($data->AnzahlTage));
        $SDescription = nl2br(htmlspecialchars(strip_tags($data->Bemerkung)));
  ///////////////////CREATE QUERY
  if(isset($Mid)&&($Mvname)&&($Mnname)&&($FromDate)&&($ToDate)&&($Antragtyp)&&($AnzahlTage)) {
      
      
        $to = "viktorseidl@gmail.com";
        $from = "noreply@data-schafhausen.com";
        $subject = "Urlaubsantrag";
        $message='<br/>Mitarbeiter Daten:<br/>Mitarbeiter-ID: '.$Mid.'<br/>Name: '.$Mnname.', '.$Mvname.'<br/>Von Datum: '.$FromDate.'<br/>Bis Datum: '.$ToDate.'<br/>Typ: '.$Antragtyp.'<br/>Anzahl Tage: '.$AnzahlTage.'<br/><br/>Bemerkung:<br/>'.$SDescription.'<br/>';
        $headers="From: $from\n";
        $headers.="MIME-Version: 1.0\n";
        $headers.="Content-type: text/html; charset=ISO-8859-1\n";
            if(mail($to, $subject, $message, $headers)){
                echo json_encode(
                    array('message' => 'Urlaubsantrag wurde erstellt! Sobald er genehmigt wurde, wird dieser in Ihren Kalender angezeigt.')
                );
                      
            }else{
                echo json_encode(
                    array('message' => 'Fehler beim senden der Anfrage aufgetreten!')
                );
            }
                
    } else {

      echo json_encode(
        array('message' => 'Fehler beim senden der Anfrage aufgetreten!')
      );

    }
?>