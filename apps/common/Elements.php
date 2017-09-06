<?php
use Phalcon\Mvc\Url;
use Phalcon\Mvc\User\Component;
use Multiple\Models\Message;
use Multiple\Models\Menu;
use Multiple\Models\News;
use Multiple\Models\Posts;
use Multiple\Models\Define;
use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Frontend\Data as FrontData;
use Multiple\PHOClass\PhoLog;
/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{
	
    private $_adminMenu = array(
        'navbar-left' => array(
            'index' => array(
                'caption' => 'Home',
                'action' => 'index'
            ),           
            'approval' => array(
                'caption' => 'Duyệt bài',
                'action' => ''
            ),
            'download' => array(
                'caption' => 'Download',
                'action' => 'index'
            ),
        ),
        'navbar-right' => array(
            'useradm' => array(
                'caption' => 'Log In/Sign Up',
                'action' => 'login'
            ),
        )
    );

    private $_tabs = array(
        'Invoices' => array(
            'controller' => 'invoices',
            'action' => 'index',
            'any' => false
        ),
        'Companies' => array(
            'controller' => 'companies',
            'action' => 'index',
            'any' => true
        ),
        'Products' => array(
            'controller' => 'products',
            'action' => 'index',
            'any' => true
        ),
        'Product Types' => array(
            'controller' => 'producttypes',
            'action' => 'index',
            'any' => true
        ),
        'Your Profile' => array(
            'controller' => 'invoices',
            'action' => 'profile',
            'any' => false
        )
    );
	public function get_message($screen){
		$db= new Message();
		$msg_lang =$db->get_all('LOGIN');
		return $msg_lang;
	}
    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {
    	$cacheKey = 'menu.cache';
		$menu_data  = $this->dataCache->get($cacheKey);
		if ($menu_data === null) {
			$menu_data ='';
            $db = new Menu();
		    $list_menu = $db->get_menus();
            $url = new Url();
            $url->setBaseUri(BASE_URL_NAME);            
	        $base_url = $url->get('');
            foreach($list_menu as $item){
                if($item['child_flg'] > 0){
	                $menu_data .='<li>';
                    $href = $base_url;
                    
                    if(strlen($item['link'])>0){                        
                        if($item['page_flg']==1){
                            $href .= 'p/';
                        }else if($item['page_flg']==2){
                            $href .= 'c/';
                        }else if($item['page_flg']==3){
                            $href .= 'dm/';
                        }
                         $href .=$item['link'];
                    }else{
                        $href ='#';
                    }
                    $menu_data .='<a href="'.$href.'">'.$item['menu_name'].'</a><ul>';
                            
                    foreach($item['child'] as $sub1){                              
                        if($sub1['child_flg'] > 0){                               
                            $menu_data .='<li>';
                            $href = $base_url;
                            
                            if(strlen($sub1['link'])>0) {                       
                                if($sub1['page_flg']==1){
                                    $href .= 'p/';
                                }else if($sub1['page_flg']==2){
                                    $href .= 'c/';
                                }else if ($sub1['page_flg']==3){
                                    $href .= 'dm/';
                                }
                                 $href .=$sub1['link'];
                            }else{
                               // $href ='#';
                            }
                            $menu_data .='<a href="'.$href.'">'.$sub1['menu_name'].'</a><ul>';
                            foreach($sub1['child'] as $sub2){                            
                                $href = $base_url;                    
                                if(strlen($sub2['link'])>0) {                       
                                    if( $sub2['page_flg']==1){
                                        $href .= 'p/';
                                    }else if( $sub2['page_flg']==2){
                                        $href .= 'c/';
                                    }else if ($sub2['page_flg']==3){
                                        $href .= 'dm/';
                                    }
                                     $href .=$sub2['link'];
                                }else{
                                    //$href ='#';
                                }                
                                $menu_data .='<li><a href="'.$href.'">'.$sub2['menu_name'].'</a></li>';
                            }                   
                            $menu_data .='</ul></li>';
                        }else{                      
                            $href = $base_url;                    
                            if(strlen($sub1['link'])>0) {                       
                                if( $sub1['page_flg']==1){
                                    $href .= 'p/';
                                }else if( $sub1['page_flg']==2){
                                    $href .= 'c/';
                                }else if ($sub1['page_flg']==3){
                                    $href .= 'dm/';
                                }
                                 $href .=$sub1['link'];
                            }else{
                                //$href ='#';
                            }                
                            $menu_data .='<li><a href="'.$href.'">'.$sub1['menu_name'].'</a></li>';
                        }              
                    }               
                    $menu_data .='</ul></li>';
                }else{
                    $href = $base_url;                    
                    if(strlen($item['link'])>0){                        
                        if( $item['page_flg']==1){
                            $href .= 'p/';
                        }else if( $item['page_flg']==2){
                            $href .= 'c/';
                        }else if ($item['page_flg']==3){
                            $href .= 'dm/';
                        }
                        $href .=$item['link'];
                    }else{
                        //$href ='#';
                    }                
                    $menu_data .='<li><a href="'.$href.'">'.$item['menu_name'].'</a></li>';
                }        
	        }
		    // Store it in the cache
		    $this->dataCache->save($cacheKey, $menu_data);
		    
		}
		echo $menu_data;

    }
    public function getMenu_bottom()
    {
    	$cacheKey = 'menu_bottom.cache';
		$menu_data  = $this->dataCache->get($cacheKey);
		if ($menu_data === null) {
			$menu_data ='';
            $db = new Menu();
		    $list_menu = $db->get_menus_bottom();
            $url = new Url();
            $url->setBaseUri(BASE_URL_NAME);            
	        $base_url = $url->get('');
            foreach($list_menu as $item){
                    $href = $base_url;                    
                    if(strlen($item['link'])>0){                        
                        if( $item['page_flg']==1){
                            $href .= 'p/';
                        }else if( $item['page_flg']==2){
                            $href .= 'c/';
                        }else if ($item['page_flg']==3){
                            $href .= 'dm/';
                        }
                        $href .=$item['link'];
                    }else{
                        //$href ='#';
                    }                
                    $menu_data .='<li><a href="'.$href.'">'.$item['menu_name'].'</a></li>';
                        
	        }
		    // Store it in the cache
		    $this->dataCache->save($cacheKey, $menu_data);
		    
		}
		echo $menu_data;

    }
    
    public function getuser(){
        return $this->session->get('auth');
    }	
    /**
     * Returns menu tabs
     */
    public function getTinxemnhieu()
    {    	
        $options = ['lifetime' => 300 ]; // thoi gian tinh bang giay 300:5phut       
        $frontendCache = new FrontData($options);   
        $cache = new BackFile( $frontendCache,  ['cacheDir' => PHO_CACHE_DIR ]);
    	$cacheKey = 'tinxemnhieu.cache';
		$html  = $cache->get($cacheKey);

		if ($html === null) {
            $ne = new News();
            $data = $ne->get_news_pupular(5);	    	
	    	$html = '';
	    	foreach($data as $key=>$item){
				$html .= '<li> <i class="fa fa-circle"></i><a href="'.BASE_URL_NAME.$item['news_no'].'_'.$item['news_id'].'">';
                $html .=$item['news_name'].'</a></li>';
                if ($key < count($data)-1){
                    $html .='<hr class="row_line" />';
                }  
			}
			// Store it in the cache
		    $cache->save($cacheKey, $html);
		}
		echo $html;
    }
    public function getTindacbiet()
    { 
        $options = ['lifetime' => 300 ]; // thoi gian tinh bang giay 
        $frontendCache = new FrontData($options);   
        $cache = new BackFile( $frontendCache,  ['cacheDir' => PHO_CACHE_DIR ]);

        $cacheKey = 'tindatbiet.cache';
        $html  = $cache->get($cacheKey);
        if ($html === null) {
            $db = new Posts();  
            $data = $db->get_list_new(3);      //type sieu vip      
            $html = '';
            foreach($data as $key=>$item){
                $html .= '<div class="vipitem pn_background pn_border">';
                if(strlen($item['img_path'])>0){
                    $html .= '<img src="'.BASE_URL_NAME.'crop/60x50/'.$item['img_path'].'"><div>';
                }else{
                    $html .= '<img src="'.BASE_URL_NAME.'template1/images/post1.png"><div>';
                }
                
                $html .= '<a href="'.BASE_URL_NAME.$item['post_no'].'_'.$item['post_id'].'">'.$item['post_name'].'</a>';
                $html .= '<div style="text-align:right">';
                $html .= '<span class="postprice_right"><strong>'.$item['price'].'</strong>'. $item['m_unit_name'].'</span>';
                $html .= '</div></div></div>';               
            }
            // Store it in the cache
            $cache->save($cacheKey, $html);
        }
        echo $html;
    }
    public function getduannoibac()
    { 
        $options = ['lifetime' => 600 ]; // thoi gian tinh bang giay ,10 phut
        $frontendCache = new FrontData($options);   
        $cache = new BackFile( $frontendCache,  ['cacheDir' => PHO_CACHE_DIR ]);

        $cacheKey = 'duannoibac.cache';
        $html  = $cache->get($cacheKey);
        if ($html === null) {
            $ne = new News();
            $data = $ne->get_news_rows(5,8);    
            $html = '';
            foreach($data as $key=>$item){
                $html .= '<div class="vipitem pn_background pn_border">';
                if(strlen($item['img_path'])>0){
                    $html .= '<img class="duan_img" src="'.BASE_URL_NAME.'crop/104x69/'.$item['img_path'].'"><div>';
                }else{
                    $html .= '<img class="duan_img" src="'.BASE_URL_NAME.'template1/images/post1.png"><div>';
                }
                
                $html .= '<a href="'.BASE_URL_NAME.$item['news_no'].'_'.$item['news_id'].'">'.$item['news_name'].'</a>';
                $html .= '<div>';
                $html .= '<span>'. $item['des'].'</span>';
                $html .= '</div></div></div>';               
            }
            // Store it in the cache
            $cache->save($cacheKey, $html);
        }
        echo $html;
    }
    public function get_define(){
    	$options = ['lifetime' => 24000 ]; // thoi gian tinh bang giay ,400 phut
        $frontendCache = new FrontData($options);   
        $cache = new BackFile( $frontendCache,  ['cacheDir' => PHO_CACHE_DIR ]);

        $cacheKey = 'alldefine.cache';
        $cdata  = $cache->get($cacheKey);
        if($cdata === NULL){
			$model = new Define();
			$res = $model->get_define_all();		
			foreach($res as $row){
				$cdata[$row['define_key']] = $row['define_val'];			
			}
			$cache->save($cacheKey, $cdata);
		}
		//PhoLog::debug_var('---checkdata---',$cdata);		
		return $cdata;
	}
    
    
    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }
    public function formatdate($date,$time=''){
    	$source = $date.' '.$time;
		$date = new DateTime($source);
		echo $date->format('d/m/Y H:i'); 
		//return date_format($date.' '.$time,'d/m/Y H:i');
	}
	function to_slug($str) {
	    $str = trim(mb_strtolower($str));
	    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
	    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
	    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
	    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
	    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
	    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
	    $str = preg_replace('/(đ)/', 'd', $str);
	    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
	    $str = preg_replace('/([\s]+)/', '-', $str);
	    $str = str_replace(array('"',':'), '', $str);
	    return $str;
	}
}
