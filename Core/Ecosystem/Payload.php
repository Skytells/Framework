<?php
Namespace Skytells\Ecosystem;
Class Payload {
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
          if (DEVELOPMENT_MODE === true){
              throw new  \ErrorException("Error: Requested Controller [ ".$ClassName." ] Does not exist.\r\n You're seeing this Exception because you're in the development mode.", 8);
              }else{
              show_404();
              }
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
          if ( !method_exists($ClassName, $Function) )
          {
              if (DEVELOPMENT_MODE === true){
                throw new  \ErrorException("Error: Requested Function [ ".$Function." ] Does not exist in Controller [ $ClassName ]. ", 9);
                }else{
                show_404();
                }
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
