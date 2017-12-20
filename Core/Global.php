<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.1
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 use Skytells\Ecosystem\Payload;
 static $Framework, $_Autoload, $lang;
 static $ConnectedDBS = 0;
 $db = null;
 require __DIR__.'/Constants.php';
 require APP_MISC_DIR.'/Settings.php';
 require __DIR__.'/Ecosystem/Runtime.php';
 require __DIR__.'/Ecosystem/Console.php';
 require __DIR__.'/Ecosystem/Payload.php';
 require __DIR__.'/Ecosystem/Router.php';
 require __DIR__.'/Kernel/Kernel.php';
 foreach(glob(APP_MISC_DIR.'/Config/*.php') as $file) { require $file; }
 require __DIR__.'/Kernel/Boot.php';
 #  if (count($_Autoload) > 0) { Payload::Autoload($_Autoload); }
  Payload::Define('ROUTES');
  Payload::Define('SETTINGS');
  Payload::Autoload(Array(ENV_FUNCTIONS_DIR));
  require __DIR__.'/Ecosystem/Loader.php';
  require __DIR__ .'/Kernel/Composer/vendor/autoload.php';
  require __DIR__.'/Kernel/Config.php';
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
  Load::setReporter(FALSE);
  Load::handler('Http');
  define('HTTP_SERVER_PROTOCOL', (Skytells\Handlers\Http::isSSL()) ? 'https://' : 'http://');
  Skytells\Ecosystem\Payload::Autoload(Array(ENV_BASES_DIR, ENV_INTERFACES_DIR));
  $db = null;
  free_memory();
