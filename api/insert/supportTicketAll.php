<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      SUPPORT TICKET API  -- POST
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    @Variables 
      $Mid= Mitarbeiter-ID
      $Mvname= Vorname
      $Mnname= Nachname
      $SReason= Grund
      $Mail= Mail Mitarbeiter
      $SDescription= Beschreibung
      $tnum = TicketNummer T-Unixtimestamp 
    */
  ///////////////////HEADERS  
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  ///////////////////GET RAW DATA
        $data = json_decode(file_get_contents("php://input"));
  ///////////////////PREPARE DATA
        $Mid = htmlspecialchars(strip_tags($data->Mid));
        $Mvname = htmlspecialchars(strip_tags($data->Mvname));
        $Mnname = htmlspecialchars(strip_tags($data->Mnname));
        $SReason = htmlspecialchars(strip_tags($data->SReason));
        $Mail = htmlspecialchars(strip_tags($data->Mail));
        $SDescription = nl2br(htmlspecialchars(strip_tags($data->SDescription)));
        $tnum=time();
  ///////////////////CREATE EMAIL PROCESSING
  if(isset($Mid)&&($Mvname)&&($Mnname)&&($SReason)&&($Mail)&&($SDescription)) {
      
      
        $to = "$Mail";
        $from = "noreply@data-schafhausen.com";
        $subject = "Support Ticket $tnum - $SReason";
        /////////////////CREATE XHTML 1.0 EMAIL FORMAT
        $message='                
                  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                  <html xmlns="https://www.w3.org/1999/xhtml">
                  <head>
                  <title>itsnando.com</title>
                  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                  <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
                  <link rel="apple-touch-icon" sizes="57x57" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="apple-touch-icon" sizes="60x60" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="apple-touch-icon" sizes="72x72" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="apple-touch-icon" sizes="76x76" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="apple-touch-icon" sizes="114x114" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="apple-touch-icon" sizes="120x120" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="apple-touch-icon" sizes="144x144" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="apple-touch-icon" sizes="152x152" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="apple-touch-icon" sizes="180x180" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="icon" type="image/png" sizes="192x192"  href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="icon" type="image/png" sizes="32x32" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="icon" type="image/png" sizes="96x96" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <link rel="icon" type="image/png" sizes="16x16" href="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <meta name="msapplication-TileColor" content="#ffffff">
                  <meta name="msapplication-TileImage" content="https://www.data-schafhausen.com/wp-content/uploads/favicon.jpg">
                  <style>
                  <!---Text decoration removed -->
                  .em_defaultlink a {
                  color: inherit !important;
                  text-decoration: none !important;
                  <!---Media Query for desktop layout -->
                  @media only screen and (min-width:481px) and (max-width:699px) {
                  .em_main_table {
                  width: 100% !important;
                  }
                  .em_wrapper {
                  width: 100% !important;
                  }
                  .em_hide {
                  display: none !important;
                  }
                  .em_img {
                  width: 100% !important;
                  height: auto !important;
                  }
                  .em_h20 {
                  height: 20px !important;
                  }
                  .em_padd {
                  padding: 20px 10px !important;
                  }
                  }
                  @media screen and (max-width: 480px) {
                  .em_main_table {
                  width: 100% !important;
                  }
                  .em_wrapper {
                  width: 100% !important;
                  }
                  .em_hide {
                  display: none !important;
                  }
                  .em_img {
                  width: 100% !important;
                  height: auto !important;
                  }
                  .em_h20 {
                  height: 20px !important;
                  }
                  .em_padd {
                  padding: 20px 10px !important;
                  }
                  .em_text1 {
                  font-size: 16px !important;
                  line-height: 24px !important;
                  }
                  u + .em_body .em_full_wrap {
                  width: 100% !important;
                  width: 100vw !important;
                  }
                  }
                  </style>
                  </head>
                  <body class="em_body" style="margin:0px; padding:0px;" bgcolor="#efefef">
                  <table align="center" width="700" border="0" cellspacing="0" cellpadding="0" class="em_main_table" style="width:700px;">
                  <tr>
                  <td valign="top" align="center"><table style="width:100%;" cellspacing="0" cellpadding="0" border="0" align="center">
                  <tbody><tr>
                  <td valign="top" align="center " width="100%" bgcolor="#64748b"><img class="em_img" alt="Welcome to EmailWeb Newsletter" style=" float:left; margin: 30px 0px 25px 25px;display:block; font-family:Arial, sans-serif; font-size:30px; line-height:34px; color:#000000; max-width:700px;" src="https://www.data-schafhausen.com/wp-content/uploads/DATA-Schafhausen-Logo.png" width="100" border="0" height="50"></td>
                  </tr>
                  </tbody></table></td>
                  </tr>
                  <tr>
                  <td valign="top" align="center" bgcolor="#94a3b8" style="padding:35px 70px 30px;" class="em_padd"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  <td align="left" valign="top" style="padding-top:30px;font-family:\'Open Sans\', Arial, sans-serif; font-size:16px; line-height:30px; color:#334155;">Sehr geehrte/r Mitarbeiter/in,<br/>
                  Ihr Support-Ticket ist bei uns eingegangen Ihre TicketNr ist: T-'.$tnum.'</td>
                  </tr>
                  <tr>
                  <td height="15" style="font-size:0px; line-height:0px; height:15px;">&nbsp;</td>
                  <!—this is space of 15px to separate two paragraphs -->
                  </tr>
                  <tr>
                  <td align="left" valign="top" style="font-family:\'Open Sans\', Arial, sans-serif; font-size:18px; line-height:22px; color:#1e293b; letter-spacing:2px; padding-bottom:12px;">Kopie ihrer Anfrage:</td>
                  </tr>
                  <tr>
                  <td height="25" class="em_h20" style="font-size:0px; line-height:0px; height:25px;"><hr color="#1e293b"/></td>
                  <!—this is space of 25px to separate two paragraphs -->
                  </tr>
                  <tr>
                  <td align="left" valign="top" style="font-family:\'Open Sans\', Arial, sans-serif; font-size:14px; line-height:22px; color:#334155; padding-bottom:12px;"><br/>Mitarbeiter Daten:<br/>'.$Mnname.', '.$Mvname.'<br/>'.$Mail.'<br/><br/>Nachricht:<br/>'.$SDescription.'<br/></td>
                  </tr>
                  <tr>
                  <td height="25" class="em_h20" style="font-size:0px; line-height:0px; height:25px;"><hr color="#1e293b"/></td>
                  <!—this is space of 25px to separate two paragraphs -->
                  </tr>
                  <tr>
                  <td align="left" valign="top" style="padding-bottom:30px;font-family:\'Open Sans\', Arial, sans-serif; font-size:16px; line-height:30px; color:#334155;">Wir werden versuchen Ihr Anliegen schnellstmöglich zu bearbeiten. Bedenken Sie, das es hin und wieder zu größeren Wartezeiten kommen kann wenn ein großes Aufkommen an Support-Tickets besteht.</td>
                  </tr>
                  </table></td>
                  </tr>
                  <tr>
                  <td valign="top" align="center" bgcolor="#64748b" style="padding:38px 30px;" class="em_padd"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  <td align="center" valign="top" style="font-family:\'Open Sans\', Arial, sans-serif; font-size:11px; line-height:18px; color:#e2e8f0;"><a href="https://www.data-schafhausen.com/datenschutz/" target="_blank" style="color:#e2e8f0; text-decoration:underline;">DATENSCHUTZ</a> | <a href="https://www.data-schafhausen.com/impressum/" target="_blank" style="color:#e2e8f0; text-decoration:underline;">IMPRESSUM</a><br />
                  &copy; '.date('Y', time()).' DATA Schafhausen. All Rights Reserved.<br />
                  </td>
                  </tr>
                  </table></td></tr>
                  <div class="em_hide" style="white-space: nowrap; display: none; font-size:0px; line-height:0px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                  </body></html>';
                  $headers="From: $from\n";
                  $headers.="MIME-Version: 1.0\n";
                  $headers.="Content-type: text/html; charset=ISO-8859-1\n";
                        if(mail($to, $subject, $message, $headers)){
                              $to2 = "viktorseidl@gmail.com";
                              $from2 = "$Mail";
                              $subject2 = "Support Ticket $tnum - $SReason";
                              $message2='<br/>Mitarbeiter Daten:<br/>'.$Mnname.', '.$Mvname.'<br/>'.$Mail.'<br/><br/>Nachricht:<br/>'.$SDescription.'<br/>';
                              $headers2="From: $from\n";
                              $headers2.="MIME-Version: 1.0\n";
                              $headers2.="Content-type: text/html; charset=ISO-8859-1\n";
                                    if(mail($to2, $subject2, $message2, $headers2)){
                                          echo json_encode(
                                            array('message' => 'Support Ticket T-'.$tnum' wurde erstellt. Wir werden Ihr Anliegen zeitlich bearbeiten.')
                                          );
                                    }else{
                                          echo json_encode(
                                            array('message' => 'Fehler beim senden der Anfrage aufgetreten!')
                                          );
                                    }
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