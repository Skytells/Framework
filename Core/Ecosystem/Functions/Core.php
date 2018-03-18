<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.8
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 function show_404() {
   @header("HTTP/1.0 404 Not Found");
   include ENV_VIEWS_DIR.'/Errors/404.php';
   exit;
 }

 function show_401() {
   @header('HTTP/1.0 401 Unauthorized');
   include ENV_VIEWS_DIR.'/Errors/401.php';
   exit;
 }

 function show_error($Response, $Message = '') {
   if (!isset($Response) || empty($Response))
    throw new \ErrorException("Cannot set the HTTP response with empty headers.", 1);
    switch ($Response) {
      case '404':
        @header("HTTP/1.0 404 Not Found");
        include ENV_VIEWS_DIR.'/Errors/404.php';
        exit;
        break;
      case '401':
        @header('HTTP/1.0 401 Unauthorized');
        include ENV_VIEWS_DIR.'/Errors/401.php';
        exit;
        break;

      case '101':
        @header('HTTP/1.0 401 Unauthorized');
        include ENV_VIEWS_DIR.'/Errors/101.php';
        exit;
        break;
      default:
        global $ENV_ERR_TITLE, $ENV_ERR_MSG;
        $ENV_ERR_TITLE = $Response;
        $ENV_ERR_MSG = $Message;
        include ENV_VIEWS_DIR.'/Errors/msg.php';
        $ENV_ERR_TITLE = null;
        $ENV_ERR_MSG = null;
        exit;
        break;
    }
 }


 function Contains($FullContentString, $strToFind) {
       if (strpos($FullContentString, $strToFind) !== false)
        {
       	 return true;
        } else {
       	  return false;
       	}
  }



 function Base() {

   return HTTP_SERVER_PROTOCOL.SITEBASE;
 }

 function DevTools() {
   if (DEVELOPMENT_MODE === TRUE) { require ENV_UNITS_DIR.'/Devconsole/Console.php'; }
 }


 function getUrl() {
   global $_SERVER;
  $actual_link = HTTP_SERVER_PROTOCOL .$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  return $actual_link;
 }



 function flush_cache() {
   deleteDirectory(APP_STORAGE_DIR.'Cache/');
   @mkdir(APP_STORAGE_DIR.'Cache/');
   @mkdir(APP_STORAGE_DIR.'Cache/FileCache/');
   @mkdir(APP_STORAGE_DIR.'Cache/Views/');
   @mkdir(APP_STORAGE_DIR.'Cache/Sessions/');
   @mkdir(APP_STORAGE_DIR.'Cache/System/');
   @file_put_contents(APP_STORAGE_DIR.'Cache/index.html', '');
   @file_put_contents(APP_STORAGE_DIR.'Cache/FileCache/index.html', '');
   @file_put_contents(APP_STORAGE_DIR.'Cache/Views/index.html', '');
   @file_put_contents(APP_STORAGE_DIR.'Cache/Sessions/index.html', '');
   @file_put_contents(APP_STORAGE_DIR.'Cache/System/index.html', '');
   return true;
 }

 function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
 }

 function log_message($Event, $Message) {
   $file=fopen(APP_STORAGE_LOGS.'Log-'.gmdate(LOG_DT_FORMAT).".log","a+");
    fwrite($file,"[".gmdate(LOG_DT_FORMAT)."] ". $Event.": ".$Message."\n");
    fclose($file);
 }


 function forceSSLCheck() {
   if (FORCE_SSL === TRUE) {
     if (HTTP_SERVER_PROTOCOL === 'http://') {
       Redirect(str_replace('http://', 'https://', getUrl()));
     }
   }
   return true;
 }


 /**
  * getBrowser
  *
  * @return string
  */
 function getBrowser() {
     $browser = "Unknown Browser";
     $browser_array = array(
         '/msie/i'       =>  'Internet Explorer',
         '/firefox/i'    =>  'Firefox',
         '/safari/i'     =>  'Safari',
         '/chrome/i'     =>  'Chrome',
         '/edge/i'       =>  'Edge',
         '/opera/i'      =>  'Opera',
         '/netscape/i'   =>  'Netscape',
         '/maxthon/i'    =>  'Maxthon',
         '/konqueror/i'  =>  'Konqueror',
         '/mobile/i'     =>  'Handheld Browser'
     );
     foreach($browser_array as $regex => $value) {
         if(preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
             $browser = $value;
         }
     }
     return $browser;
 }



 /**
  * getOS
  *
  * @return string
  */
 function getOS() {
     $os_platform = "Unknown OS Platform";
     $os_array = array(
         '/windows nt 10/i'      =>  'Windows 10',
         '/windows nt 6.3/i'     =>  'Windows 8.1',
         '/windows nt 6.2/i'     =>  'Windows 8',
         '/windows nt 6.1/i'     =>  'Windows 7',
         '/windows nt 6.0/i'     =>  'Windows Vista',
         '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
         '/windows nt 5.1/i'     =>  'Windows XP',
         '/windows xp/i'         =>  'Windows XP',
         '/windows nt 5.0/i'     =>  'Windows 2000',
         '/windows me/i'         =>  'Windows ME',
         '/win98/i'              =>  'Windows 98',
         '/win95/i'              =>  'Windows 95',
         '/win16/i'              =>  'Windows 3.11',
         '/macintosh|mac os x/i' =>  'Mac OS X',
         '/mac_powerpc/i'        =>  'Mac OS 9',
         '/linux/i'              =>  'Linux',
         '/ubuntu/i'             =>  'Ubuntu',
         '/iphone/i'             =>  'iPhone',
         '/ipod/i'               =>  'iPod',
         '/ipad/i'               =>  'iPad',
         '/android/i'            =>  'Android',
         '/blackberry/i'         =>  'BlackBerry',
         '/webos/i'              =>  'Mobile'
     );
     foreach($os_array as $regex => $value) {
         if(preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
             $os_platform = $value;
         }
     }
     return $os_platform;
 }


 /**
  * getIP
  *
  * @return string
  */
 function getIP() {
     /* handle CloudFlare IP addresses */
     return (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
 }



 function Redirect($url) {
    @header('Location: '.$url);
    exit;
 }


 function return_json($response = '') {
    header('Content-Type: application/json');
    exit(json_encode($response));
 }


 function toObject($array) {
    $object = new stdClass();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $value = toObject($value);
        }
        $object->$key = $value;
    }
    return $object;
  }




  function getTotalCached()
   {
     $files = glob(APP_STORAGE_DIR.'/Cache/*');
     $i = 0;
     foreach($files as $file){
       if(is_file($file) && !Contains($file, "index.html") && !Contains($file, "log.txt"))
       $i++;
       }
       return $i;
   }
   function detectCurrentLanguage() {

     global $lang;
     if (USE_BUILTIN_PHRASES === FALSE) { return false; }
     $ACTIVELANG = (!isset($_SESSION[LANG_SESID]) || empty($_SESSION[LANG_SESID])) ? DEFAULTLANG : $_SESSION[LANG_SESID];
     if (!file_exists(APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php')) {
       throw new \ErrorException("UI Error: The language file [$ACTIVELANG] used in view cannot be found in dir.", 1);
     }
     // Secure Lang from unwanted strings..
     $ACTIVELANG =  str_replace(array('../', 'http', '//', 'www', '/', '__DIR__', 'dirname', '\\'), '', $ACTIVELANG);
     $lang = include APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php';
     return $lang;
   }


   function free_memory() {
     $vars = array_keys(get_defined_vars());
      for ($i = 0; $i < sizeOf($vars); $i++) {
          unset($$vars[$i]);
      }
      unset($vars,$i);
   }
