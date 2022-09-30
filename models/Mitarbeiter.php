<?php
class Mitarbeiter{
    //DB
    private $conn;
    private $table='mitarbeiter';

    //Table Schema
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
    //initiate Class Model
    public function __construct($db){
        $this->conn=$db;
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function read(){
        
        $uid=htmlspecialchars(strip_tags($this->id));
        $type=htmlspecialchars(strip_tags($this->qType));
        $API=htmlspecialchars(strip_tags($this->requestToken));
        
        switch($type){
            case 0:
                //CheckifLoggedIn                
                $query= '
                SELECT 
                requestToken
                FROM
                ' .$this->table.' 
                WHERE 
                id="'.$uid.'" AND requestToken = "'.$API.'" 
                LIMIT 1
                ';
                 //Prepare stmt
                 $stmt=$this->conn->prepare($query);
                 $stmt->execute();
        
                break;
            case 1:
                //Login with Pin and Pass
                $gKey=hash('sha256',$API.$uid);
                $query= '
                SELECT 
                id,
                v_name,
                n_name,
                u_name,
                pLevel
                FROM
                ' .$this->table.' 
                WHERE 
                generalKeyHash="'.$gKey.'" 
                LIMIT 1
                ';
                 //Prepare stmt
                 $stmt=$this->conn->prepare($query);
                 $stmt->execute();        
                break;
            case 2:
                //Select Mitarbeiter on V_Name
                $query= 'SELECT 
                id,
                v_name,
                u_name 
                FROM
                ' .$this->table.' 
                WHERE 
                v_name LIKE "%'.$uid.'%" ';
                 //Prepare stmt
                 $stmt=$this->conn->prepare($query);
                 $stmt->execute();        
                break;
            case 3:
                //Select Mitarbeiter on Permission Level
                $query= 'SELECT 
                id,
                v_name,
                n_name,
                u_name,
                pLevel 
                FROM
                ' .$this->table.' 
                WHERE
                pLevel="'.$uid.'" ';
                 //Prepare stmt
                 $stmt=$this->conn->prepare($query);
                 $stmt->execute(); 
                break;
            case 4:
                //Select U_Name on ID
                $query= 'SELECT
                id, 
                u_name
                FROM
                ' .$this->table.' 
                WHERE
                id="'.$uid.'" ';
                 //Prepare stmt
                 $stmt=$this->conn->prepare($query);
                 $stmt->execute(); 
                break;
            case 5:
                //Login GKey
                $query= 'SELECT 
                generalKeyHash
                FROM
                ' .$this->table.' 
                WHERE 
                generalKeyHash="'.$API.'" ';
                 //Prepare stmt
                 $stmt=$this->conn->prepare($query);
                 $stmt->execute(); 
                break;
            case 6:
                //Select full Data on Mitarbeiter
                $query= 'SELECT
                generalKeyHash
                FROM
                ' .$this->table.' 
                WHERE 
                generalKeyHash="'.$API.'"
                AND
                id="'.$uid.'" LIMIT 1 ';
                 //Prepare stmt
                 $stmt=$this->conn->prepare($query);
                 $stmt->execute(); 
                break;
            default:
                $query= 'SELECT 
                v_name,
                n_name,
                pinnr,
                pinnrHash,
                timetouchId,
                timetouchIdHash,
                generalKeyHash,
                u_name,
                pLevel 
                FROM
                ' .$this->table.' WHERE id=:id';
                 //Prepare stmt
        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(':id', $uid);
        $stmt->bindParam(':API', $API);
            break;
        }
               
        
        return $stmt;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      INSERT DATA
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createMitarbeiter() {
        // Create query
        $query = 'INSERT INTO 
        ' . $this->table . ' 
        SET 
        v_name = :v_name, 
        n_name = :n_name, 
        pinnr = :pinnr, 
        pinnrHash = :pinnrHash, 
        timetouchIdHash = :timetouchIdHash, 
        generalKeyHash = :generalKeyHash, 
        u_name = :u_name, 
        pLevel = :pLevel, 
        requestToken = :requestToken
        ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->v_name = htmlspecialchars(strip_tags($this->v_name));
        $this->n_name = htmlspecialchars(strip_tags($this->n_name));
        $this->pinnr = htmlspecialchars(strip_tags($this->pinnr));
        $this->pinnrHash = htmlspecialchars(strip_tags($this->pinnrHash));
        $this->timetouchIdHash = htmlspecialchars(strip_tags($this->timetouchIdHash));
        $this->generalKeyHash = htmlspecialchars(strip_tags($this->generalKeyHash));
        $this->u_name = htmlspecialchars(strip_tags($this->u_name));
        $this->pLevel  = htmlspecialchars(strip_tags($this->pLevel ));
        $this->requestToken = hash('sha256',htmlspecialchars(strip_tags($this->generalKeyHash)).time());
        
        // Bind data
        $stmt->bindParam(':v_name', $this->v_name);
        $stmt->bindParam(':n_name', $this->n_name);
        $stmt->bindParam(':pinnr', $this->pinnr);
        $stmt->bindParam(':pinnrHash', $this->pinnrHash);
        $stmt->bindParam(':timetouchIdHash', $this->timetouchIdHash);
        $stmt->bindParam(':generalKeyHash', $this->generalKeyHash);
        $stmt->bindParam(':u_name', $this->u_name);
        $stmt->bindParam(':pLevel', $this->pLevel);
        $stmt->bindParam(':requestToken', $this->requestToken);

        // Execute query
        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }     
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      UPDATE DATA
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updateMitarbeiter() {
            $type=htmlspecialchars(strip_tags($this->qType));
            switch($type){
                case 0:
                    //Update Person details N-name
                    $id=htmlspecialchars(strip_tags($this->id));
                    $nname=htmlspecialchars(strip_tags($this->n_name));
                    $RT=htmlspecialchars(strip_tags($this->requestToken));
                    $query = 'UPDATE 
                    ' . $this->table . '
                    SET 
                    n_name ="'.$nname.'"
                    WHERE 
                    id ="'.$id.'" 
                    AND
                    requestToken="'.$RT.'"';

                    // Prepare statement
                    $stmt = $this->conn->prepare($query);
                    
                    if($stmt->execute()) {
                        return true;
                    }else{
                        return false;
                    }
                break;
            case 1:
                    //Update Person details Passwort
                    $id=htmlspecialchars(strip_tags($this->id));
                    $oldPin=hash('sha256',htmlspecialchars(strip_tags($this->pinnr)));
                    $newPin=htmlspecialchars(strip_tags($this->pinnrNew));
                    $newPinHash=hash('sha256',htmlspecialchars(strip_tags($this->pinnrNew)));
                    $Tid=hash('sha256',htmlspecialchars(strip_tags($this->timetouchIdHash)));
                    $oldGK=hash('sha256',$oldPin.$Tid);
                    $GK=hash('sha256',$newPin.$Tid);
                    $RT=htmlspecialchars(strip_tags($this->requestToken));
                    $query = 'UPDATE 
                    ' . $this->table . '
                    SET 
                    pinnr ="'.$newPin.'",
                    pinnrHash ="'.$newPinHash.'",
                    generalKeyHash="'.$GK.'"
                    WHERE 
                    id ="'.$id.'" 
                    AND
                    generalKeyHash="'.$oldGK.'"';
                    // Prepare statement
                    $stmt = $this->conn->prepare($query);
                    
                    if($stmt->execute()) {
                        return true;
                    }else{
                        return false;
                    }
                break;
            case 2:
                //Update Person details U-name
                break;
            case 3:
                //Update Person details generalKeyHash
                break;
            case 4:
                //Update Person details pLevel
                break;
            case 5:
                //Update Person details requestToken
                break;
            default:
            break;
        }
        
  }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      DELETE DATA
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>