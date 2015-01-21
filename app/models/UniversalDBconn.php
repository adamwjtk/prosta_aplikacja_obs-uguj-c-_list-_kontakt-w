<?php

include_once('Idbconn.php');
class UniversalDBconn implements Idbconn 
{

        private static $server=Idbconn::HOST;
	private static $currentDB= Idbconn::DBNAME;
	private static $user= Idbconn::UNAME;
	private static $pass= Idbconn::PW;
	private static $connection;
	
	public function doConnect()
	{
         //   $pdo = new PDO("mysql:host=".self::$server.";dbname=".self::$currentDB.",".self::$user,  self::$pass);
            try{
                self::$connection = new PDO("mysql:host=".self::$server.";dbname=".self::$currentDB.",".self::$user,  self::$pass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
            }
            catch (PDOException $e)
            {
                print_r($e);
            }
            return self::$connection;
	}

}