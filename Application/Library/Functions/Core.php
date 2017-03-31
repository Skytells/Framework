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
  * @method Initializing Required Definetions
  * - Drivers, Controllers, Models ..etc
  */
  function defineRoutesConfig()
  {
     global $Routes;
    foreach ($Routes["CONFIG"] as $Key => $Val) {
      if (!defined("ROUTES_CONFIG_". $Key)) { define("ROUTES_CONFIG_". $Key, $Val); }
    }
  }
  function DefSettings()
     {
       try
       {
         global $Settings;
         global $DBCONFIG;
         global $MODULES;
         global $CORE_ENGINES;

         foreach ($Settings as $Key => $Val)
           {
             if (!defined($Key))
              { define($Key, $Val); }
           }

         foreach ($DBCONFIG as $Key => $Val)
           {
               if (!defined($Key)) { define($Key, $Val); }
           }

         foreach ($MODULES as $Key => $Val)
           {
            if (!defined("MD_". $Key)) { define("MD_". $Key, $Val); }
           }

         foreach ($CORE_ENGINES as $Key => $Val) {
           if (!defined("CORE_ENGINE_". $Key)) { define("CORE_ENGINE_". $Key, $Val); }
         }



       } catch (Exception $e) {
         exit($e->getMessage());
       }

     }
  function getCore()
    {
      return include CL_DIR."Core.php";
    }
  function Obj($array) {

    $object = new stdClass();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $value = Obj($value);
        }
        $object->$key = $value;
    }
    return $object;
  }


  function Contains($FullContentString, $strToFind)
    {
      if (strpos($FullContentString, $strToFind) !== false)
       {
      	 return true;
       } else {
      	  return false;
      	}
    }

  function getTotalCached()
   {
     $files = glob("./".CACHE_DIR.'/*');
     $i = 0;
     foreach($files as $file){
       if(is_file($file) && !Contains($file, "index.html") && !Contains($file, "log.txt"))
       $i++;
       }
       return $i;
   }

  function l($LANG_KEY)
    {
      global $lang;
    //  echo $lang[$LANG_KEY];
      return $lang[$LANG_KEY];
    }

  function lang($LANG_KEY)
    {
      global $lang;
      echo $lang[$LANG_KEY];
    }


  function loadController($File, $args = null, $IsNative = false)
    {
      global $Core;

      $Core->loadController($File, $args, $IsNative);
    }



  function is_dir_empty($dir) {
      if (!is_readable($dir)) return NULL;
      $handle = opendir($dir);
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          return FALSE;
        }
      }
      return TRUE;
    }



    /**
    * @method Initializing Classes
    * - All Classes Stored in ( Classes ) Folder
    */
    function LoadControllers()
      {
        if (!is_dir_empty(CONTROLLERS_DIR)) {
          $files = scandir(CONTROLLERS_DIR);
          foreach($files as $file) {
            if (strpos($file, '.php') !== false)
              {
                include_once CONTROLLERS_DIR.$file;
              }
          }
        }
        }


  /**
  * @method Initializing Functions
  * - All Functions Stored in ( Functions ) Folder
  */
  function LoadFunctions()
    {
      $files = scandir(FN_DIR);
      foreach($files as $file) {
        if (strpos($file, '.php') !== false && strpos($file, 'Core.php') !== true && strpos($file, 'Controller.php') !== true)
            {

            require_once(FN_DIR.$file);
            }
          }

      }

  function base()
    {
      global $Settings;
      if (substr($Settings["BASE_URL"], -1) != "/"){
        return $Settings["BASE_URL"]."/";
      }
      return $Settings["BASE_URL"];
    }

  function t($string, $check = false)
    {
      if ($check == true){
        if (isset($check) && !empty($check) ) { echo $string; } else { echo "{ $string } is not set!"; }
      }else{
          echo $string;
      }

    }

  function d($array, $json = false)
    {
      if ($json == true){
        echo json_encode($array, JSON_PRETTY_PRINT);

      }else {
      var_dump($array); }
    }

  function p_array($array)
      {
        print_r($array);
      }



      /** Check for Magic Quotes and remove them **/

      function stripSlashesDeep($value) {
          $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
          return $value;
      }

      function removeMagicQuotes() {
      if ( get_magic_quotes_gpc() ) {
          $_GET    = stripSlashesDeep($_GET   );
          $_POST   = stripSlashesDeep($_POST  );
          $_COOKIE = stripSlashesDeep($_COOKIE);
      }
      }

      /** Check register globals and remove them **/

      function unregisterGlobals() {
          if (ini_get('register_globals')) {
              $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
              foreach ($array as $value) {
                  foreach ($GLOBALS[$value] as $key => $var) {
                      if ($var === $GLOBALS[$key]) {
                          unset($GLOBALS[$key]);
                      }
                  }
              }
          }
      }
