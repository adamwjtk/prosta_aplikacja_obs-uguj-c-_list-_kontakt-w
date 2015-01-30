<?php
require_once '../app/core/Controller.php';

class Contact extends Controller
{
    
    public function showAll ()
    {
        $handle = $this->model('ContactCrud');
        $handle->showList();
    }
    
    public function addRecord ($name = '', $surname = '', $mail = '',
            $phone_num = '', $birth_date = '')
    {
        $handle = $this->model('ContactCrud');
        $handle->addContactRecord($name, $surname, $mail, $phone_num, $birth_date);
    }
}