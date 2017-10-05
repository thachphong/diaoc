<?php

namespace Multiple\Models;
use Multiple\Models\DBModel;

class Provincial extends DBModel
{
    public $m_provin_id;
    public $m_provin_name;
  
    public function initialize()
    {
        $this->setSource("m_provincial");
    }
    public static function get_all(){
         //return Provincial::query()->order("m_provin_name")->execute();
         return Provincial::find(['order'=>'sort']);   
    }
}
