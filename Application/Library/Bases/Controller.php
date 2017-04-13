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
   Class Controller
    {
      public $_CLASSES;
      public $_CONTROLLERS;
      public $_MODULES;
      public $Mail;
      public $Debugger;
      public $Firewall;
      public $CSRFProtection;
      public $XSSProtection;
      public $Responder;
      public $Controller;
      public $Core;
      public $cName;
      public $Cache;
      public $Runtime;
      public $Loader;
      public $ActiveLanguage = "";
      public $dbConfig;
      public $Viewer;

      public function canClassBeAutloaded($className)
        {
          return class_exists($className);
          }
      /**
      * @method Initializing Controller
      * PLEASE DO NOT TOUCH THIS CONTROLLER.
      */
        public function __construct()
          {
            try
            {

              $this->console = new Console();
              $this->view = new Viewer();
              $this->Runtime = new Runtime();
              $this->load = new Loader();
              $this->dbConfig = array (
                        'host' => DB_HOST,
                        'username' => DB_USER,
                        'password' => DB_PASS,
                        'db'=> DB_NAME,
                        'port' => DB_PORT,
                        'prefix' => DB_PREFIX,
                        'charset' => DB_CHARSET);

              //return $this;
            }
            catch(Exception $e)
            {
              throw new Exception($e->getMessage(), 1);

            }

          }


        public function CheckCoreRequirements()
          {
            if (!extension_loaded('tokenizer')) {
                exit($this->Debugger->ShowException("The PHP extention [ tokenizer ] is not installed on this server<br>Please Install it in order to run this Framework!", "Tokenizer Extention Missing!"));
            }

          }
        public function checkExtentions()
          {

            try {
              if (CHECK_REQM === TRUE) {
              global $_PHP_REQM;
              foreach ($_PHP_REQM as $Key => $Val)
                {

                    if (!extension_loaded(strtolower($Key))) {
                      exit($this->Debugger->ShowException($Val, "PHP Module Missing!"));
                    }
                }
              }
            } catch (Exception $e) {
              return $e;
            }

          }


        /**
        * @method Initializing Framework
        * - Drivers, Controllers, Models ..etc
        */
        public function Init()
          {
            global $_SESSION;
            $this->LoadFunctions();
            $this->InitServices();
            $this->InitModules();
            if(isset($_SESSION['lang']))
              {
              $this->ActiveLanguage = $_SESSION['lang'];
              }
            if (empty($this->ActiveLanguage)) {
                $this->AnalyzeLangugage();
            }
            return true;
          }



        /**
        * @method Init Required Drivers
        * - Drivers, Controllers, Models ..etc
        */
        public function InitRequiredDrivers()
          {
            try {

            } catch (Exception $e) {
             exit($this->Debugger->ShowError($e->getCode(), $e->getMessage()));
           }


          }

        /**
        * @method Initializing Services
        * - Please do not touch below this line.
        */
        public function InitServices()
          {


              $this->Debugger = new Debugger();


                $this->CheckCoreRequirements();
                $this->checkExtentions();

              $this->Mail = new Mail();

              $this->Encryption = new Encryption(ENC_METHOD, ENC_KEY, ENC_IV, ENC_SALT);

              $this->Cache = new Cache();


          }

        /**
        * @method Initializing Modules
        * - Please do not touch below this line.
        */
        public function InitModules()
          {
            try
             {
              if (MD_Firewall === TRUE) {
                  Firewall::Run(); }
              if (MD_XSSProtection) {
                $this->XSSProtection = new XSSProtection(); }

              if (MD_CSRFProtection) {
                $this->CSRFProtection = new CSRFProtection(); }

            } catch (Exception $e) {
              return $e;
            }

          }

        /**
        * @method Load Modules
        * - Please do not touch below this line.
        */
        public function LoadModules()
          {
            if (USE_MODULES === TRUE)
            {
              if (!is_dir(MD_DIR)){
                throw new Exception("The Modules Folder does not exist in the main Application/Library dir.", 90);
                return false;
              }
              $files = scandir(MD_DIR);
              global $MODULES;
              foreach ($MODULES as $Key => $Val)
                {
                    if ($MODULES[$Key] == TRUE)
                      {
                        require MD_DIR.$Key.".php";
                      }

                }
            }
          }

        /**
        * @method Initializing Functions
        * - All Functions Stored in ( Functions ) Folder
        */
        public function LoadFunctions()
          {
           if (!is_dir(FN_DIR)){
                   throw new Exception("The Functions Folder does not exist in the main Application/Library dir.", 90);
                   return false;
                 }
              foreach (new DirectoryIterator(FN_DIR) as $fileInfo) {
                if($fileInfo->isDot()) continue;
                $file = $fileInfo->getFilename();
                require FN_DIR."/".$file;
            }
          }

        /**
        * @method Initializing Classes
        * - All Classes Stored in ( Classes ) Folder
        */
        public function LoadClasses()
          {
            if (!is_dir(CL_DIR)){
              throw new Exception("The Classes Folder does not exist in the main Application/Library dir.", 90);
              return false;
            }
            $files = scandir(CL_DIR);
            foreach($files as $file) {

                  $class_name = str_replace(".php", "", $file);

                  if (!class_exists($class_name)){
                  set_include_path(CL_DIR);
                  spl_autoload_extensions('.php');
                  spl_autoload($class_name);

                  //include_once(CL_DIR.$file);

                }
            }


          }
        /**
        * @method Initializing Controllers
        * - All Controllers Stored in ( Controller ) Folder
        */
        public function LoadControllers($Excluded = array(""))
          {
              $path = BASEPATH.'/Application/Resources/Controllers/';
              if (!is_dir($path)){
                throw new Exception("The Controllers Folder does not exist in the main Application dir.", 90);
                return false;
              }
              $files = scandir($path);
              foreach($files as $file) {
                if (strpos($file, '.php') !== false)
                  {
                    $class_name = str_replace(".php", "", $file);
                    if (!in_array(strtolower($file), $Excluded) && !class_exists($class_name)){
                    set_include_path($path);
                    spl_autoload_extensions('.php');
                    spl_autoload($class_name);
                    $this->Runtime->ReportController($path.$file);
                  }
                    //include_once(CL_DIR.$file);

                  }
              }
            }

        /**
        * @method Initializing Models
        * - All Models Stored in ( Models ) Folder
        */
        public function LoadModels($Excluded = array(""))
          {
            $path = BASEPATH.'/Application/Resources/Models/';
            if (!is_dir($path)){
              throw new Exception("The Models Folder does not exist in the main Application dir.", 90);
              return false;
            }
            $files = scandir($path);
            foreach($files as $file) {
              if (strpos($file, '.php') !== false)
                {
                  $class_name = str_replace(".php", "", $file);
                  if (!in_array(strtolower($file), $Excluded) && !class_exists($class_name)){
                  set_include_path($path);
                  spl_autoload_extensions('.php');
                  spl_autoload($class_name);
                  $this->Runtime->ReportModel($path.$file);
                }
                  //include_once(CL_DIR.$file);

                }
            }
          }



        /**
        * @method Initializing Framework
        * - Drivers, Controllers, Models ..etc
        */
        public function DefSettings()
          {
            try
            {
              DefSettings();
            } catch (Exception $e) {
              exit($this->Debugger->ShowException($e->getMessage()));
            }

          }

        public function loadController($File, $args = null, $Native = false)
          {
            try
            {
                  $path = BASEPATH.'/Application/Resources/Controllers/';
              if (!file_exists($path."$File.php"))
                {
                  exit($this->Debugger->ShowError("90", "Unable to load the Controller [$File] from [".CONTROLLERS_DIR."]"));
                }
                if (!class_exists($File) == true) {


                require($path."$File.php");
                $this->RegController($path."$File.php", $args, $Native);
                $this->Runtime->ReportController($path."$File.php");

                }
            }catch(Exception $e)
              {
                exit ($this->Debugger->ShowException($e->getMessage()));
              }
          }
        public function View($File)
          {
            try
            {
              include_once(VW_DIR.$File);
            }
            catch(Exception $e)
            {
              $this->Debugger->ShowException($e->getMessage());
            }
          }

        public function getClassName() {
          return get_called_class();
          }

        public function createObject($name, $value, $args = null, $IsNative = false) {
            try {
              // Dynamically create the variable.
              if ($args != null && !empty($args))
              {
                if ($IsNative == true) {
                    self::$name = new $value($args);
                }else
                {

                    $this->{$name} = new $value();
                }


              }

              else{
                if ($IsNative == true) {
                  self::$name = new $value();
                }else{
                    $this->{$name} = new $value();
                }

              }
            } catch (Exception $e) {
              exit($this->Debugger->ShowError($e->getCode(), $e->getMessage()));
            }

          }
        public function RegController($class_name, $args = null, $Native = false)
          {
            try
             {

                  if ($args != null)
                  {
                     $this->createObject($this->load->getClassNameFromFile($class_name), $this->load->getClassNameFromFile($class_name), $args, $Native);
                  }else{
                     $this->createObject($this->load->getClassNameFromFile($class_name), $this->load->getClassNameFromFile($class_name), null, $Native);
                  }

               return true;

             } catch (Exception $e) {
              exit($this->Debugger->ShowError($e->getCode(), $e->getMessage()));
            }
          }


        /**
        * @method Initializing Languages
        * - It's important to analyze languages before viewing the pages.
        */
        public function AnalyzeLangugage()
          {
            if(Get("lang"))
              {
              $lang = Get("lang");
              // register the session and set the cookie
              $_SESSION['lang'] = $lang;
              setcookie('lang', $lang, time() + (3600 * 24 * 30));
              }
              else if(isset($_SESSION['lang']))
              {
              $lang = $_SESSION['lang'];
              }
              else if(isset($_COOKIE['lang']))
              {
              $lang = $_COOKIE['lang'];
              }
              else
              {
              $lang = 'en';
              }
              switch ($lang) {
              case 'en':

              $lang_file = LANG_DIR.'en.php';
              $this->ActiveLanguage = "English";
              break;

              case 'es':
              $lang_file = LANG_DIR.'es.php';
              $this->ActiveLanguage = "Spanish";
              break;

              case 'fr':
              $lang_file = LANG_DIR.'fr.php';
              $this->ActiveLanguage = "French";
              break;

              case 'ar':
              $lang_file = LANG_DIR.'ar.php';
              $this->ActiveLanguage = "Arabic";
              break;

              case 'de':
              $lang_file = LANG_DIR.'de.php';
              $this->ActiveLanguage = "German";
              break;


              default:
              $lang_file = LANG_DIR.'en.php';
              $this->ActiveLanguage = "English";
              }
              include_once $lang_file;
              if (!isset($_COOKIE["active_lang"]) || empty($_COOKIE["active_lang"])) {
              setcookie('active_lang', $this->ActiveLanguage, time() + (3600 * 24 * 30), BASEPATH);
            }
          }



        /**
        * @method Initializing Framework Engines
        * - Please DO NOT TOUCH These Functions
        */
        public function InitiCoreEngines()
          {
            try {
              global $CORE_ENGINES;
              foreach ($CORE_ENGINES as $Key => $Val)
                {

                    if ($CORE_ENGINES[$Key] == TRUE)
                      {
                        $this->LoadEngine($Key.".php");
                      }
                }
                return true;
            } catch (Exception $e) {
              exit($this->Debugger->ShowError($e->getCode(), $e->getMessage()));
            }

           }


        /**
        * @method Initializing Advanced SQLManager
        * - For Building SQL Queries..
        */
        public function InitiSQLManager() {
          try {
            global $db; global $_ADVANCED_DB;
            $realPath = ENGINES_DIR.'Databases/SQLManager.php';
            if (!file_exists($realPath))
             {
               exit($this->Debugger->ShowError("#Internal",  'Engine : '.$realPath. ' Is Not Found!'));

             }
            include_once $realPath;

            $this->RegController($realPath, $db);
            return true;
          } catch (Exception $e) {
              return $this->Debugger->ShowError($e->getCode(), $e->getMessage());
          }

        }

        /**
        * @method Initializing Advanced DBObject
        * - For Building SQL Queries..
        */
        public function InitiDBObject() {
          try {
            global $db;
            $realPath = ENGINES_DIR.'Databases/DBObject.php';
            if (!file_exists($realPath))
             {
               exit($this->Debugger->ShowError("#Internal",  'Engine : '.$realPath. ' Is Not Found!'));

             }
            include_once $realPath;
            $this->RegController($realPath, $db);
            return true;
          } catch (Exception $e) {
              return $this->Debugger->ShowError($e->getCode(), $e->getMessage());
          }

        }

        /**
        * @method Initializing a Single Engine
        * - Engines must be stored in Engines folder.
        */
        public function LoadEngine($Path, $args = null)
         {
           try
            {
             $realPath = ENGINES_DIR.$Path;
             if (!file_exists($realPath))
              {
                exit($this->Debugger->ShowError("#Internal",  'Engine : '.$realPath. ' Is Not Found!'));

              }else
              {
                include $realPath;
                global $db;
                if (Contains($Path, "/SQLManager")){
                  $this->InitiSQLManager();
                  return true;
                }else if (Contains($Path, "/DBObject")){
                  $this->InitiDBObject();
                  return true;
                }
                $Reg = ($args = null) ? $this->RegController($realPath) : $this->RegController($realPath, $args);
                if ($Reg){
                  $this->Runtime->ReportEngine($realPath);
                }
              }
            } catch (Exception $e) {
             exit($this->Debugger->ShowError($e->getCode(), $e->getMessage()));
           }

         }



        /**
        * @method Loading a Page from Viewers
        * - Pages must be stored in sub-folder in Views.
        */
        public function loadPage($File, $Params = "")
           {
             try
             {

               $this->view->render($File, false, $Params);
             }
             catch(Exception $e)
             {
               $this->Debugger->ShowException($e->getMessage());
             }
           }



        public function accessFirewall($owner, $Name = "Firewall")
          {
            try {
              if (!isset($owner)){
                throw new Exception("Error Processing Request: You have to assgin the owner as a parameter in order to access firewall.", 1);

              }
              $owner->$Name = $this->Firewall;
              return $this->Firewall;
            } catch (Exception $e) {
              throw new Exception($e->getMessage(), 1);

            }

          }


          function __destruct() { }
    }
