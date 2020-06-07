<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.9
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
 foreach(glob(APP_MISC_DIR.'/Config/*.php', GLOB_NOSORT) as $file) { require $file; }
 require __DIR__.'/Kernel/Foundation.php';
 require __DIR__.'/Kernel/Boot.php';
  Payload::Define('ROUTES');
  Payload::Define('SETTINGS');
  Payload::Autoload(Array(ENV_FUNCTIONS_DIR));
  require __DIR__.'/Services.php';
  Load::setReporter(FALSE);
  Payload::resolvePreloaded();
  define('HTTP_SERVER_PROTOCOL', (Skytells\Handlers\Http::isSSL()) ? 'https://' : 'http://');
  Skytells\Ecosystem\Payload::loadBases();
  Skytells\Ecosystem\Payload::loadInterfaces();
  $db = null;
  free_memory();
