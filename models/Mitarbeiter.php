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

class Mitarbeiter{
    ///////////////////DB
    private $conn;

    ///////////////////SCHEMA
    public $id;
    public $v_name;
    public $n_name;
    public $pinnr;
    public $pinnrNew;
    public $pinnrHash;
    public $timetouchId;
    public $timetouchIdHash;
    public $generalKeyHash;
    public $u_name;
    public $pLevel;
    public $requestToken;
    public $qType;

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
    public function read(){
        ///////////////////INICIALISE VARIABLES 
        $uid=htmlspecialchars(strip_tags($this->id));
        $type=htmlspecialchars(strip_tags($this->qType));
        $API=htmlspecialchars(strip_tags($this->requestToken));
        
        switch($type){
            case 0:
                ///////////////////CHECK IF LOGGED IN                
                $query= '
                SELECT 
                requestToken
                FROM
                mitarbeiter 
                WHERE 
                id="'.$uid.'" AND requestToken = "'.$API.'" 
                LIMIT 1
                ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute();
        
                break;
            case 1:
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
                pLevel
                FROM
                ' .$this->table.' 
                WHERE 
                generalKeyHash="'.$gKey.'" 
                LIMIT 1
                ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute();        
                break;
            case 2:
                /////////////////// SELECT USER ON V_NAME (VORNAME)
                $query= 'SELECT 
                id,
                v_name,
                u_name,
                mail 
                FROM
                ' .$this->table.' 
                WHERE 
                v_name LIKE "%'.$uid.'%" ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute();        
                break;
            case 3:
                ///////////////////SELECT ALL USER ON PERMISSION LEVEL
                $query= 'SELECT 
                id,
                v_name,
                n_name,
                u_name,
                mail,
                pLevel 
                FROM
                ' .$this->table.' 
                WHERE
                pLevel="'.$uid.'" ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute(); 
                break;
            case 4:
                ///////////////////SELECT USERNAME ON USER-ID
                $query= 'SELECT
                id, 
                u_name
                FROM
                ' .$this->table.' 
                WHERE
                id="'.$uid.'" ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute(); 
                break;
            case 5:
                ///////////////////LOGIN WITH GERNERALKEYHASH
                $query= 'SELECT 
                pinnrHash,
                timetouchIdHash,
                generalKeyHash
                FROM
                ' .$this->table.' 
                WHERE 
                generalKeyHash="'.$API.'" ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute(); 
                break;
            case 6:
                ///////////////////SELECT FULL DATA ON GENERALKEYHASH AND USER-ID
                $query= 'SELECT
                id,
                v_name,
                n_name,
                u_name,
                mail,
                generalKeyHash
                FROM
                ' .$this->table.' 
                WHERE 
                generalKeyHash="'.$API.'"
                AND
                id="'.$uid.'" LIMIT 1 ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute(); 
                break;
            case 7:
                ///////////////////SELECT MAIL ON GENERALKEYHASH FOR PASSWORD CHANGE
                $query= 'SELECT
                mail
                FROM
                ' .$this->table.' 
                WHERE 
                generalKeyHash="'.$API.'" 
                LIMIT 1 ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute(); 
                break;
            default:
                $stmt=null;
            break;
        }        
        ///////////////////RETURN RESULT
        return $stmt;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      INSERT DATA METHOD 
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createMitarbeiter() {
        ///////////////////QUERY
        $query = 'INSERT INTO 
        mitarbeiter 
        SET 
        v_name = :v_name, 
        n_name = :n_name, 
        pinnrHash = :pinnrHash, 
        timetouchIdHash = :timetouchIdHash, 
        generalKeyHash = :generalKeyHash, 
        u_name = :u_name, 
        pLevel = :pLevel, 
        requestToken = :requestToken
        ';

        ///////////////////PREPARE STATEMENT
        $stmt = $this->conn->prepare($query);

        ///////////////////CLEAN DATA
        $this->v_name = htmlspecialchars(strip_tags($this->v_name));
        $this->n_name = htmlspecialchars(strip_tags($this->n_name));
        $this->pinnr = htmlspecialchars(strip_tags($this->pinnr));
        $this->pinnrHash = htmlspecialchars(strip_tags($this->pinnrHash));
        $this->timetouchIdHash = htmlspecialchars(strip_tags($this->timetouchIdHash));
        $this->generalKeyHash = htmlspecialchars(strip_tags($this->generalKeyHash));
        $this->u_name = htmlspecialchars(strip_tags($this->u_name));
        $this->pLevel  = htmlspecialchars(strip_tags($this->pLevel ));
        $this->requestToken = hash('sha256',htmlspecialchars(strip_tags($this->generalKeyHash)).time());
        
        ///////////////////BIND DATA
        $stmt->bindParam(':v_name', $this->v_name);
        $stmt->bindParam(':n_name', $this->n_name);
        $stmt->bindParam(':pinnr', $this->pinnr);
        $stmt->bindParam(':pinnrHash', $this->pinnrHash);
        $stmt->bindParam(':timetouchIdHash', $this->timetouchIdHash);
        $stmt->bindParam(':generalKeyHash', $this->generalKeyHash);
        $stmt->bindParam(':u_name', $this->u_name);
        $stmt->bindParam(':pLevel', $this->pLevel);
        $stmt->bindParam(':requestToken', $this->requestToken);

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
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      UPDATE MYDATA METHOD
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updateMyData() {        
        ///////////////////UPDATE MYDATA ON USER
        $NN=htmlspecialchars(strip_tags($this->n_name));
        $UN=htmlspecialchars(strip_tags($this->u_name));
        $NRQ=htmlspecialchars(strip_tags($this->requestToken));
        $query = 'UPDATE 
        mitarbeiter
        SET 
        n_name ="'.$NN.'",
        u_name ="'.$UN.'"
        WHERE 
        requestToken ="'.$NRQ.'" LIMIT 1';
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
    //      UPDATE DATA METHOD
    //      UP TO 4 UPDATE OPTION
    //      QTYPE SWITCHES BETWEEN THE DIFFERENT UPDATE OPTIONS
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updateMitarbeiter() {
            $type=htmlspecialchars(strip_tags($this->qType));
            switch($type){
                case 0:
                    ///////////////////UPDATE N_NAME ON USER
                    $id=htmlspecialchars(strip_tags($this->id));
                    $nname=htmlspecialchars(strip_tags($this->n_name));
                    $RT=htmlspecialchars(strip_tags($this->requestToken));
                    $query = 'UPDATE 
                    mitarbeiter
                    SET 
                    n_name ="'.$nname.'"
                    WHERE 
                    id ="'.$id.'" 
                    AND
                    requestToken="'.$RT.'"';

                    ///////////////////PREPARE STATEMENT
                    $stmt = $this->conn->prepare($query);
                    ///////////////////EXECUTE QUERY
                    if($stmt->execute()) {
                        return true;
                    }else{
                        return false;
                    }
                    break;
                case 1:
                        ///////////////////UPDATE PASSWORD
                        $newPinHash=htmlspecialchars(strip_tags($this->pinnrNew));
                        $Tid=htmlspecialchars(strip_tags($this->timetouchIdHash));
                        $oldGK=htmlspecialchars(strip_tags($this->requestToken));
                        $GK=hash('sha256',$newPinHash.$Tid);
                        $query = 'UPDATE 
                        mitarbeiter
                        SET 
                        pinnrHash ="'.$newPinHash.'",
                        generalKeyHash="'.$GK.'"
                        WHERE 
                        timetouchIdHash ="'.$Tid.'"';
                        ///////////////////PREPARE STATEMENT
                        $stmt = $this->conn->prepare($query);
                        ///////////////////EXECUTE QUERY
                        if($stmt->execute()) {
                            return true;
                        }else{
                            return false;
                        }
                    break;
                case 2:
                    ///////////////////UPDATE U_NAME ON USER
                    $id=htmlspecialchars(strip_tags($this->id));
                    $uname=htmlspecialchars(strip_tags($this->u_name));
                    $RT=htmlspecialchars(strip_tags($this->requestToken));
                    $query = 'UPDATE 
                    mitarbeiter
                    SET 
                    u_name ="'.$uname.'"
                    WHERE 
                    id ="'.$id.'" 
                    AND
                    requestToken="'.$RT.'"';

                    ///////////////////PREPARE STATEMENT
                    $stmt = $this->conn->prepare($query);
                    ///////////////////EXECUTE QUERY
                    if($stmt->execute()) {
                        return true;
                    }else{
                        return false;
                    }
                    break;
                case 3:
                    ///////////////////UPDATE PERMISSION LEVEL ON USER
                    $id=htmlspecialchars(strip_tags($this->id));
                    $pLev=htmlspecialchars(strip_tags($this->pLevel));
                    $RT=htmlspecialchars(strip_tags($this->requestToken));
                    $query = 'UPDATE 
                    mitarbeiter
                    SET 
                    pLevel ="'.$pLev.'"
                    WHERE 
                    id ="'.$id.'" 
                    AND
                    requestToken="'.$RT.'"';

                    ///////////////////PREPARE STATEMENT
                    $stmt = $this->conn->prepare($query);
                    ///////////////////EXECUTE QUERY
                    if($stmt->execute()) {
                        return true;
                    }else{
                        return false;
                    }
                    break;
                case 4:
                    ///////////////////UPDATE SESSIONTOKEN ON USER
                    $id=htmlspecialchars(strip_tags($this->id));
                    $API=htmlspecialchars(strip_tags($this->requestToken));
                    $NRQ=htmlspecialchars(strip_tags($this->pinnrNew));
                    $query = 'UPDATE 
                    mitarbeiter
                    SET 
                    requestToken ="'.$NRQ.'"
                    WHERE 
                    id ="'.$id.'" AND timetouchIDHash="'.$API.'" LIMIT 1';

                    ///////////////////PREPARE STATEMENT
                    $stmt = $this->conn->prepare($query);
                    ///////////////////EXECUTE QUERY
                    if($stmt->execute()) {
                        return true;
                    }else{
                        return false;
                    }
                    break;
                
            default:
            return false;
            break;
        }
        
  }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      DELETE DATA METHOD
    //      ADMIN MUST BE LOGGED IN OTHERWISE NO DELETE POSSIBLE
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function deleteMitarbeiter(){
        $uid=htmlspecialchars(strip_tags($this->id));
        $this->id=htmlspecialchars(strip_tags($this->pinnr));
        ///////////////////SET = TO CHECK IF ADMIN IS LOGGED IN
        $this->qType=0;
        ///////////////////SESSIONTOKEN OF ADMIN
        $ARQ=htmlspecialchars(strip_tags($this->requestToken));
        ///////////////////EXECUTE QUERY ON ADMIN SESSION
        $res=$this->read();
        if($res->rowCount()>0){
        ///////////////////IF SESSION EXISTS PROCEED WITH DELETE
        $query = 'DELETE FROM 
                    mitarbeiter
                    WHERE 
                    id ="'.$uid.'"';
        ///////////////////PREPARE STATEMENT
        $stmt = $this->conn->prepare($query);
        ///////////////////EXECUTE QUERY            
        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
        }else{
            return false;
        }
    }
}
?>