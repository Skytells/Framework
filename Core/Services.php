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

global $ALCONF;
if ($ALCONF['Autoload'] === true) {
if ($ALCONF['Controllers'] === true) { Skytells\Ecosystem\Payload::Autoload(APP_CONTROLLERS_DIR); }
if ($ALCONF['Alliances'] === true) { Skytells\Ecosystem\Payload::Autoload(APP_CONTROLLERS_DIR.'/Alliances/'); }
if ($ALCONF['Models'] === true) { Skytells\Ecosystem\Payload::Autoload(APP_MODELS_DIR); }
if ($ALCONF['Eloquents'] === true) { Skytells\Ecosystem\Payload::Autoload(APP_MODELS_DIR.'/Eloquents/'); }
if ($ALCONF['Migrations'] === true) { Skytells\Ecosystem\Payload::Autoload(APP_MODELS_DIR.'/Migrations/'); }
}
