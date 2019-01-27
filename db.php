<?php


class db {    
    
    private $db_host;
    private $db_user;
    private $db_password;
    private $db_name;
    public $dbh;  // database handler
    
    public function __construct() {
        $this->db_host = DB_HOST;
        $this->db_user = DB_USER;
        $this->db_password = DB_PASS;
        $this->db_name = DB_NAME;

        $this->db_connect();
              
    }
    
    public function db_connect(){
        
        $this->dbh = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);
    }
    
    public function select($query){
        
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows != 0){
            return true;
        }
    }
    
    public function select_data_admin($query){
        
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    }
    
    public function insert($query){

        $stmt = $this->dbh->prepare($query);
        $stmt->execute();

        
    }
    
}
