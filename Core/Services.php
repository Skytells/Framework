<?
require __DIR__.'/Ecosystem/Loader.php';
require __DIR__ .'/Kernel/Composer/vendor/autoload.php';
error_reporting(0);
if (DEVELOPMENT_MODE === TRUE && IS_CORE_CLI === FALSE && INTELLISENSE_DEBUGGER === TRUE) {
  $BMST=microtime(TRUE);
  ini_set("display_errors", 1);
  error_reporting(E_ALL | E_STRICT);
  if (INTELLISENSE_INTERFACE == 'UI' ) {
    $IntelliSense = new \IntelliSense\Run;
    $IntelliSense->pushHandler(new \IntelliSense\Handler\PrettyPageHandler);
    $IntelliSense->register();
  }else {
    require __DIR__ .'/Kernel/Units/IntelliSense.php';
    \php_error\reportErrors();
  }
  $BMEND = microtime(true) - $BMST;
}


global $ALCONF;
if ($ALCONF['Autoload'] === true) {
  if ($ALCONF['Controllers'] === true) { spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadController']); }
  if ($ALCONF['Aliases'] === true) { spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadAliase']); }
  if ($ALCONF['Models'] === true) { spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadModel']); }
  if ($ALCONF['Eloquents'] === true) { spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadEloquent']); }
  if ($ALCONF['Migrations'] === true) { spl_autoload_register(['Skytells\Ecosystem\Payload', 'loadMigration']); }
}
