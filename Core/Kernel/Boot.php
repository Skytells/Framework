<?
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.3
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
use Skytells\Core\Runtime;
use Skytells\Core\Console;
use Skytells\Ecosystem\Payload;
use Illuminate\Support\Facades\Facade;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
Class Boot {
  public function __construct($_ROUTER = ''){
      $this->loadModules();
      $this->Powerup();
      $this->BootORM();
    //  Console::log('Framework Bootstrap Initialized');
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
            require APP_CONTROLLERS_DIR.$DEFAULT_CONTROLLER.".php";
            ${APP_INSTANCE} = new Illuminate\Container\Container;
            Facade::setFacadeApplication(${APP_INSTANCE});
            ${APP_INSTANCE}->bind($DEFAULT_CONTROLLER, $CNamespace.$DEFAULT_CONTROLLER);
            $Home = ${APP_INSTANCE}->make($CNamespace.$DEFAULT_CONTROLLER);
            $Home->$DEFAULT_CONTROLLER_METHOD();
            Runtime::Report('Controller', $DEFAULT_CONTROLLER, APP_CONTROLLERS_DIR.$DEFAULT_CONTROLLER.".php");
            unset($Home);
            return true;
            }
          return false;
         }


          if ( !empty($_ctrlName = Payload::getExplosion($_MVURI, 1) ) ){
            if (file_exists(APP_CONTROLLERS_DIR.$_ctrlName.".php")) {
              require APP_CONTROLLERS_DIR.$_ctrlName.".php";
            }
            if (Payload::isClassExist($CNamespace.$_ctrlName)) {

            $ParentClass = get_parent_class($CNamespace.$_ctrlName);
            if ($ParentClass != "Controller") {  show_401(); }
            ${APP_INSTANCE} = new Illuminate\Container\Container;
            Facade::setFacadeApplication(${APP_INSTANCE});
            ${APP_INSTANCE}->bind($_ctrlName, $CNamespace.$_ctrlName);
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
    global $Illuminate, $DBGroups;
     if ($Illuminate['ORM'] === TRUE) {
      $Capsule = new Capsule;
       $Capsule->addConnection([
           'driver'    => $DBGroups[$Illuminate['DATABASE']]['ORM']['illuminatedriver'],
           'host'      => $DBGroups[$Illuminate['DATABASE']]['host'],
           'database'  => $DBGroups[$Illuminate['DATABASE']]['database'],
           'username'  => $DBGroups[$Illuminate['DATABASE']]['username'],
           'password'  => $DBGroups[$Illuminate['DATABASE']]['password'],
           'charset'   => $DBGroups[$Illuminate['DATABASE']]['charset'],
           'collation' => $DBGroups[$Illuminate['DATABASE']]['collation'],
           'prefix'    => $DBGroups[$Illuminate['DATABASE']]['prefix'],
       ]);
       $Capsule->setEventDispatcher(new Illuminate\Events\Dispatcher(new Illuminate\Container\Container));
       $Capsule->setAsGlobal();
       $Capsule->bootEloquent();
     }
     return true;
  }



  public static function Controller($Controller, $method = false, $args = false) {
    $Controller = str_replace('.php', '', $Controller);
    $Name = $Controller;
    require APP_CONTROLLERS_DIR.$Controller.".php";
    ${APP_INSTANCE} = new Illuminate\Container\Container;
    Facade::setFacadeApplication(${APP_INSTANCE});
    ${APP_INSTANCE}->bind($Controller, $Controller);
    ${$Controller} = ${APP_INSTANCE}->make($Controller);
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
