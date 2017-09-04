<?php

namespace Multiple\Models;
use Multiple\Models\DBModel;

class Street extends DBModel
{
    public $m_street_id;
    public $m_street_name;
  	public $m_ward_id;

    public function initialize()
    {
        $this->setSource("m_street");
    }
    public function get_all(){
        return Street::find();
    }
    public function get_bydistrict($m_district_id){
        $sql ="select m_street_id,m_street_name,m_ward_id from m_street where m_district_id=:m_district_id";
        return $this->pho_query($sql,array('m_district_id'=>$m_district_id));
    }
}
