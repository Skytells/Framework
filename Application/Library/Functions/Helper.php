<?

  function isClassExist($ClassName, $ReturnType = "Page")
    {
      if ( !class_exists($ClassName) )
      {
        if ($ReturnType != "Page") { return false; }
          if (DEVELOPMENT_MODE == true){
            throw new  Exception("Error: Requested Controller [ ".$ClassName." ] Does not exist.\r\n You're seeing this Exception because you're in the development mode.", 8);
            }else{
              header("HTTP/1.0 404 Not Found");
              require MAINDIR.'Library/System/html/404.html'; exit;
            }
      }else{
        if ($ReturnType != "Page") { return true; }
      }
      return true;
    }

function isCached($url = null)
  {
    if ($url == null || empty($url)){
          $url = $_SERVER['REQUEST_URI'];
      }
        $url = md5($url);
      if (file_exists("./".CACHE_DIR."/".$url)){
        return true;
      }else{
        return false;
      }
  }

  function flushPageCache($url = "")
  {
    if ($url == null || empty($url)){
          $url = $_SERVER['REQUEST_URI'];
      }
        $url = md5($url);
      if (file_exists("./".CACHE_DIR."/".$url)){
        unlink(CACHE_DIR."/".$url);
        return true;
      }else{
        return false;
      }
  }
  function isFunctionExist($ClassName, $Function, $ReturnType = "Page")
      {
        if ( !method_exists($ClassName, $Function) )
        {
          if ($ReturnType != "Page") { return false; }
            if (DEVELOPMENT_MODE == true){
              throw new  Exception("Error: Requested Function [ ".$Function." ] Does not exist in Controller [ $ClassName ]. ", 9);
              }else{
                header("HTTP/1.0 404 Not Found");
                require MAINDIR.'Library/System/html/404.html'; exit;
              }
        }else{
          if ($ReturnType != "Page") { return true; }
        }
        return true;
      }


  function getExplosion($ptr, $id, $trim = true)
    {
      if (!isset($ptr) || empty($ptr) || $ptr == ""){ return false; }

      $__MVURI = explode("/", $ptr);
      if (isset($__MVURI[$id]) && !empty($__MVURI[$id]) && $__MVURI[$id] != ""){
        $value = $__MVURI[$id];
          $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
          $value = strip_tags($value);
          $value = stripslashes($value);
          $value = ($trim == true) ? ltrim($value, "/") : $value;
          $value = ($trim == true) ? rtrim($value, "/") : $value;
        return $value;
      }else {
        return false;
      }
    }
