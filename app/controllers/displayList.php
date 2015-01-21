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
}
