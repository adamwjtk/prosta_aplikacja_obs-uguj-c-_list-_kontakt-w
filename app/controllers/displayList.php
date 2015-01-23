<?php

require_once '../app/core/Controller.php';

class DisplayList extends Controller
{
    public function show () 
    {
        $cd = $this->model('Contact_list');
        $cd->showList();
        
      //  $this->view('Contact_list', ['list' => $cd->contact_json ]);
    }
    
    public function add ($name = '', $surname = '', $mail = '',
            $phone_num = '', $birth_date = '')
    {
       $cd = $this->model('Contact_list');
       $cd->addContactRecord($name,$surname,$mail,$phone_num,$birth_date);
       
    }
}
