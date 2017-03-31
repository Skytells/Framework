<?php
Class Cache extends Controller {
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
    // Pages you do not want to Cache:
    var $doNotCache = array("admin","profile");

    // General Config Vars
    var $cacheDir = "./cache";
    var $cacheTime = 21600;
    var $caching = false;
    var $cacheFile;
    var $cacheFileName;
    var $cacheLogFile;
    var $cacheLog;



    function __construct(){
        global $CH_EXCLUSION;
        $this->doNotCache = $CH_EXCLUSION;
        $this->cacheDir = "./".CACHE_DIR;
        $this->cacheTime = CACHE_TIME;
        if (USE_CACHE == TRUE)
          {

            $this->cacheFile = md5($_SERVER['REQUEST_URI']);
            $this->cacheFileName = $this->cacheDir.'/'.$this->cacheFile;
            $this->cacheLogFile = $this->cacheDir."/log.txt";
            if(!is_dir($this->cacheDir)) mkdir($this->cacheDir, 0755);
            if(file_exists($this->cacheLogFile))
                $this->cacheLog = unserialize(file_get_contents($this->cacheLogFile));
            else
                $this->cacheLog = array();
          }
    }

    function Flush()
      {
        $files = glob($this->cacheDir.'/*');
        foreach($files as $file){
          if(is_file($file) && !Contains($file, "index.html") && !Contains($file, ".htaccess"))
            unlink($file);
          }
          $files = glob($this->cacheDir.'/Views/*');
          foreach($files as $file){
            if(is_file($file) && !Contains($file, "index.html") && !Contains($file, ".htaccess"))
              unlink($file);
            }
      }
    function Start(){
        if (USE_CACHE == TRUE)
          {
              if (Get("Action") == "FlushCache") { $this->Flush(); $this->caching = false; return true; }
              else{

            $location = array_slice(explode('/',$_SERVER['REQUEST_URI']), 2);
            if(!in_array($location[0],$this->doNotCache)){
                if(file_exists($this->cacheFileName) && (time() - filemtime($this->cacheFileName)) < $this->cacheTime && $this->cacheLog[$this->cacheFile] == 1){
                    $this->caching = false;

                    echo file_get_contents($this->cacheFileName);

                  if (DEVELOPMENT_MODE == TRUE) { require_once(SYS_VIEWS."/php/DevTools.php"); }
                    exit();
                }else{
                    $this->caching = true;
                    //@ob_start();
                }
            }
          }
        }
    }

    function End(){
        if (USE_CACHE == TRUE)
          {
            if (!Get("Action") == "FlushCache") {
            if($this->caching){
              $_CPAGE = ob_get_contents();
              if (Contains($_CPAGE, "{CACHE:EXCLUDE!}") || Contains($_CPAGE, "<meta content='no-cache'") || Contains($_CPAGE, '<meta content="no-cache"'))
                { return true; }
              if (Contains($_CPAGE, "{CACHE:FLUSH!}"))  { return $this->Flush(); }
                file_put_contents($this->cacheFileName, $_CPAGE);
                ob_end_flush();
                $this->cacheLog[$this->cacheFile] = 1;
                if(file_put_contents($this->cacheLogFile,serialize($this->cacheLog)))
                    return true;
            }
          }
          }
    }

    function purge($location){
        if (USE_CACHE == TRUE)
          {
            $location = md5($location);
            $this->cacheLog[$location] = 0;
            if(file_put_contents($this->cacheLogFile,serialize($this->cacheLog)))
                return true;
            else
                return false;
          }
    }

    function purge_all(){
        if (USE_CACHE == TRUE)
          {
            if(file_exists($this->cacheLogFile)){
                foreach($this->cacheLog as $key=>$value) $this->cacheLog[$key] = 0;
                if(file_put_contents($this->cacheLogFile,serialize($this->cacheLog)))
                    return true;
                else
                    return false;
            }
          }
    }



}
