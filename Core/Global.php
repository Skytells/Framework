<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.0
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 use Skytells\Ecosystem\Payload;
 use Illuminate\Events\Dispatcher;
 use Illuminate\Container\Container;
 use Illuminate\Database\Capsule\Manager as Capsule;
 if (!defined(BASEPATH)) {   $ENVIRONMENT_CONFIG = parse_ini_file(__DIR__.'/../.env', true); define('BASEPATH', str_replace('/Core', '/', __DIR__)); }
 static $Framework, $_Autoload, $lang;
 static $ConnectedDBS = 0;
 $db = null;
 require __DIR__.'/Constants.php';
 require APP_SETTINGS_DIR.'/Settings.php';
 require __DIR__.'/Ecosystem/Runtime.php';
 require __DIR__.'/Ecosystem/Console.php';
 require __DIR__.'/Ecosystem/Payload.php';
 require __DIR__.'/Ecosystem/Router.php';
 require __DIR__.'/Kernel/Kernel.php';
 $_configfiles = glob(APP_SETTINGS_DIR.'/Config/*.php');
 if (count($_configfiles) > 0){ foreach($_configfiles as $file) { require $file; } }
 if (count($_Autoload) > 0) { Payload::Autoload($_Autoload); }
 require __DIR__.'/Kernel/Boot.php';
  Payload::Define('ROUTES');
  Payload::Define('SETTINGS');
  Payload::Autoload(Array(ENV_FUNCTIONS_DIR));
  require __DIR__.'/Ecosystem/Loader.php';

  error_reporting(0);
  if (DEVELOPMENT_MODE === TRUE && IS_CORE_CLI == FALSE) {
    if (INTELLISENSE_INTERFACE == 'UI' ) {
      $BMST=microtime(TRUE);
      require __DIR__ .'/Kernel/Units/IntelliSense/vendor/autoload.php';
      ini_set("display_errors", 1);
      error_reporting(E_ALL | E_STRICT);
      $IntelliSense = new \IntelliSense\Run;
      $IntelliSense->pushHandler(new \IntelliSense\Handler\PrettyPageHandler);
      $IntelliSense->register();
      $BMEND = microtime(true) - $BMST;
    }else {
      require __DIR__ .'/Kernel/Units/IntelliSense/IntelliSense.php';
      ini_set("display_errors", 1);
      error_reporting(E_ALL | E_STRICT);
    }
  }
  require __DIR__ .'/Kernel/Components/vendor/autoload.php';
  // For better performance.
  Load::setReporter(FALSE);

  // Loading Http Handler.
  Load::handler('Http');

  define('HTTP_SERVER_PROTOCOL', (Skytells\Handlers\Http::isSSL()) ? 'https://' : 'http://');
  Skytells\Ecosystem\Payload::Autoload(Array(ENV_EXCEPTIONS_DIR, ENV_BASES_DIR, ENV_INTERFACES_DIR));
  global $Illuminate, $DBGroups;
   if ($Illuminate['ORM'] === TRUE) {
    //require ENV_DRIVERS_DIR.'Database/illuminate/autoload.php';
    $Capsule = new Capsule;
     $Capsule->addConnection([
         'driver'    => $DBGroups[$Illuminate['DATABASE']]['illuminatedriver'],
         'host'      => $DBGroups[$Illuminate['DATABASE']]['host'],
         'database'  => $DBGroups[$Illuminate['DATABASE']]['database'],
         'username'  => $DBGroups[$Illuminate['DATABASE']]['username'],
         'password'  => $DBGroups[$Illuminate['DATABASE']]['password'],
         'charset'   => $DBGroups[$Illuminate['DATABASE']]['charset'],
         'collation' => $DBGroups[$Illuminate['DATABASE']]['collation'],
         'prefix'    => $DBGroups[$Illuminate['DATABASE']]['prefix'],
     ]);
     $Capsule->setEventDispatcher(new Illuminate\Events\Dispatcher(new Illuminate\Container\Container));
     $Capsule->setAsGlobal();
     $Capsule->bootEloquent();
   }
  if (IS_CORE_CLI === FALSE) { Startup(); $Core = new Boot(); }
  $db = null;
  free_memory();
