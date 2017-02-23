<?php
namespace Plu\Admin;

use Phalcon\Loader,
    Phalcon\Mvc\Application as ApplicationBase,
    Phalcon\DI\FactoryDefault,
    Phalcon\Mvc\View,
    Phalcon\Mvc\View\Engine\Volt,
    Phalcon\Logger\Adapter\File as LoggerEngine,
    Phalcon\Events\Manager as EventsManager,
    Phalcon\Db\Adapter\Pdo\Mysql as MysqlDB, // mysql
    Phalcon\Mvc\Dispatcher,
    Phalcon\Cache\Backend\File as FileCache,
    Phalcon\Cache\Backend\Libmemcached as Memcached,
    Phalcon\Cache\Frontend\Igbinary as FrontCache,
    Phalcon\Mvc\Model\Metadata\Files as FileMetaData,

    Redis as RedisClient; //redis client


define("APP_PATH", __DIR__.DIRECTORY_SEPARATOR);
define("APP_CACHE_PATH", APP_PATH."cache".DIRECTORY_SEPARATOR);
define("PLU_PATH", dirname(dirname(APP_PATH)).DIRECTORY_SEPARATOR);

class Application extends ApplicationBase {
    public static $mode = "dev";

    const MODE_PRODUCTION = "product";
    const MODE_TEST		  = "test";
    const MODE_DEVELOPMENT= "dev";

    /**
     * 网站模式
     */
    const APPTYPE_WEB	 = "web";
    /**
     * 命令行模式
     */
    const APPTYPE_CI	 = "ci";

    private $APP_TYPE = self::APPTYPE_WEB;

    protected $loader;
    protected $di;

    private $appConfigDirectory;
    private $globalConfigDirectory;

    private $eventManager;

    protected function _registerNamespace() {
        $this->loader->registerNamespaces(
            array(
                "Plu\Admin" => APP_PATH,
            )
        );
    }

    public function setApplicationType($type) {
        if ($type == self::APPTYPE_WEB || $type == self::APPTYPE_CI) {
            $this->APP_TYPE = $type;
        }
    }

    public static function getCurrentMode() {
        return self::$mode;
    }

    protected function _registerServices() {
        $config = include $this->appConfigDirectory."config.php";
        if (isset($config['mode'])) {
            self::$mode = $config->mode;
        }

        $this->di['config'] = $config;

        $this->di['dispatcher'] = function() {
            $dispatcher = new Dispatcher();

            //$this->eventManager->attach('dispatch', new HttpResponsePlugin());
            //$this->eventManager->attach('dispatch', new SecurityPlugin());

            //$dispatcher->setEventsManager($this->eventManager);
            //注册默认controller目录
            $dispatcher->setDefaultNamespace('Plu\Admin\Controllers');

            return $dispatcher;
        };

        call_user_func(function(){
            $configs = include $this->appConfigDirectory."mysql.php";
            $configs = $configs[self::$mode];

            foreach ($configs as $name => $_config) {
                $this->di['db.'.$name] = function() use ($_config) {
                    $mysql = new MysqlDB($_config);

                    return $mysql;
                };
            }
        });

        $this->di->set('voltService', function($view, $di) {
            $volt = new Volt($view, $di);

            $volt->setOptions(array(
                'compiledPath' => APP_CACHE_PATH."caches_template".DIRECTORY_SEPARATOR,
                'compiledExtension' => '.compiled',
                'compileAlways' => true
            ));

            $compiler = $volt->getCompiler();
            $compiler->addFilter('array_slice', 'array_slice');
  
            return $volt;
        });

        $this->di->set('view', function() {
            $view = new View();
            $view->setViewsDir(APP_PATH."views");

            $view->registerEngines(array(
                ".html" => 'voltService',
                ".phtml" => 'voltService'
            ));

            return $view;
        }, true);

        
        $self = $this;
        $this->di['router'] = function() use($self) {
            $router = include $self->appConfigDirectory."router.php";

            return $router;
        };

        /**
         * 缓存设定
         */
        $this->di['cache'] = function() {
            //1 days
            $frontCache = new FrontCache(array(
                'lifetime' => 86400
            ));

            return new FileCache($frontCache, array(
                'cacheDir' => APP_CACHE_PATH."caches_data".DIRECTORY_SEPARATOR
            ));
        };

    }

    public function main() {
        date_default_timezone_set('asia/shanghai');
        $this->eventmanager = new EventsManager();

        //声明一些私有变量
        $this->appConfigDirectory = APP_PATH."config".DIRECTORY_SEPARATOR;

        $this->loader = new Loader();
        
        $this->_registerNamespace();
        //注册业务
        $this->di = new FactoryDefault();
        $this->_registerServices();
        $this->loader->register();

        //register di
        $this->setDI($this->di);
        if ($this->APP_TYPE == self::APPTYPE_WEB) {
            return $this->handle()->getContent();
        }
    }
}
