<?php

namespace Multiple\Frontend\Controllers;

use Multiple\PHOClass\PHOController;
use Multiple\Models\Exchange;
use Multiple\Models\Define;
use Multiple\PHOClass\PhoLog;
use Multiple\Library\FilePHP;
class ExchangeController extends PHOController
{
	public function indexAction()
	{		
		$res['webtitle']="Phương thức thanh toán";
		$this->ViewVAR($res);
	}	
	public function payAction()
	{		
		$res['webtitle']="Thanh toán";
		$user = $this->session->get('auth');
		$res['user_name'] = $user->user_name;
		$res['user_mobile']=$user->mobile;
		$this->ViewVAR($res);
	}
	public function sendAction()
	{
		$param =$this->get_param(array('amount'));
		$param['amount'] = str_replace(',','',$param['amount']);
		//PhoLog::debug_var('---param---',$param);
		$param['currency']= 'VND';
		//$param['reference_number']= 'VND';
		//PhoLog::debug_var('---param---',$param);
		$cache = $this->createCache(['lifetime' => 86400 ]); //1 ngay
        $cachekey ="paysend.cache";
        $cdata = $cache->get($cachekey);
        //PhoLog::debug_var('---param---',$param);
        //PhoLog::debug_var('---param---',__LINE__);
        if($cdata == null){
        	$df = new Define();
        	$res = $df->get_list_bygroup_all(1);
        	foreach($res as $row){
				$cdata[$row['define_key']] = $row['define_val'];			
			}
        	//PhoLog::debug_var('---param---',__LINE__);
			$cache->save($cachekey,$cdata);
			//PhoLog::debug_var('---param---',$cdata);
		}
		//PhoLog::debug_var('---param---',__LINE__);
		$user = $this->session->get('auth');
		//PhoLog::debug_var('---param---',__LINE__);
		//PhoLog::debug_var('---param---',$param);
		$param['receiver_account']= $cdata['pay_vtc_account'];		
		$param['website_id']= $cdata['pay_website_id'];		
		$url_checkout = $cdata['pay_url_checkout'].'?';
		$par_ins = $param;
		//PhoLog::debug_var('---param---',__LINE__);
		$par_ins['add_user'] = $user->user_id;
		//PhoLog::debug_var('---param---',$param);
		$db = new Exchange();
		
		$param['reference_number'] = $db->_insert($par_ins);
		$arr_key = array_keys($param);
		
		$param['signature']= implode('|',$arr_key).'|'.$cdata['pay_securitycode'];
		
		$data =array();
		foreach($param as $key =>$val){
			$data[]= $key.'='.$val;
		}
		$url_checkout .= implode('&',$data);
		$this->view->disable();
		
		return $this->response->redirect($url_checkout);
		
	}
	public function loginAction(){
		$this->set_template_share();
	}
	public function activeAction(){
		$param = $this->get_Gparam(array('email','rd'));
		$db = new Users();
		if($db->active($param['email'],$param['rd'])){
			$res['active_msg'] = 'Kích hoạt tài khoản thành công !';
		}else{
			$res['active_msg'] = 'Link kích hoạt tài khoản không đúng !';
		}		
		$this->set_template_share();
		$this->ViewVAR($res);
	}
	public function logoutAction()
	{
		$this->session->set('auth', null);
        return $this->_redirect('dang-nhap');
	}
	
	
	public function updateAction(){
		$param = $this->get_param(array('user_no','user_name','email','mobile','address','pass','sex'));
		$result = array('status' => 'OK');
		$result['status'] = 'OK';	
		$result['msg'] = 'Cập nhật thành công!';		
		$db = new Users();
	
		$msg = $db->get_validation($param);
		
		if($msg === true){
			$db->_insert($param);
			$this->sendmail($db);
		}else{			
			$result = $msg;
			$result['status'] = 'NOT';	
		}
		return $this->ViewJSON($result);
	}
	public function sendmail($usr){
		$email = new Mail();
		
		$body_tmp = $this->get_body($usr);		
		$replacements['HEADER'] = '<h3><strong>Chúc mừng bạn đã đăng kí thành công tài khoản trên Datxanhviet.vn!</strong></h3>';
		$replacements['BODY'] = $body_tmp;
		$db = new Define();
		$data = $db->get_info(DEFINE_KEY_EMAIL);
		//$mail_to[]['mail_address']= $data->define_val;
		$mail_to[]['mail_address']= $usr->email;	
		//ACWLog::debug_var('--mail',$mail_to);	
		//ACWLog::debug_var('--mail',$data);
		$email->AddListAddress($mail_to);
		$email->add_replyto($data->define_val,'datxanhviet.vn');
                
		$email->Subject = 'Đăng ký tài khoản thành công - '.date('d/m/Y H:i:s');                
		$email->loadbody('template_mail.html');
		$email->replaceBody($replacements);
		$result = $email->send();
	}
	public function get_body($usr){
		$url = BASE_URL_NAME."users/active?email=".$usr->email."&rd=".$usr->user_id;
		$html="<p>Dưới đây là thông tin đăng nhập của bạn: </p>
			   <p><strong>Tên đăng nhập:</strong> ".$usr->user_no."</p>
			   <p><strong>Email:</strong> ".$usr->email."</p>
			   <p><strong>Điện thoại:</strong> ".$usr->mobile." </p>
			   <br/>
			   <p>Vui lòng kích vào đường link dưới đây để kích hoạt tài khoản của bạn:</p>
			  <a href='".$url ."'>".$url ."</a> 

			<p>Nếu đường link trên không hoạt động, vui lòng copy đường link đó, rồi paste lên thanh địa chỉ của trình duyệt để link tới trang kích hoạt trên hệ thống. </p>
			<p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>";
		return $html;
	}
	public function updatepassAction(){
		$param = $this->get_param(array('pass_old','pass_new'));
		$result = array('status' => 'OK');
		$result['status'] = 'OK';	
		$result['msg'] = 'Cập nhật thành công!';	
		$user = $this->session->get('auth');	
		$db = new Users();
		if($db->get_user($user->user_no,$param['pass_old']) != FALSE){
			$db->updatepass($user->user_id,$param['pass_old'],$param['pass_new']);			
		}else{
			$result['status'] = 'NOT';	
			$result['msg'] = 'Mật khẩu cũ không đúng!';
		}
				
		return $this->ViewJSON($result);
	}
	public function updateinfoAction(){
		$param = $this->get_param(array('user_name','address','mobile','facebook','skype','sex','avata','folder_tmp'));
		$result = array('status' => 'OK');
		$result['status'] = 'OK';	
		$result['msg'] = 'Cập nhật thành công!';	
		$user = $this->session->get('auth');	
		$db = new Users();
		$param['user_id'] = $user->user_id;
		if(strlen($param['avata'])>0){
			$file = new FilePHP();
			$ext = $file->GetExtensionName($param['avata']);
			if($user->avata != ''){
				$file->DeleteFile(PHO_PUBLIC_PATH.'images/users/'.$user->avata);
			}	
			$file_name = uniqid('',TRUE).'.'.$ext;	
			$file->CopyFile(PHO_PUBLIC_PATH.$param['avata'],PHO_PUBLIC_PATH.'images/users/'.$file_name);
			$file->DeleteFolder(PHO_PUBLIC_PATH.$param['folder_tmp']);
			$param['avata'] =$file_name;
		}
		$db->updateinfo($param);
		$this->_registerSession($db->get_info($user->user_id));
		return $this->ViewJSON($result);
	}
}
