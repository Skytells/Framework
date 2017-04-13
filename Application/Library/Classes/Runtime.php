<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.3
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
  Class Runtime
    {
      public $LoadedControllers = Array();
      public $LoadedModels      = Array();
      public $LoadedHooks       = Array();
      public $LoadedHelpers     = Array();
      public $LoadedEngines     = Array();
      public $LoadedPages       = Array();
      public $cName             = null;

      public function __construct()
       {
         $this->cName = "RunTime";

         $this->getReady();

       }

      public function getReady()
        {
          try
          {
            global $_SESSION;
            $_SESSION["DEV_LOADED_PAGES"] = array();
            $_SESSION["DEV_LOADED_CONTROLLERS"] = array();
            $_SESSION["DEV_LOADED_ENGINES"] = array();
            $_SESSION["DEV_LOADED_MODELS"] = array();
            $_SESSION["DEV_LOADED_HELPERS"] = array();

            if (USE_CACHE == TRUE && isset($_SESSION["DEV_LOADED_PAGES"])){

            $this->LoadedPages = (!isset($this->LoadedPages) || empty($this->LoadedPages) && isset($_SESSION["DEV_LOADED_PAGES"])) ? $_SESSION["DEV_LOADED_PAGES"]
             : $this->LoadedPages;

           }
           if (USE_CACHE == TRUE && isset($_SESSION["DEV_LOADED_ENGINES"])){
             $this->LoadedEngines = (!isset($this->LoadedEngines) || empty($this->LoadedEngines) && isset($_SESSION["DEV_LOADED_ENGINES"])) ? $_SESSION["DEV_LOADED_ENGINES"]
             : $this->LoadedEngines;
           }
           if (USE_CACHE == TRUE && isset($_SESSION["DEV_LOADED_CONTROLLERS"])){
           $this->LoadedControllers = (!isset($this->LoadedControllers) || empty($this->LoadedControllers)) ? $_SESSION["DEV_LOADED_CONTROLLERS"]
           : $this->LoadedControllers;

          }

          } catch (Exception $e) {
            return $e;
          }
        }
      public function getReports($JSON = FALSE)
       {
         try {
           $Reports["Controllers"] = $this->LoadedControllers;
           $Reports["Models"]      = $this->LoadedModels;
           $Reports["Hooks"]       = $this->LoadedHooks;
           $Reports["Pages"]       = $this->LoadedPages;
           $Reports["Helpers"]     = $this->LoadedHelpers;
           $Data = ($JSON == TRUE) ? json_encode($Reports) : $Reports;
           return $Data;
         } catch (Exception $e) {
           $thia->Debugger->ShowError($e->getMessage());
         }

       }

      public function ReportEngine($Engine)
         {
           try
           {
             global $_SESSION; global $_CONSOLE_OUTPUT; global $_DEV_LOADED_LIBRARIES; global $_DEV_LOADED_ENGINES;
             array_push($this->LoadedEngines, $Engine);
             array_push($_DEV_LOADED_ENGINES, $Engine);
             array_push($_CONSOLE_OUTPUT, "Engine Loaded : ". $Engine);
             return true;
           } catch (Exception $e) {
             throw new Exception("Runtime Error : " . $e->getMessage(), 2);
           }

         }
      public function ReportLibrary($Engine)
        {
          try
            {
                global $_SESSION; global $_CONSOLE_OUTPUT; global $_DEV_LOADED_LIBRARIES; global $_DEV_LOADED_ENGINES;

                array_push($_DEV_LOADED_LIBRARIES, $Engine);
                array_push($_CONSOLE_OUTPUT, "Library Loaded : ". $Engine);
                return true;
            } catch (Exception $e) {
                throw new Exception("Runtime Error : " . $e->getMessage(), 2);
            }

        }
      public function ReportController($Controller)
        {
          try
          {
            global $_SESSION; global $_LOADED_CONTROLLERS; global $_CONSOLE_OUTPUT;
            array_push($this->LoadedControllers, $Controller);

            array_push($_LOADED_CONTROLLERS, $Controller);
              array_push($_CONSOLE_OUTPUT, "Controller Loaded : ". $Controller);

            return true;
          } catch (Exception $e) {
            throw new Exception("Runtime Error : " . $e->getMessage(), 2);
          }

        }


      public function ReportModel($Model)
          {
            try
            {
              global $_SESSION; global $_DEV_LOADED_MODELS; global $_CONSOLE_OUTPUT;

              array_push($_DEV_LOADED_MODELS, $Model);
              array_push($_CONSOLE_OUTPUT, "Model Loaded : ". $Model);
              return true;
            } catch (Exception $e) {
              throw new Exception("Runtime Error : " . $e->getMessage(), 2);


            }
          }

      public function ReportHelper($Helper){
        try
        {
          global $_SESSION; global $_DEV_LOADED_HELPERS; global $_CONSOLE_OUTPUT;

          array_push($_DEV_LOADED_HELPERS, $Helper);
          array_push($_CONSOLE_OUTPUT, "Helper Loaded : ". $Helper);
          return true;
        } catch (Exception $e) {
          throw new Exception("Runtime Error : " . $e->getMessage(), 2);
        }
      }
      public function ReportPage($Page)
        {
          try
          {
            global $_SESSION; global $_DEV_LOADED_PAGES; global $_CONSOLE_OUTPUT;
            array_push($this->LoadedPages, $Page);
            array_push($_DEV_LOADED_PAGES, $Page);
            array_push($_CONSOLE_OUTPUT, "UI Loaded : ". $Page);
            return true;
          } catch (Exception $e) {
            throw new Exception("Runtime Error : " . $e->getMessage(), 2);
          }
        }
    }
