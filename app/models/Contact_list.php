<?php
require_once 'Idbconn.php';

class Contact_list implements Idbconn
{
    public $contact_json = array();
    private  $server=Idbconn::HOST;
    private  $currentDB= Idbconn::DBNAME;
    private  $user= Idbconn::UNAME;
    private  $pass= Idbconn::PW;
    protected $connection = null;
    protected $tableContact = "`lista_kontaktow`";
    
    public function __construct() 
    {
        try
        {
            $this->connection = new PDO("mysql:host=".$this->server.";dbname=".$this->currentDB, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            
        }
        catch (PDOException $e)
        {
                print_r('catch '.$e);
        }       
    }

    public function showList ()
    {
        try 
        {
            $pdo = $this->connection->query("SELECT * FROM $this->tableContact");
            $i=0;
            foreach ($pdo as $row) 
            {
                $push = array('id' =>$row[0],'name'=>$row[1], 'surname' => $row[2],
               'mail'=>$row[3],'phone_num'=>$row[4],'birth_date'=>$row[5]);  
                $this->contact_json[$i++] = $push;
                
            }
            $pdo->closeCursor();
        } catch (Exception $ex) {
            print_r($ex);
        }
        $this->_toJson($this->contact_json);
    }
    protected function _toJson($data)
    {
        header('Content-type: text/javascript');
        //echo json_encode($data, JSON_FORCE_OBJECT);
        exit(json_encode($data, JSON_FORCE_OBJECT));
        //echo json_last_error();
    }
    public function updateRecord()
    {
        
    }
}