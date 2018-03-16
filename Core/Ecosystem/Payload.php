<?php
Namespace Skytells\Ecosystem;
Class Payload {


  public static function serve() {
    spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadController']);
    spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadAliase']);
    spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadModel']);
    spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadEloquent']);
    spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadMigration']);
    spl_autoload_register(function($class){
      if (!class_exists($class)) {
        if (strpos($class, '\\') !== false) {
          $class = str_replace('\\', '/', $class);
          $class = @end(explode("/",$class));
        }
        $exterialFile = ENVCORE.'/Ecosystem/Handlers/'.$class.'.php';
        $InternalPath = BASEPATH.'Application/Misc/Handlers/'.$class.'.php';
        if (file_exists($InternalPath)) { require $InternalPath; \Skytells\Core\Runtime::Report('handler', $class, $InternalPath); }
        if (file_exists($exterialFile)) { require $exterialFile; \Skytells\Core\Runtime::Report('handler', $class, $exterialFile); }
       }
     });

    spl_autoload_register(function($class){
      if (!class_exists($class)) {
        if (strpos($class, '\\') !== false) {
          $class = str_replace('\\', '/', $class);
          $class = @end(explode("/",$class));
        }
        $exterialFile = ENVCORE.'/Ecosystem/Libraries/'.$class.'.php';
        $InternalPath = BASEPATH.'Application/Misc/Libraries/'.$class.'.php';
        if (file_exists($InternalPath)) { require $InternalPath; \Skytells\Core\Runtime::Report('library', $class, $InternalPath); }
        if (file_exists($exterialFile)) { require $exterialFile; \Skytells\Core\Runtime::Report('library', $class, $exterialFile); }
       }
     });

    return true;
  }


  public static function loadController($className) {
    $filename = APP_CONTROLLERS_DIR . $className . ".php";
    if (is_readable($filename) && !class_exists($className)) {
        require $filename;
    }
  }



  public static function loadModel($className) {
    $filename = APP_MODELS_DIR . $className . ".php";
    if (is_readable($filename) && !class_exists($className)) {
        require $filename;
        \Skytells\Core\Runtime::Report('model', $className, $filename);
    }
  }

  public static function loadAliase($className) {
    $filename = APP_CONTROLLERS_DIR.'/Aliases/' . $className . ".php";
    if (is_readable($filename) && !class_exists($className)) {
        require $filename;
        \Skytells\Core\Runtime::Report('aliase', $className, $filename);
    }
  }


  public static function loadEloquent($className) {
    $filename = APP_MODELS_DIR .'/Eloquents/'. $className . ".php";
    if (is_readable($filename) && !class_exists($className)) {
        require $filename;
        \Skytells\Core\Runtime::Report('eloquent', $className, $filename);
    }
  }

  public static function loadMigration($className) {
    $filename = APP_MODELS_DIR .'/Migrations/' . $className . ".php";
    if (is_readable($filename) && !class_exists($className)) {
        require $filename;
        \Skytells\Core\Runtime::Report('migration', $className, $filename);
    }
  }


  public static function Autoload($Directories) {
      foreach ($Directories as $dir) {
          foreach(glob($dir .'*.php') as $class) {
              require $class;
          }
      }
  }
  public static function loadConfigManager() {
    require COREDIRNAME.'/Kernel/Config.php';
  }
  public static function isClassExist($ClassName, $ReturnType = "Page") {
        if ( !class_exists($ClassName) )
        {
          if ($ReturnType == "Page") {
            if (DEVELOPMENT_MODE === true){
                throw new  \ErrorException("Error: Requested Controller [ ".$ClassName." ] Does not exist.\r\n You're seeing this Exception because you're in the development mode.", 8);
                }else{ show_404(); }
          }
          return false;
        }
        return true;
   }

  public static function getExplosion($ptr, $id, $trim = true)
     {
       if (empty($ptr) || $ptr == ""){ return false; }
       $__MVURI = explode("/", $ptr);
       if (isset($__MVURI[$id]) && !empty($__MVURI[$id])){
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
  public static function isFunctionExist($ClassName, $Function, $ReturnType = "Page") {
    if (!method_exists($ClassName, $Function) ) {
      if ($ReturnType == "Page") {
        if (DEVELOPMENT_MODE === true){
          throw new  \ErrorException("Error: Requested Function [ ".$Function." ] Does not exist in Controller [ $ClassName ]. ", 9);
         }else{ show_404(); }
        }
        return false;
     }
     if (in_array($Function, \Skytells\Foundation::$ProhibitedMethods)) {
       if (DEVELOPMENT_MODE === true){
       throw new  \ErrorException("Security Error: Requested Function [ ".$Function." ] defined as Prohibited Method, Which cannot be accessed from the URL, You're seeing this message because development mode is on", 9);
     }else{ show_404(); return false; }
      return false;
     }
     return true;
   }

  public static function Define($NODE) {
    global $Routes, $Settings, $Firewall;

    switch ($NODE) {
      case 'ROUTES':
        foreach ($Routes["CONFIG"] as $Key => $Val) { define("ROUTER_CONFIG_". $Key, $Val); }
        break;
      case 'SETTINGS':
        foreach ($Settings as $Key => $Val) { define($Key, $Val); }
        break;
      case 'FIREWALL':
        foreach ($Firewall as $Key => $Val) { define('FIREWALL_'.$Key, $Val); }
        break;
      default:
        return true;
        break;
    }
  }


  public static function resolvePreloaded() {
    global $_Preloaded;
    if (!empty($_Preloaded['Handlers'])) {
      foreach ($_Preloaded['Handlers'] as $_handler) { \Load::handler($_handler); }
    }
    if (!empty($_Preloaded['Helpers'])) {
      foreach ($_Preloaded['Helpers'] as $_handler) { \Load::helper($_handler); }
    }
    if (!empty($_Preloaded['Libraries'])) {
      foreach ($_Preloaded['Libraries'] as $_handler) { \Load::library($_handler); }
    }
  }


  /**
   * @method ResolveProvider
   */
  public static function ResolveProvider($ProviderName, $ProviderClass) {
      require APP_PROVIDERS_DIR.$ProviderName.'.php';
      ${$ProviderName} = new $ProviderClass(\Skytells\Foundation::$App);
      $requirements = ${$ProviderName}->boot();
      if (is_array($requirements) && !empty($requirements['services']) && !empty($requirements['contracts'])) {
        foreach ($requirements['contracts'] as $contract) {
          require APP_PROVIDERS_DIR.'/Contracts/'.$contract.'.php';
        }
        foreach ($requirements['services'] as $service) {
          require APP_PROVIDERS_DIR.'/Services/'.$service.'.php';
        }
        ${$ProviderName}->register();
        \Skytells\Core\Runtime::Report('Service Provider', $ProviderClass, APP_PROVIDERS_DIR.$ProviderName.'.php');
      }
      return true;
  }




}
