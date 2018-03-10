<?
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.7
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
use Skytells\Core\Runtime;
use Skytells\Core\Console;
use Skytells\Ecosystem\Payload;
use Skytells\Support\Facades\Facade;
use Skytells\Events\Dispatcher;
use Skytells\Container\Container;
use Skytells\Database\Capsule\Manager as Capsule;
Class Boot {

  static $App;


  public function __construct($_ROUTER = ''){
      $this->loadModules();
      $this->Powerup();
      $this->BootORM();
    # Console::log('Framework Bootstrap Initialized');
  }



  private function loadModules() {
    global $SF_Modules, $Settings;
    if ($Settings['USE_MODULES'] === TRUE) {
      if (!is_dir(ENV_MODULES_DIR)) {throw new \ErrorException("Error Loading Modules: The modules directory cannot be found!", 1);}
        if (is_array($SF_Modules) && !empty($SF_Modules)) {
          foreach ($SF_Modules as $name => $status) {
            if (!file_exists(ENV_MODULES_DIR.$name.'.php') && $status === TRUE) {
              throw new \ErrorException("Error Loading Module [$name]: The module cannot be found!", 1);
            }elseif ($status === TRUE) {
            require ENV_MODULES_DIR.$name.'.php';
            Runtime::Report('Module', $name, ENV_MODULES_DIR.$name.'.php');
            $name = new $name();
          }
        }
      }
    }
  }

  /**
   * @method Providers.
   * Booting the providers array which required for the app.
   */
  private static function Providers() {
    if (USE_PROVIDERS === FALSE) {
      return Skytells\Foundation::$App;
    }
    global $SF_PROVIDERS;
    if (!empty($SF_PROVIDERS)) {
      foreach ($SF_PROVIDERS as $ProviderName => $ProviderClass) {
        Skytells\Ecosystem\Payload::ResolveProvider($ProviderName, $ProviderClass);
      }
    }
    return Skytells\Foundation::$App;
  }

  /**
   * @method InternalProviders
   * This method loads the internal provider which used by the framework's ecosystem.
   */
  private static function InternalProviders($Container) {

    global $OXCache;
    if ($OXCache['ENABLED'] === TRUE) {
    $Container->singleton('cache', function() use($Container) {
      global $OXCache;
        $container = $Container;
        $driver = $OXCache['config']['cache.default'];
        if ($driver == 'file') {
        $container['config'] = $OXCache['config'];
        $container['files'] = new Skytells\Filesystem\Filesystem;
        }elseif ($driver == 'redis') {
        $container['redis'] = new Skytells\Redis\Database($container['config']['database.redis']);
        }elseif ($driver == 'memcache') {
         $container['memcached.connector'] = new \Skytells\Cache\MemcachedConnector();
        }
        Skytells\Core\Runtime::Report('driver', 'Oxide Cache Driver Globally', 'Autoloader > Skytells/Cache/CacheManager');
        return new Skytells\Cache\CacheManager($container);
      }
      );
    }
    return $Container;
  }


  /**
   * @method Powerup
   * Booting up the Application.
   */
  private function Powerup($Args = array()) {
    global $Routes, $SF_Modules;
    Router::map('GET|POST', "[*:".ROUTER_CONFIG_DEFAULT_ROUTE_PARAM."]",  function($__MVCallback){
      if (isset($__MVCallback) && !empty($__MVCallback) && $__MVCallback != ""){
        $_MVURI = $__MVCallback;
        $CNamespace = (empty(APP_NAMESPACE)) ? '' : APP_NAMESPACE."\\";
        $HomePage = Payload::getExplosion($_MVURI, 1);

        if (is_null($HomePage) || empty($HomePage))
        {
          $DEFAULT_CONTROLLER = ROUTER_CONFIG_DEFAULT_CONTROLLER;
          $DEFAULT_CONTROLLER_METHOD = ROUTER_CONFIG_DEFAULT_METHOD;
          if (file_exists(APP_CONTROLLERS_DIR.$DEFAULT_CONTROLLER.".php") ){
            spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadController']);
            ${APP_INSTANCE} = new Skytells\Container\Container;
            Skytells\Foundation::$App = ${APP_INSTANCE};
            Container::setInstance(Skytells\Foundation::$App);
            Facade::setFacadeApplication(Skytells\Foundation::$App);
            Skytells\Foundation::$App = Boot::InternalProviders(Skytells\Foundation::$App);
            Boot::Providers();
            Skytells\Foundation::$App->bind($DEFAULT_CONTROLLER, $CNamespace.$DEFAULT_CONTROLLER);
            $Home = Skytells\Foundation::$App->make($CNamespace.$DEFAULT_CONTROLLER);
            $Home->$DEFAULT_CONTROLLER_METHOD();
            Runtime::Report('Controller', $DEFAULT_CONTROLLER, APP_CONTROLLERS_DIR.$DEFAULT_CONTROLLER.".php");
            $Home = null;
            return true;
            }
          return false;
         }
          if ( !empty($_ctrlName = Payload::getExplosion($_MVURI, 1) ) ){

            spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadController']);
            if (Payload::isClassExist($CNamespace.$_ctrlName)) {

            $ParentClass = get_parent_class($CNamespace.$_ctrlName);
            if ($ParentClass != "Controller") {  show_401(); }
            ${APP_INSTANCE} = new Skytells\Container\Container;
            Skytells\Foundation::$App = ${APP_INSTANCE};
            Container::setInstance(Skytells\Foundation::$App);
            Facade::setFacadeApplication(Skytells\Foundation::$App);
            Skytells\Foundation::$App = Boot::InternalProviders(Skytells\Foundation::$App);
            Boot::Providers();
            Skytells\Foundation::$App->bind($_ctrlName, $CNamespace.$_ctrlName);
            $_CTR = ${APP_INSTANCE}->make($CNamespace.$_ctrlName);
            if ($_funcName = Payload::getExplosion($_MVURI, 2)){
              if ( Payload::isFunctionExist($CNamespace.$_ctrlName, $_funcName ) ){
              $this->mvcroute = explode('/', $_MVURI);
              $arguments = array();
              foreach ($this->mvcroute as $key => $val) {
                if ($key > 2 && !empty($val)) { $arguments[$key] = $val; } }
                        call_user_func_array(array($_CTR, $_funcName), $arguments);
              }
             }else{
              if (ROUTER_CONFIG_INIT_DEFALUT_METHOD_AUTOMATICALLY == true && Payload::isFunctionExist($CNamespace.$_ctrlName, ROUTER_CONFIG_DEFAULT_METHOD)){
                $DEFAULT_CONTROLLER_METHOD = ROUTER_CONFIG_DEFAULT_METHOD;
                $_CTR->$DEFAULT_CONTROLLER_METHOD();
                }
              }
             Runtime::Report('Controller', $_ctrlName, APP_CONTROLLERS_DIR.$_ctrlName.".php");
            }
          }
      }

    });
  }

  private function BootORM() {
    global $SF_ORM, $DBGroups;
     if ($SF_ORM['ORM'] === TRUE) {
      $Capsule = new Capsule;
      $Capsule->addConnection([
           'driver'    => $DBGroups[$SF_ORM['DATABASE']]['ORM']['driver'],
           'host'      => $DBGroups[$SF_ORM['DATABASE']]['host'],
           'database'  => $DBGroups[$SF_ORM['DATABASE']]['database'],
           'username'  => $DBGroups[$SF_ORM['DATABASE']]['username'],
           'password'  => $DBGroups[$SF_ORM['DATABASE']]['password'],
           'charset'   => $DBGroups[$SF_ORM['DATABASE']]['charset'],
           'collation' => $DBGroups[$SF_ORM['DATABASE']]['collation'],
           'prefix'    => $DBGroups[$SF_ORM['DATABASE']]['prefix'],
       ]);
       $Capsule->setEventDispatcher(new Skytells\Events\Dispatcher(\Skytells\Foundation::$App));
       $Capsule->setAsGlobal();
       $Capsule->bootEloquent();
     }
     return true;
  }


  public static function Controller($Controller, $method = false, $args = false) {
    $Controller = str_replace('.php', '', $Controller);
    $Name = $Controller;
    require APP_CONTROLLERS_DIR.$Controller.".php";
    ${APP_INSTANCE} = new Skytells\Container\Container;
    Skytells\Foundation::$App = ${APP_INSTANCE};
    Container::setInstance(Skytells\Foundation::$App);
    Facade::setFacadeApplication(Skytells\Foundation::$App);
    Skytells\Foundation::$App = Boot::InternalProviders(Skytells\Foundation::$App);
    Boot::Providers();
    Skytells\Foundation::$App->bind($Controller, $Controller);
    ${$Controller} = Skytells\Foundation::$App->make($Controller);
    $m = ($method == false) ? $DEFAULT_CONTROLLER_METHOD : $method;
    if ($args != false) {
      if (is_array($args)) {
        call_user_func_array(array(${$Controller}, $m), $args);
      }else{ ${$Controller}->$m($args); }
    }else {
    $Home->$m();
    }
    Runtime::Report('Controller', $Name, APP_CONTROLLERS_DIR.$Name.".php");
  }

  public static function Migration($File) {
    try {
      if (!is_dir(APP_MIGRATIONS_DIR)) {
        throw new \ErrorException("Eloquent dir is not exists.", 1);
      }
      if (!Contains($File, '.php')){ $File = $File.".php"; }
      $TruePath = APP_MIGRATIONS_DIR.$File;
      if (!file_exists($TruePath)){
        throw new \Exception("Error loading Migration: [$File], The Migration is not found!", 1); }
     $className = Load::getClassNameFromFile($TruePath);
     if (class_exists($className)){ throw new \Exception("Migration: [$File] is already loaded, Cannot load it twice.", 1); }
        require $TruePath;
     Runtime::Report('model', $className, $TruePath);
     return $this;
    } catch (Exception $e) {
      throw new \Exception($e->getMessage(), 1);
    }
  }
}
