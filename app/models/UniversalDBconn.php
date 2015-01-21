<?php

include_once('Idbconn.php');
class UniversalDBconn  implements Idbconn
{

        private static $server=Idbconn::HOST;
	private static $currentDB= Idbconn::DBNAME;
	private static $user= Idbconn::UNAME;
	private static $pass= Idbconn::PW;
	public $connection = null;
	
	public function doConnect()
	{
         
            try{
                $pdo = new PDO("mysql:host=".self::$server.";dbname=".self::$currentDB.",".self::$user,  self::$pass);
                $this->connection = $pdo;
                
            }
            catch (PDOException $e)
            {
                print_r('catch '.$e);
            }
	}

}