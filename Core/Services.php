<?
require __DIR__.'/Ecosystem/Loader.php';
require __DIR__ .'/Kernel/Composer/vendor/autoload.php';
// require __DIR__.'/Kernel/Config.php';
error_reporting(0);
if (DEVELOPMENT_MODE === TRUE && IS_CORE_CLI == FALSE) {
  if (INTELLISENSE_INTERFACE == 'UI' ) {
    $BMST=microtime(TRUE);
    ini_set("display_errors", 1);
    error_reporting(E_ALL | E_STRICT);
    $IntelliSense = new \IntelliSense\Run;
    $IntelliSense->pushHandler(new \IntelliSense\Handler\PrettyPageHandler);
    $IntelliSense->register();
    $BMEND = microtime(true) - $BMST;
  }else {
    require __DIR__ .'/Kernel/Units/IntelliSense.php';
    ini_set("display_errors", 1);
    error_reporting(E_ALL | E_STRICT);
  }
}
