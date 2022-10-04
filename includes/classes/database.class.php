<?php 

class Database
{  
    private $host = "localhost";
    private $username = "root";
    private $password = "root"; 
    private $dbname = "Scandiweb"; 

    public function connect(){
        $conn = new mysqli($this -> host, $this -> username, $this -> password, $this -> dbname);
        return $conn;
    }

}

?>