<?php

class Database
{
    protected static $_dbInstance = null;

    protected $_dbHandle;

    public static function getInstance() {
        $username ='root';
        $password = 'AreoParker';
        $host = '127.0.0.1';
        $dbName = 'BuildEmpire';

        if(self::$_dbInstance === null) { //checks if the PDO exists
            // creates new instance if not, sending in connection info
            self::$_dbInstance = new self($username, $password, $host, $dbName);
        }

        return self::$_dbInstance;
    }

    private function __construct($username, $password, $host, $database) {
        try {
            $this->_dbHandle = new PDO("mysql:host=$host;dbname=$database",  $username, $password); // creates the database handle with connection info
            //$this->_dbHandle = new PDO('mysql:host=' . $host . ';dbname=' . $database,  $username, $password); // creates the database handle with connection info
        }
        catch (PDOException $e) { // catch any failure to connect to the database
            echo $e->getMessage();
        }
    }

    public function getdbConnection() {
        return $this->_dbHandle; // returns the PDO handle to be used elsewhere
    }

    public function __destruct() {
        $this->_dbHandle = null; // destroys the PDO handle when nolonger needed longer needed
    }
}