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

class Admin{
    ///////////////////DB
    private $conn;


    ///////////////////SCHEMA
    public $Aid;
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
    public $isAdmin;

    ///////////////////INICIALISE CLASS
    public function __construct($db){
        $this->conn=$db;
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      READ DATA METHOD
    //      CHECK ON FIRST RUN IF ADMIN IS SET
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function isAdminSet(){
        ///////////////////INICIALISE VARIABLES 
        $uid=htmlspecialchars(strip_tags($this->Aid));
        
                ///////////////////CHECK IF LOGGED IN                
                $query= '
                SELECT 
                checkIfSet
                FROM
                isadminset 
                WHERE 
                id="'.$uid.'" 
                LIMIT 1
                ';
                 ///////////////////PREPARE STATEMENT
                 $stmt=$this->conn->prepare($query);
                 ///////////////////EXECUTE QUERY
                 $stmt->execute();
        
        return $stmt;
    }

    
}
?>