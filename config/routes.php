<?php

$router = new \Phalcon\Mvc\Router(false);

$router->removeExtraSlashes(true);

/**
 * Frontend routes
 */
			$router->setDefaultModule("frontend");
			//fontend
			$router->add('/:controller/:action', array(
				'module' => 'frontend',
				'controller' => 1,
				'action' => 2,
			));
			$router->add('/index/:action', array(
				'module' => 'frontend',
				'controller' => 'index',
				'action' => 1,
			));
			$router->add("/dang-tin", array(
				'module' => 'frontend',
				'controller' => 'posts',
				'action' => 'index'
			));
			$router->add("/dang-tin/:params", array(
				'module' => 'frontend',
				'controller' => 'posts',
				'action' => 'index',
				'params'=>1
			));
			$router->add("/tin-da-dang", array(
				'module' => 'frontend',
				'controller' => 'posts',
				'action' => 'list',
				'params'=>1
			));
			$router->add("/posts/:action/:params", array(
				'module' => 'frontend',
				'controller' => 'posts',
				'action' => 1,  
				'params' =>2            
			));
			$router->add("/dang-tin-thanh-cong/:params", array(
				'module' => 'frontend',
				'controller' => 'posts',
				'action' => 'success',
				'params'=>1
			));
			$router->add("/crop/:params", array(
				'module' => 'frontend',
				'controller' => 'image',
				'action' => 'crop',
				'params'=>1
			));
			$router->add("/dang-ky", array(
				'module' => 'frontend',
				'controller' => 'users',
				'action' => 'register'			
			));
			$router->add("/dang-nhap", array(
				'module' => 'frontend',
				'controller' => 'users',
				'action' => 'login'			
			));
			$router->add("/users/:action", array(
				'module' => 'frontend',
				'controller' => 'users',
				'action' => 1,              
			));
			$router->add("/thanh-vien", array(
				'module' => 'frontend',
				'controller' => 'userinfo',
				'action' => 'index',              
			));
			$router->add("/thanh-vien/:action", array(
				'module' => 'frontend',
				'controller' => 'userinfo',
				'action' => 1,              
			));
			$router->add("/p/:params", array(
				'module' => 'frontend',
				'controller' => 'page',
				'action' => 'index',  
				'params' => 1            
			));
			$router->add("/c/:params", array(
				'module' => 'frontend',
				'controller' => 'category',
				'action' => 'index',  
				'params' => 1            
			));
			$router->add("/tin-moi", array(
				'module' => 'frontend',
				'controller' => 'category',
				'action' => 'index' ,
				'params' => 'allnew'      
			));
			$router->add("/dm/:params", array(
				'module' => 'frontend',
				'controller' => 'category',
				'action' => 'newslist',  
				'params' => 1            
			));
			$router->add("/t/:params", array(
				'module' => 'frontend',
				'controller' => 'news',
				'action' => 'index',  
				'params' => 1            
			));
			$router->add("/b/:params", array(
				'module' => 'frontend',
				'controller' => 'vpost',
				'action' => 'index',  
				'params' => 1            
			));
			$router->add("/tim", array(
				'module' => 'frontend',
				'controller' => 'category',
				'action' => 'search',  
				'params' => 1            
			));
			//backend
			$router->add("/login", array(
				'module' => 'backend',
				'controller' => 'login',
				'action' => 'index',
			));
			$router->add("/loginadm", array(
				'module' => 'backend',
				'controller' => 'loginadm',
				'action' => 'index',
			));
			$router->add("/loginadm/:action", array(
				'module' => 'backend',
				'controller' => 'loginadm',
				'action' => 1,
			));
			$router->add("/admin", array(
				'module' => 'backend',
				'controller' => 'index',
				'action' => 'index',
			));
			$router->add("/slide", array(
				'module' => 'backend',
				'controller' => 'slide',
				'action' => 'index',
			));
			$router->add("/slide/:action/:params", array(
				'module' => 'backend',
				'controller' => 'slide',
				'action' => 1,
				'params'=>2
			));
			$router->add("/product", array(
				'module' => 'backend',
				'controller' => 'product',
				'action' => 'index',
			));
			$router->add("/product/:action/:params", array(
				'module' => 'backend',
				'controller' => 'product',
				'action' => 1,
				'params'=>2
			));
            $router->add("/download", array(
				'module' => 'backend',
				'controller' => 'download',
				'action' => 'index',
			));
			$router->add("/download/:action", array(
				'module' => 'backend',
				'controller' => 'download',
				'action' => 1,
			));
            $router->add("/useradm", array(
				'module' => 'backend',
				'controller' => 'useradm',
				'action' => 'index',
			));
			$router->add("/useradm/:action", array(
				'module' => 'backend',
				'controller' => 'useradm',
				'action' => 1,
			));
			$router->add("/menu", array(
				'module' => 'backend',
				'controller' => 'menu',
				'action' => 'index',
			));
			$router->add("/menu/:action/:params", array(
				'module' => 'backend',
				'controller' => 'menu',
				'action' => 1,
				'params'=>2
			));
			$router->add("/category", array(
				'module' => 'backend',
				'controller' => 'category',
				'action' => 'index',
			));
			$router->add("/category/:action/:params", array(
				'module' => 'backend',
				'controller' => 'category',
				'action' => 1,
				'params'=>2
			));
			$router->add("/news", array(
				'module' => 'backend',
				'controller' => 'news',
				'action' => 'index',
			));
			$router->add("/news/:action/:params", array(
				'module' => 'backend',
				'controller' => 'news',
				'action' => 1,
				'params'=>2
			));
			$router->add("/page", array(
				'module' => 'backend',
				'controller' => 'page',
				'action' => 'index',
			));
			$router->add("/page/:action/:params", array(
				'module' => 'backend',
				'controller' => 'page',
				'action' => 1,
				'params'=>2
			));
			$router->add("/define/:action/:params", array(
				'module' => 'backend',
				'controller' => 'define',
				'action' => 1,
				'params'=>2
			));
			$router->add("/phofile/:action/:params", array(
				'module' => 'backend',
				'controller' => 'phofile',
				'action' => 1,
				'params'=>2
			));
		

			
			/*$router->notFound(array(
				'module' => 'frontend',
			    "controller" => "index",
			    "action" => "route404"
			));*/
			
			return $router;

		

