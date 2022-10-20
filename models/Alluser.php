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
    public $ID;
    public $Name1;
    public $v_name;
    public $n_name;
    public $pinnr;
    public $Pin;
    public $Name2;
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
    //      UPDATE MYDATA METHOD
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updateMyData() {        
        ///////////////////UPDATE MYDATA ON USER
        $NN=htmlspecialchars(strip_tags($this->Name1));
        $id=htmlspecialchars(strip_tags($this->ID));
        $query = 'UPDATE 
        mitarbeiter
        SET 
        Name1 ="'.$NN.'"
        WHERE 
        ID ="'.$id.'" LIMIT 1';
        ///////////////////PREPARE STATEMENT
        $stmt = $this->conn->prepare($query);
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
        $PIN=md5(htmlspecialchars(strip_tags($this->Pin)));
        $TID=md5(htmlspecialchars(strip_tags($this->TimeTouchNr)));
                ///////////////////LOGIN WITH PASS AND ID
                $query= '
                SELECT 
                ID,
                Name1,
                Name2
                FROM
                Mitarbeiter 
                WHERE 
                md5(TimeTouchNr)="'.$TID.'" 
                AND
                md5(Pin)="'.$PIN.'"
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
        $GK=htmlspecialchars(strip_tags($this->Pin));
                ///////////////////LOGIN WITH PASS AND ID
                $query= '
                SELECT 
                ID,
                Name1,
                Name2,
                Pin,
                TimeTouchNr
                FROM
                Mitarbeiter 
                WHERE 
                md5(CONCAT(md5(TimeTouchNr),md5(Pin)))="'.$GK.'" 
                LIMIT 1
                ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute();        
                   
        ///////////////////RETURN RESULT
        return $stmt;
    }    
}
?>