<?php

namespace Multiple\Backend\Controllers;

use Multiple\PHOClass\PHOController;

class IndexController extends PHOController
{

    public function initialize()
    {        
        $this->check_loginadmin();
    }
	public function indexAction()
	{
		$this->set_template_share();
		//return $this->response->forward('login');
       // $this->view->name= 'aaaa';
	}
}
