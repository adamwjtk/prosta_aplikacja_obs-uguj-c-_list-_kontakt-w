<?php
require_once 'ConnectionFactory.php';

class ContactCrud
{
    protected $connectionFactory;
    protected $tableContact = "`lista_kontaktow`";
    public $contact_json = array();

    public function __construct(ConnectionFactory $factory = null) {
        if (!$factory) {
            $factory = new ConnectionFactory;
        }
        $this->connectionFactory = $factory;
    }
    
    public function showList()
    {
        $conn = $this->connectionFactory->getConnection();
        $query = $conn->query("SELECT * FROM $this->tableContact");
        $i=0;
            foreach ($query as $row) 
            {
                $push = array('id' =>$row[0],'name'=>$row[1], 'surname' => $row[2],
               'mail'=>$row[3],'phone_num'=>$row[4],'birth_date'=>$row[5]);  
                $this->contact_json[$i++] = $push;
                
            }
        $query->closeCursor();
        return $this->_toJson($this->contact_json);
        
    }
    
    public function addContactRecord($name, $surname, $mail,
            $phone_num, $birth_date)
    {
        $conn = $this->connectionFactory->getConnection();
        $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
        $birth_date = date("Y-m-d", strtotime($birth_date));
        $sql = "INSERT INTO $this->tableContact (`name`, `surname`, `mail`, `phone_num`, `birth_date`)"
                . "VALUES (?,?,?,?,?)";
        try 
        {
            $pdo = $conn->prepare($sql);
            $pdo->bindParam(1, $name, PDO::PARAM_STR,50);
            $pdo->bindParam(2, $surname, PDO::PARAM_STR,80);
            $pdo->bindParam(3, $mail, PDO::PARAM_STR, 150);
            $pdo->bindParam(4, $phone_num, PDO::PARAM_INT);
            $pdo->bindParam(5, $birth_date);

            $isAdded = $pdo->execute();
            
            if($isAdded)
            {
               
               $return = array('OK');
               //'<br>Dodano kontakt:</br> ' .$name.' '.$surname.' '.$mail.' '.$phone_num.' '.$birth_date.'';
            } else
            {
               $return = array('FALSE'); 
            }    
            
            $this->_toJson($return);
            
        } catch (PDOException $exc) 
        {
            exit($exc);
        }
        
    }
    
    protected function _toJson($data)
    {
        header("Content-type: text/javascript");
        //echo json_encode($data, JSON_FORCE_OBJECT);
        exit(json_encode($data, JSON_FORCE_OBJECT));
        //echo json_last_error();
    }
    
}
