<?php
class Cache {

    // Pages you do not want to Cache:
    var $doNotCache = array();

    // General Config Vars
    var $cacheDir = APPBASE.CACHE_DIR.'/System';
    var $cacheTime = 100;
    var $caching = false;
    var $cacheFile;
    var $cacheFileName;
    var $cacheLogFile;
    var $cacheLog;
    var $log_dir = APP_STORAGE_LOGS;

    function __construct(){
      global $Settings, $SFSyscache;
        $this->doNotCache = $SFSyscache['Exclusions'];
        $this->cacheDir = APPBASE.$Settings['CACHE_DIR'].'/System';
        $this->cacheTime = $Settings['CACHE_TIME'];
        $this->cacheFile = base64_encode($_SERVER['REQUEST_URI']);
        $this->cacheFileName = $this->cacheDir.'/'.$this->cacheFile.'.io';
        $this->cacheLogFile = $this->cacheDir."/Cachelog.txt";
        if(!is_dir($this->cacheDir)) mkdir($this->cacheDir, 0755);
        if(file_exists($this->cacheLogFile))
            $this->cacheLog = unserialize(file_get_contents($this->cacheLogFile));
        else
            $this->cacheLog = array();
    }

    function start(){
        if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "flushcache") { flush_cache(); $this->caching = false; return true; }
        $location = array_slice(explode('/',$_SERVER['REQUEST_URI']), 2);
        global $Settings;
        if(!in_array($location[0],$this->doNotCache)){
            if(file_exists($this->cacheFileName) && (time() - filemtime($this->cacheFileName)) < $this->cacheTime && $this->cacheLog[$this->cacheFile] == 1){
                $this->caching = false;
                echo file_get_contents($this->cacheFileName);
                if ($Settings['DEVELOPMENT_MODE'] === TRUE) {
                  global $ENV_STARTUP_TIME, $ENV_END_TIME;
                  $ENV_END_TIME = microtime(true) - $ENV_STARTUP_TIME;
                  require ENV_UNITS_DIR.'/Devconsole/Console.php';
                }
                exit();
            }else{
                $this->caching = true;
                ob_start();
            }
        }
    }

    function end(){
      if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "flushcache") {
        return false;
      }
      if($this->caching){
           $_CPAGE = ob_get_contents();
           if (Contains($_CPAGE, "{CACHE:EXCLUDE!}") || Contains($_CPAGE, "<meta content='no-cache'") || Contains($_CPAGE, '<meta content="no-cache"'))
             { return true; }
           if (Contains($_CPAGE, "{CACHE:FLUSH!}"))  { flush_cache(); return true; }
             file_put_contents($this->cacheFileName, $_CPAGE);
             ob_end_flush();
             $this->cacheLog[$this->cacheFile] = 1;
             if(file_put_contents($this->cacheLogFile,serialize($this->cacheLog)))
                 return true;
         }

    }

    function purge($location){
        $location = base64_encode($location);
        $this->cacheLog[$location] = 0;
        if(file_put_contents($this->cacheLogFile,serialize($this->cacheLog)))
            return true;
        else
            return false;
    }

    function purge_all(){
        if(file_exists($this->cacheLogFile)){
            foreach($this->cacheLog as $key=>$value) $this->cacheLog[$key] = 0;
            if(file_put_contents($this->cacheLogFile,serialize($this->cacheLog)))
                return true;
            else
                return false;
        }
    }




}
?>
