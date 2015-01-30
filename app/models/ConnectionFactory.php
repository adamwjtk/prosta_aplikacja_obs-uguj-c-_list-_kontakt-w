<?php

require_once 'Idbconn.php';

class ConnectionFactory implements Idbconn {
    private  $server=Idbconn::HOST;
    private  $currentDB= Idbconn::DBNAME;
    private  $user= Idbconn::UNAME;
    private  $pass= Idbconn::PW;
    
    public static $connection;
    
    private function __clone()
    {
         
    }
    
    public function getConnection() {
        if (!self::$connection) {
            self::$connection = new PDO("mysql:host=".$this->server.";dbname=".$this->currentDB, $this->user, $this->pass);
            
        }
        return self::$connection;
    }

}