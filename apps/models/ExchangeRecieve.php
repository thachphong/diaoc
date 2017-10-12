<?php

namespace Multiple\Models;

use Multiple\Models\DBModel;
use Multiple\PHOClass\PHOArray;

class ExchangeReceive extends DBModel
{
    public $exchange_receive_id;
    public $data;
    public $signature;
    public $amount;
    public $message;
    public $payment_type;
    public $reference_number;
    public $status;
    public $trans_ref_no;
    public $website_id;
    public function initialize()
    {
        $this->setSource("exchange_receive");
    }        
    public function _insert($param){
		$this->data=$param['data'];
		$this->signature=$param['signature'];
		$this->amount=$param['amount'];
		$this->message=$param['message'];
		$this->payment_type=$param['payment_type'];
		$this->reference_number=$param['reference_number'];
		$this->website_id=$param['website_id'];
		$this->status=$param['status'];
		$this->trans_ref_no=$param['trans_ref_no'];
		$this->save();
	}
	
	
}
