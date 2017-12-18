<?
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.0
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
use Skytells\Core;
use Skytells\Core\Runtime;
use Skytells\Core\Console;
use Skytells\Ecosystem\Payload;
Class Boot {
  public function __construct($_ROUTER = ''){
      $this->loadModules();
      $this->Powerup();
      Console::log('Framework Bootstrap Initialized');
  }

  private function loadModules() {
    global $Modules, $Settings;
    if ($Settings['USE_MODULES'] === TRUE) {
      if (!is_dir(ENV_MODULES_DIR)) {throw new \ErrorException("Error Loading Modules: The modules directory cannot be found!", 1);}
        if (is_array($Modules) && count($Modules) > 0) {
          foreach ($Modules as $name => $status) {
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
    global $Routes, $Modules;
    Router::map('GET|POST', "[*:".ROUTER_CONFIG_DEFAULT_ROUTE_PARAM."]",  function($__MVCallback){
      if (isset($__MVCallback) && !empty($__MVCallback) && $__MVCallback != ""){
        $_MVURI = $__MVCallback;
        $HomePage = Payload::getExplosion($_MVURI, 1);
        if (is_null($HomePage) || empty($HomePage)){
          $DEFAULT_CONTROLLER = ROUTER_CONFIG_DEFAULT_CONTROLLER;
          $DEFAULT_CONTROLLER_METHOD = ROUTER_CONFIG_DEFAULT_METHOD;
          if (file_exists(APP_CONTROLLERS_DIR.$DEFAULT_CONTROLLER.".php") ){
            require APP_CONTROLLERS_DIR.$DEFAULT_CONTROLLER.".php";
            $Home = new $DEFAULT_CONTROLLER();
              $Home->$DEFAULT_CONTROLLER_METHOD();
              Runtime::Report('Controller', $DEFAULT_CONTROLLER, APP_CONTROLLERS_DIR.$DEFAULT_CONTROLLER.".php");
              return true;
            }
          return false; }
          if ( !empty($_ctrlName = Payload::getExplosion($_MVURI, 1) ) ){
            if (file_exists(APP_CONTROLLERS_DIR.$_ctrlName.".php")) {
              require APP_CONTROLLERS_DIR.$_ctrlName.".php";
            }
            if (Payload::isClassExist($_ctrlName)) {
            $ParentClass = get_parent_class($_ctrlName);
            if ($ParentClass != "Controller") {  show_401(); }
            $_CTR = new $_ctrlName();
              if ($_funcName = Payload::getExplosion($_MVURI, 2)){  if ( Payload::isFunctionExist($_ctrlName, $_funcName ) ){
                      $this->mvcroute = explode('/', $_MVURI);

                      $arguments = array();
                      foreach ($this->mvcroute as $key => $val)
                        {
                          if ($key != 0 && $key != 1 && $key != 2 && !empty($val))
                            {
                              $arguments[$key] = $val;
                            }
                        }

                        call_user_func_array(array($_CTR, $_funcName), $arguments);
                      }
                  }else{
                    if (ROUTER_CONFIG_INIT_DEFALUT_METHOD_AUTOMATICALLY == true && Payload::isFunctionExist($_ctrlName, ROUTER_CONFIG_DEFAULT_METHOD)){
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


}
