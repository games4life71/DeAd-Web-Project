<?php

class DbConnection
{

    //this class describes the connection to the database as a singleton
    private static ?DbConnection $instance = null;
    private mysqli $connection;

    private function __construct()
    {
        $config = require '../../config.php';
        $this->connection = new mysqli($config['hostname'], $config['username'], $config['password'],  $config['database']);
        if( $this->connection->connect_errno){
            die('Could not connect to db: ' . $this->connection->connect_error);
        }

    }


    public static function getInstance(): ?DbConnection
    {
        if (self::$instance == null) {
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    private  function __clone()
    {
    }

    private  function __wakeup()
    {
    }



}
