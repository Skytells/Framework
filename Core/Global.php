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
      require __DIR__ .'/Kernel/Units/IntelliSense/vendor/autoload.php';
      ini_set("display_errors", 1);
      error_reporting(E_ALL | E_STRICT);
      $IntelliSense = new \IntelliSense\Run;
      $IntelliSense->pushHandler(new \IntelliSense\Handler\PrettyPageHandler);
      $IntelliSense->register();
    }else {
      require __DIR__ .'/Kernel/Units/IntelliSense/IntelliSense.php';
      ini_set("display_errors", 1);
      error_reporting(E_ALL | E_STRICT);
    }
  }

  // For better performance.
  Load::setReporter(FALSE);

  // Loading Http Handler.
  Load::handler('Http');

  define('HTTP_SERVER_PROTOCOL', (Skytells\Handlers\Http::isSSL()) ? 'https://' : 'http://');
  Skytells\Ecosystem\Payload::Autoload(Array(ENV_EXCEPTIONS_DIR, ENV_BASES_DIR, ENV_INTERFACES_DIR));
  global $Illuminate;
   if ($Illuminate['ORM'] === TRUE) {
    require ENV_DRIVERS_DIR.'Database/illuminate/autoload.php';
    $Capsule = new Capsule;

     $Capsule->addConnection([
         'driver'    => $dbconfig[$Illuminate['DATABASE']]['illuminatedriver'],
         'host'      => $dbconfig[$Illuminate['DATABASE']]['host'],
         'database'  => $dbconfig[$Illuminate['DATABASE']]['database'],
         'username'  => $dbconfig[$Illuminate['DATABASE']]['username'],
         'password'  => $dbconfig[$Illuminate['DATABASE']]['password'],
         'charset'   => $dbconfig[$Illuminate['DATABASE']]['charset'],
         'collation' => $dbconfig[$Illuminate['DATABASE']]['collation'],
         'prefix'    => $dbconfig[$Illuminate['DATABASE']]['prefix'],
     ]);
     $Capsule->setEventDispatcher(new Illuminate\Events\Dispatcher(new Illuminate\Container\Container));
     $Capsule->setAsGlobal();
     $Capsule->bootEloquent();
   }
  if (IS_CORE_CLI === FALSE) { Startup(); $Core = new Boot(); }
  $db = null;
  free_memory();
