<?php

include_once 'UniversalDBconn.php';

class Contact_list 
{
    public $contact_json;
    private $mysql_conn;
    
    public function __construct()
    {
        $this->mysql_conn = UniversalDBconn::doConnect();
        var_dump($this->mysql_conn);
        $this->contact_json = "\n test message";
    }
}