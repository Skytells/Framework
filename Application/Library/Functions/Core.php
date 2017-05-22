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
  /**
  * @method Initializing Required Definetions
  * - Drivers, Controllers, Models ..etc
  */
  if (!function_exists('defineRoutesConfig')) {
  function defineRoutesConfig()
  {
     global $Routes;
    foreach ($Routes["CONFIG"] as $Key => $Val) {
      define("ROUTES_CONFIG_". $Key, $Val);
    }
  }
  }

  if (!function_exists('DefSettings')) {
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
             define($Key, $Val);
           }

         foreach ($DBCONFIG as $Key => $Val)
           {
              define($Key, $Val);
           }

         foreach ($MODULES as $Key => $Val)
           {
            define("MD_". $Key, $Val);
           }

         foreach ($CORE_ENGINES as $Key => $Val) {
          define("CORE_ENGINE_". $Key, $Val);
         }



       } catch (Exception $e) {
         exit($e->getMessage());
       }

     }
  }


  if (!function_exists('Obj')) {
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
  }

  if (!function_exists('Contains')) {
  function Contains($FullContentString, $strToFind)
    {
      if (strpos($FullContentString, $strToFind) !== false)
       {
      	 return true;
       } else {
      	  return false;
      	}
    }
  }

  if (!function_exists('getTotalCached')) {
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
  }

  if (!function_exists('l')) {
  function l($LANG_KEY)
    {
      global $lang;
    //  echo $lang[$LANG_KEY];
      return $lang[$LANG_KEY];
    }
  }

  if (!function_exists('lang')) {
  function lang($LANG_KEY)
    {
      global $lang;
      echo $lang[$LANG_KEY];
    }
  }

  if (!function_exists('loadController')) {
  function loadController($File, $args = null, $IsNative = false)
    {
      global $Core;

      $Core->loadController($File, $args, $IsNative);
    }
  }

  if (!function_exists('is_dir_empty')) {
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
  }

  /**
  * @method Initializing Functions
  * - All Functions Stored in ( Functions ) Folder
  */
  if (!function_exists('LoadFunctions')) {
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
  }

  if (!function_exists('base')) {
  function base($PROTOCOL = TRUE)
    {
      global $Settings;
      if ($PROTOCOL === TRUE) {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        return $protocol.$Settings["BASE_URL"];
      }
      return $Settings["BASE_URL"];
    }
  }

  if (!function_exists('t')) {
  function t($string, $check = false)
    {
      if ($check == true){
        if (isset($check) && !empty($check) ) { echo $string; } else { echo "{ $string } is not set!"; }
      }else{
          echo $string;
      }

    }
  }

  if (!function_exists('d')) {
  function d($array, $json = false)
    {
      if ($json == true){
        echo json_encode($array, JSON_PRETTY_PRINT);

      }else {
      var_dump($array); }
    }
  }

  if (!function_exists('p_array')) {
  function p_array($array)
      {
        print_r($array);
      }
  }


  if (!function_exists('stripSlashesDeep')) {
      /** Check for Magic Quotes and remove them **/

      function stripSlashesDeep($value) {
          $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
          return $value;
      }
    }
  if (!function_exists('removeMagicQuotes')) {
      function removeMagicQuotes() {
      if ( get_magic_quotes_gpc() ) {
          $_GET    = stripSlashesDeep($_GET   );
          $_POST   = stripSlashesDeep($_POST  );
          $_COOKIE = stripSlashesDeep($_COOKIE);
      }
      }
    }
      /** Check register globals and remove them **/
  if (!function_exists('removeMagicQuotes')) {
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
    }
