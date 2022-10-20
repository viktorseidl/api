<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      2 FACTOR AUTHENTICATION
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    */
  ///////////////////HEADERS
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once('../../config/Database.php');
  include_once('../../models/Alluser.php');
  ///////////////////INICIATE DB
  $database = new Database();
  $db = $database->connect();
  ///////////////////INICIATE OBJECT
  $Alluser=new Alluser($db);
  ///////////////////GET RAW DATA
  $data = json_decode(file_get_contents("php://input"));
  ///////////////////PREPARE DATA
  $Alluser->TimeTouchNr = base64_decode(urldecode($data->MID));
  $Alluser->Pin = base64_decode(urldecode($data->PP));
  $MID = urlencode(base64_encode(urldecode($data->MID)));
  $PassOld = urlencode(base64_encode(urldecode($data->PP)));
  $PassNew = urlencode(base64_encode(urldecode($data->PPN)));
  $Email = base64_decode(urldecode($data->EM));
  $Salt1 = '5ded1cad640d14abdb9f6589c7a2e23c153ee804';
  $Salt2 = 'ad640d14abc589c7a2e23c153edb9f65ded1e804';
  $Salt3 = 'e23c1535ded1cad640d14aee804bdb9f6589c7a2';
  $result = $Alluser->loginAll();
  $sevenDay=urlencode(base64_encode(base64_encode(time()+(3600*24*7))));
  //TESTSTRING : https:\/\/www.data-schafhausen.com\/activateNewPass.php?M=TWc9PQ%3D%3D5ded1cad640d14abdb9f6589c7a2e23c153ee804&PP=ad640d14abc589c7a2e23c153edb9f65ded1e804VDJob01pRmhZV0U9&PT=TVRZMk5qYzVNVFUzTmc9PQ%3D%3De23c1535ded1cad640d14aee804bdb9f6589c7a2
    $m='https://www.itsnando.com/api/update/activateNewPass.php?M='.$MID.$Salt1.'&PP='.$Salt2.$PassNew.'&PT='.$sevenDay.$Salt3;
    ///////////////////GET ROWS
    $num= $result ->rowCount();
    ///////////////////IF GREATER 0 THEN 
    if($num > 0){
        
        //Send E-mail
        
        $to = "$Email";
        $from = "noreply@data-schafhausen.com";
        $subject = 'Passwort aktivieren';
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
          <td valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td valign="top" align="center " bgcolor="#64748b"><img class="em_img" alt="Welcome to EmailWeb Newsletter" style=" float:left; margin: 30px 0px 25px 25px;display:block; font-family:Arial, sans-serif; font-size:30px; line-height:34px; color:#000000; max-width:700px;" src="https://www.data-schafhausen.com/wp-content/uploads/DATA-Schafhausen-Logo.png" width="100" border="0" height="50"></td>
              </tr>
            </tbody></table></td>
        </tr>
        <tr>
                <td valign="top" align="center" bgcolor="#94a3b8" style="padding:35px 70px 30px;" class="em_padd"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" style="padding-top:30px;font-family:\'Open Sans\', Arial, sans-serif; font-size:16px; line-height:30px; color:#334155;">Sehr geehrte/r Mitarbeiter/in,<br/>
                      damit Sie Ihr neues Passwort nutzen können müssen Sie es aktivieren.<br/><br/>Bitte aktivieren Sie jetzt ihr festgelegtes Passwort, indem Sie auf den nachfolgenden Aktivierungs-Link klicken:</td>
                    </tr>
                    <tr>
                      <td height="15" style="font-size:0px; line-height:0px; height:15px;">&nbsp;</td>
        <!—this is space of 15px to separate two paragraphs -->
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="font-family:\'Open Sans\', Arial, sans-serif; font-size:18px; line-height:22px; color:#1e293b; letter-spacing:2px; padding-bottom:12px;">AKTIVIERUNGS-LINK <i style="color:#1e293b;font-family:\'Open Sans\', Arial, sans-serif; font-size:16px;">(Dieser Link ist nur f&uuml;r 7 Tage g&uuml;ltig ab: '.date('d.m.Y H:i:s', time()).')</i></td>
                    </tr>
                    <tr>
                      <td height="25" class="em_h20" style="font-size:0px; line-height:0px; height:25px;">&nbsp;</td>
        <!—this is space of 25px to separate two paragraphs -->
                    </tr>
        <tr>
                      <td align="left" valign="top" style="font-family:\'Open Sans\', Arial, sans-serif; font-size:18px; line-height:22px; color:#334155; letter-spacing:2px; padding-bottom:12px;"><a style="color:#2563eb;" href="'.$m.'">AKTIVIERE PASSWORT</a></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:30px;font-family:\'Open Sans\', Arial, sans-serif; font-size:16px; line-height:30px; color:#334155;">Diese Aktivierung ist nur innerhalb der n&auml;chsten 7 Tage g&uuml;ltig.<br/><br/>Wenn Sie die E-mail irrtümlicherweise erhalten haben, dann kontaktieren Sie bitte den Absender.<br/><br/> Sollten Sie kein neues Passwort festgelegt haben, dann wurde wahrscheinlich ihr Benutzerkonto kompromittiert. In diesem Fall, setzen Sie sich bitte mit den Support in Verbindung.</td>
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
                          </table></td>
                      </tr>
                      <div class="em_hide" style="white-space: nowrap; display: none; font-size:0px; line-height:0px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                      </body></html>';
                      $headers="From: $from\n";
                  $headers.="MIME-Version: 1.0\n";
                  $headers.="Content-type: text/html; charset=ISO-8859-1\n";
                  if(mail($to, $subject, $message, $headers)){
                    echo json_encode(
                        array('message' => 'Eine Aktivierungs-E-Mail wurde an Sie versendet! Sie werden jetzt abgemeldet.')
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
?>