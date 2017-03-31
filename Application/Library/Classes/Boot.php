<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.2.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */

 /**
  * @param Boot Controller
  * @var This Class Handles the internal routes for the controllers, Functions, and args..
  * @var PLEASE DO NOT TOUCH THIS CLASS
  */
  Class Boot extends Controller
    {

      public function __construct($_ROUTER = ''){
        Router::map('GET|POST', "[*:__MVCallback]",  function($__MVCallback){

          if (isset($__MVCallback) && !empty($__MVCallback) && $__MVCallback != ""){
            $_MVURI = $__MVCallback;
            $HomePage = getExplosion($_MVURI, 1);
            if (!isset($HomePage) || is_null($HomePage) || empty($HomePage)){
              $DEFAULT_CONTROLLER = ROUTES_CONFIG_DEFAULT_CONTROLLER;
              $DEFAULT_CONTROLLER_METHOD = ROUTES_CONFIG_DEFAULT_METHOD;
              if (file_exists(CONTROLLERS_DIR.$DEFAULT_CONTROLLER.".php") ){
                $Home = new $DEFAULT_CONTROLLER();
                  $Home->$DEFAULT_CONTROLLER_METHOD();
                  return false;
              }
              loadPage("index.php");
              return false;
            }



              if ( !empty($_ctrlName = getExplosion($_MVURI, 1) ) ){  /* Check if Exists */ if (isClassExist($_ctrlName)) {
                //  $this->Runtime->ReportController(CONTROLLERS_DIR.$_ctrlName.".php");
                $ParentClass = get_parent_class($_ctrlName);
                if ($ParentClass != "Controller")
                {
                  exit("<h1>Access Denied!</h1>You're not allowed to reach this area without third-party permission!");
                }
                $_CTR = new $_ctrlName(); // Create a new Object for the Controller.
                  if ($_funcName = getExplosion($_MVURI, 2)){ /* Check if Exists */  if ( isFunctionExist($_ctrlName, $_funcName ) ){
                          $this->mvcroute = explode('/', $_MVURI);

                          /*** load arguments for action ***/
                          $arguments = array();
                          foreach ($this->mvcroute as $key => $val)
                            {
                              if ($key != 0 && $key != 1 && $key != 2 && !empty($val))
                                {
                                  $arguments[$key] = $val;
                                }
                            }


                            /*** execute controller action w/ parameters ***/
                            call_user_func_array(array($_CTR, $_funcName), $arguments);
                          }
                      }else{
                        if (ROUTES_CONFIG_INIT_DEFALUT_METHOD_AUTOMATICALLY == true && isFunctionExist($_ctrlName, ROUTES_CONFIG_DEFAULT_METHOD)){
                            $DEFAULT_CONTROLLER_METHOD = ROUTES_CONFIG_DEFAULT_METHOD;
                          $_CTR->$DEFAULT_CONTROLLER_METHOD();
                        }
                      }
                }
              }

          }});
      }
    }
