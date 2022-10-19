<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      MITARBEITER CLASS
    //      
    //      @ FUNCTION INSERT 
    //      @ FUNCTION SELECT
    //      @ FUNCTION UPDATE
    //      @ FUNCTION DELETE
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

class Alluser{
    ///////////////////DB
    private $conn;

    ///////////////////SCHEMA
    public $id;
    public $v_name;
    public $n_name;
    public $pinnr;
    public $Pin;
    public $pinnrNew;
    public $pinnrHash;
    public $TimeTouchNr;
    public $timetouchId;
    public $timetouchIdHash;
    public $generalKeyHash;
    public $u_name;
    public $pLevel;
    public $requestToken;
    public $umail;
    public $SReason;
    public $SDescription;
    public $MID;
    public $Monat;
    public $Jahr;
    public $Datum;
    public $Uhrzeit;
    public $Buchung;
    public $ImportDatum;
    public $User;
    public $Vorgang;
    public $ExtDate;
    public $ExtDateTime;
    public $Personalnr;

    ///////////////////INICIALISE CLASS
    public function __construct($db){
        $this->conn=$db;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA METHOD
    //      UP TO 7 SELECTS IN ONE METHOD
    //      QTYPE SWITCHES BETWEEN THE DIFFERENT QUERY OPTIONS
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updatePass(){
        ///////////////////INICIALISE VARIABLES 
        $tid=htmlspecialchars(strip_tags($this->TimeTouchNr));
        $pas=htmlspecialchars(strip_tags($this->Pin));
                ///////////////////LOGIN WITH PASS AND ID
                $query= '
                UPDATE 
                mitarbeiter
                SET
                Pin="'.$pas.'" 
                WHERE 
                md5(TimeTouchNr)=md5("'.$tid.'") 
                LIMIT 1
                ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 if($stmt->execute()) {
                    return true;
                 }else{
                    return false;
                 } 
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA METHOD
    //      UP TO 7 SELECTS IN ONE METHOD
    //      QTYPE SWITCHES BETWEEN THE DIFFERENT QUERY OPTIONS
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function loginAll(){
        ///////////////////INICIALISE VARIABLES 
        $uid=htmlspecialchars(strip_tags($this->id));
        $API=htmlspecialchars(strip_tags($this->pinnrHash));
                ///////////////////LOGIN WITH PASS AND ID
                $gKey=hash('sha256',$API.$uid);
                $query= '
                SELECT 
                id,
                v_name,
                n_name,
                u_name,
                timetouchIdHash,
                generalKeyHash,
                mail,
                pLevel,
                urlaubstage
                FROM
                mitarbeiter 
                WHERE 
                generalKeyHash="'.$gKey.'" 
                LIMIT 1
                ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute();        
                   
        ///////////////////RETURN RESULT
        return $stmt;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA METHOD
    //      UP TO 7 SELECTS IN ONE METHOD
    //      QTYPE SWITCHES BETWEEN THE DIFFERENT QUERY OPTIONS
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCalenderMonth(){
        ///////////////////INICIALISE VARIABLES 
        $mth=htmlspecialchars(strip_tags($this->Monat));
        $uid=htmlspecialchars(strip_tags($this->MID));
                ///////////////////LOGIN WITH PASS AND ID
                $query= '
                SELECT 
                Belegung,
                Urlaubstage,
                RestUrlaub,
                Sonderurlaub,
                Ausbezahlt
                FROM
                murlaub 
                WHERE 
                MID="'.$uid.'" 
                AND 
                Monat="'.$mth.'"
                LIMIT 1
                ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute();        
                   
        ///////////////////RETURN RESULT
        
        return $stmt;
        
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA METHOD
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getLastTimetouches(){
        ///////////////////INICIALISE VARIABLES 
        $mid=htmlspecialchars(strip_tags($this->MID));
        
        
                ///////////////////LOGIN WITH PASS AND ID
                $query= '
                SELECT 
                Datum,
                Uhrzeit,
                Vorgang
                FROM
                TimeTouchBuchungen
                WHERE 
                MID ="'.$mid.'" order by ID desc 
                LIMIT 5
                ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute();        
                   
        ///////////////////RETURN RESULT
        return $stmt;
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      INSERT DATA METHOD 
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createTimeTouchKommen() {
        ///////////////////QUERY
        $query = 'INSERT INTO 
        TimeTouchBuchungen 
        SET 
        MID = :MID, 
        Personalnr = :Personalnr, 
        Monat = :Monat, 
        Jahr = :Jahr, 
        Datum = :Datum, 
        Uhrzeit = :Uhrzeit, 
        Buchung = :Buchung, 
        ImportDatum = :ImportDatum, 
        User = :User, 
        Vorgang = :Vorgang, 
        extDate = :extDate, 
        extDateTime = :extDateTime
        ';

        ///////////////////PREPARE STATEMENT
        $stmt = $this->conn->prepare($query);

        ///////////////////CLEAN DATA
        $this->MID = htmlspecialchars(strip_tags($this->MID));
        $this->Personalnr = htmlspecialchars(strip_tags($this->Personalnr));
        $this->Monat = htmlspecialchars(strip_tags($this->Monat));
        $this->Jahr = htmlspecialchars(strip_tags($this->Jahr));
        $this->Datum = htmlspecialchars(strip_tags($this->Datum));
        $this->Uhrzeit = htmlspecialchars(strip_tags($this->Uhrzeit));
        $this->Buchung = htmlspecialchars(strip_tags($this->Buchung));
        $this->ImportDatum = htmlspecialchars(strip_tags($this->ImportDatum));
        $this->User = htmlspecialchars(strip_tags($this->User));
        $this->Vorgang = htmlspecialchars(strip_tags($this->Vorgang));
        $this->ExtDate = htmlspecialchars(strip_tags($this->ExtDate));
        $this->ExtDateTime = htmlspecialchars(strip_tags($this->ExtDateTime));
                
        ///////////////////BIND DATA
        $stmt->bindParam(':MID', $this->MID);
        $stmt->bindParam(':Personalnr', $this->Personalnr);
        $stmt->bindParam(':Monat', $this->Monat);
        $stmt->bindParam(':Jahr', $this->Jahr);
        $stmt->bindParam(':Datum', $this->Datum);
        $stmt->bindParam(':Uhrzeit', $this->Uhrzeit);
        $stmt->bindParam(':Buchung', $this->Buchung);
        $stmt->bindParam(':ImportDatum', $this->ImportDatum);
        $stmt->bindParam(':User', $this->User);
        $stmt->bindParam(':Vorgang', $this->Vorgang);
        $stmt->bindParam(':extDate', $this->ExtDate);
        $stmt->bindParam(':extDateTime', $this->ExtDateTime);
        
        ///////////////////EXECUTE QUERY
        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }     
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA METHOD
    //      UP TO 7 SELECTS IN ONE METHOD
    //      QTYPE SWITCHES BETWEEN THE DIFFERENT QUERY OPTIONS
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function loginAllQR(){
        ///////////////////INICIALISE VARIABLES 
        $gKey=htmlspecialchars(strip_tags($this->generalKeyHash));
        
                ///////////////////LOGIN WITH PASS AND ID
                $query= '
                SELECT 
                id,
                v_name,
                n_name,
                u_name,
                pinnrHash,
                timetouchIdHash,
                generalKeyHash,
                mail,
                pLevel,
                urlaubstage
                FROM
                mitarbeiter 
                WHERE 
                generalKeyHash="'.$gKey.'" 
                LIMIT 1
                ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute();        
                   
        ///////////////////RETURN RESULT
        return $stmt;
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      INSERT DATA METHOD 
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createSupportTicket() {
        ///////////////////QUERY
        $query = 'INSERT INTO 
        supportanfrage 
        SET 
        m_id = :id, 
        m_vname = :v_name, 
        m_nname = :n_name, 
        reason = :reason, 
        description = :descript
        ';

        ///////////////////PREPARE STATEMENT
        $stmt = $this->conn->prepare($query);

        ///////////////////CLEAN DATA
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->v_name = htmlspecialchars(strip_tags($this->v_name));
        $this->n_name = htmlspecialchars(strip_tags($this->n_name));
        $this->SReason = htmlspecialchars(strip_tags($this->SReason));
        $this->SDescription = nl2br(htmlspecialchars(strip_tags($this->SDescription)));
                
        ///////////////////BIND DATA
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':v_name', $this->v_name);
        $stmt->bindParam(':n_name', $this->n_name);
        $stmt->bindParam(':reason', $this->SReason);
        $stmt->bindParam(':descript', $this->SDescription);
        
        ///////////////////EXECUTE QUERY
        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }     
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      UPDATE SESSION TOKEN METHOD
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updateSessionAll() {        
                ///////////////////UPDATE SESSIONTOKEN ON USER
                $id=htmlspecialchars(strip_tags($this->id));
                $API=htmlspecialchars(strip_tags($this->timetouchIdHash));
                $NRQ=htmlspecialchars(strip_tags($this->requestToken));
                $query = 'UPDATE 
                mitarbeiter
                SET 
                requestToken ="'.$NRQ.'"
                WHERE 
                id ="'.$id.'" AND timetouchIdHash="'.$API.'" LIMIT 1';
                ///////////////////PREPARE STATEMENT
                $stmt = $this->conn->prepare($query);
                ///////////////////EXECUTE QUERY
                if($stmt->execute()) {
                    return true;
                }else{
                    return false;
                }                
    }
    
    
}
?>