<?php

error_reporting(E_ALL);

use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as BaseApplication;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Url;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Logger;
use Phalcon\Cache\Frontend\Output as FrontendCache;
//use Phalcon\Cache\Backend\File as BackendCache;
use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Frontend\Data as FrontData;
//use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Adapter\Pdo\Mysql as Database;
//use Phalcon\Db\Adapter\Pdo\Postgresql as Database;
use Phalcon\Session\Adapter\Files as FileSession;
define('PHO_SALT','pho1$%');

define('PAGE_LIMIT_RECORD',20);
define('PAGE_NEWS_LIMIT_RECORD', 20);

define('IMG_THUMB_SMALL_SIZE_WIDTH',110);
define('DEFINE_KEY_EMAIL','comp_email');

define('APP_PATH', realpath('..') . '/');
define('PHO_PUBLIC_PATH',APP_PATH. 'public/');
define('IMG_DATA_PATH',APP_PATH. 'public/images/');
define('IMG_TMP_PATH',APP_PATH. 'public/tmp/');
define('PHO_LOG_DIR',APP_PATH. 'var/logs/');
define('PHO_CACHE_DIR',APP_PATH. 'var/data/');

define('BASE_URL_NAME', 'http://diaocviet.test/');
date_default_timezone_set("Asia/Ho_Chi_Minh");

//session_start();
class Application extends BaseApplication
{

	/**
	 * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
	 */
	protected function registerServices()
	{

		$di = new FactoryDefault();

		$loader = new Loader();

		/**
		 * We're a registering a set of directories taken from the configuration file
		 */
		$loader->registerDirs(
			array(
				__DIR__ . '/../apps/library/',
				__DIR__ . '/../apps/common/'
			)
		)->register();

		//Registering a router
		$di->set('router', require __DIR__.'/../config/routes.php');
		/*$di->set('router', function(){

			$router = new Router();

			$router->setDefaultModule("frontend");

			$router->add('/:controller/:action', array(
				'module' => 'frontend',
				'controller' => 1,
				'action' => 2,
			));

			$router->add("/login", array(
				'module' => 'backend',
				'controller' => 'login',
				'action' => 'index',
			));

			$router->add("/admin/products/:action", array(
				'module' => 'backend',
				'controller' => 'products',
				'action' => 1,
			));

			$router->add("/products/:action", array(
				'module' => 'frontend',
				'controller' => 'products',
				'action' => 1,
			));

			return $router;

		});*/	
        $di->set('session', function() {
            $session = new FileSession();
            $session->start();
            return $session;
        });	
		$di->set('viewCache', function(){
	        //Cache data for one day by default
	        $frontCache = new FrontendCache(["lifetime" => 86400]);
	        //File backend settings
	        $cache = new BackFile($frontCache, ["cacheDir" => __DIR__."/../var/cache/",]);

	        return $cache;
    	});// thoi gian tinh ban giay
    	$di->set('dataCache', function(){
			$frontCache = new FrontData(array("lifetime" => 1800  ));	// 30 phut	
			$cache = new BackFile($frontCache,   array("cacheDir" => __DIR__."/../var/data/" ));
			return $cache;
		});
		/*$di->set('dispatcher', function (){

        	$eventsManager = new EventsManager;
        	$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);

        	
        	$eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

        	$dispatcher = new Dispatcher;
        	$dispatcher->setEventsManager($eventsManager);

        	return $dispatcher;
        });*/
        
		$di->set('url', function () {
		    $url = new Url();
		    $url->setBaseUri(BASE_URL_NAME);
		    return $url;
		});
		/**
	     * Main logger file
	     */
	    $di->set('logger', function() {
	        return new FileLogger(__DIR__.'/../var/logs/'.date('Y-m-d').'.log');
	    }, true);

	    /**
	     * Error handler
	     */
	    set_error_handler(function($errno, $errstr, $errfile, $errline) use ($di) {
	        if (!(error_reporting() & $errno)) {
	            return;
	        }

	        $di->getFlash()->error($errstr);
	        $di->getLogger()->log($errstr.' '.$errfile.':'.$errline, Logger::ERROR);

	        return true;
	    });

		$di->set('elements', function () {
			return new Elements();
		});
        $di->set('db', function() {
			/*return new Database(array(
				"host" => "localhost",
				"username" => "postgres",
				"password" => "postgres",
				"dbname" => "shopframe",
				"port"=>5432,  
			));*/
			return new Database(array(
				"host" => "localhost",
				"username" => "root",
				"password" => "",
				"dbname" => "diaocviet",
				//"port"=>5432,
                "options" => array( // this is your important part
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                    
                )
                
			));
		});
		/*$di->set('view', function () use ($config) {

        	$view = new View();

        	$view->setViewsDir(APP_PATH . $config->application->viewsDir);

        	$view->registerEngines(array(
            		".volt" => 'volt'
            	));

            	return $view;
        });*/

        /**
         * Setting up volt
         */
        /*$di->set('volt', function ($view, $di) {

        	$volt = new VoltEngine($view, $di);

        	$volt->setOptions(array(
        		"compiledPath" => APP_PATH . "cache/volt/"
        	));

        	$compiler = $volt->getCompiler();
        	$compiler->addFunction('is_a', 'is_a');

        	return $volt;
        }, true);*/        

        /*$di->set('dispatcher', function () {

            // Create an event manager
            $eventsManager = new EventsManager();

            // Attach a listener for type "dispatch"
            $eventsManager->attach("dispatch", function ($event, $dispatcher) {
                // ...
            });

            $dispatcher = new MvcDispatcher();

            // Bind the eventsManager to the view component
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;

        }, true);*/
		
		$this->setDI($di);
	}

	public function main()
	{

		$this->registerServices();

		//Register the installed modules
		$this->registerModules(array(
			'frontend' => array(
				'className' => 'Multiple\Frontend\Module',
				'path' => '../apps/frontend/Module.php'
			),
			'backend' => array(
				'className' => 'Multiple\Backend\Module',
				'path' => '../apps/backend/Module.php'
			)
		));

		echo $this->handle()->getContent();
	}

}

$application = new Application();
$application->main();
