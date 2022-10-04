<?php
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      DATABASE CLASS - PDO OBJECT 
    //      
    //      @ FUNCTION CONNECT PDO OBJECT IS INICIALISED
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
class Database {
    private $host = 'localhost';
    private $db_name = 'timescreening';
    private $username = 'root';
    private $password = '';
    private $conn;
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      CONNECT METHOD
    //      CREATE THE PDO INSTANCE TO THE DATABASE
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function connect(){
        $this->conn=null;
        try{
            $this->conn= new PDO('mysql:host='.$this->host .';dbname='.$this->db_name,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }catch(PDOException $e){
            echo 'Connection Error:' . $e->getMessage();
        }
        return $this->conn;
    }
}
?>