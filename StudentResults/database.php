<?php

/*
* Abstruct Class
* Abstruct method connect
* Extended class MySQLConnection
* Database Connections
* Databse crud methods

*/


abstract class DBConnect
{
    protected $host;
    protected $user;
    protected $password;
    protected $database;
    protected $conn;

    public function __construct($host, $user, $password, $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    abstract public function connect();

    public function createTable($tableName, $tableStructure)
    {
        $this->conn = $this->connect();
        $sql = "CREATE TABLE $tableName ($tableStructure)";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}

class MySQLConnection extends DBConnect
{


     // Database connection
    public function connect()
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $connection;
    }
    // Insert a row/s in a Database Table
    public function Insert( $statement = "" , $parameters = [] ){
        try{
            
            $this->executeStatement( $statement , $parameters );
            return $this->connection->lastInsertId();
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }

    // Select a row/s in a Database Table
    public function Select( $statement = "" , $parameters = [] ){
        try{
            
            $stmt = $this->executeStatement( $statement , $parameters );
            return $stmt->fetchAll();
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }
    
    // Update a row/s in a Database Table
    public function Update( $statement = "" , $parameters = [] ){
        try{
            
            $this->executeStatement( $statement , $parameters );
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }		
    
    // Remove a row/s in a Database Table
    public function Remove( $statement = "" , $parameters = [] ){
        try{
            
            $this->executeStatement( $statement , $parameters );
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }		
    
    // execute statement
    private function executeStatement( $statement = "" , $parameters = [] ){
        try{
        
            $stmt = $this->connection->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }




}

// object of database connection
$connection = new MySQLConnection('localhost', 'root', '', 'emoree');

$conn = $connection->connect();