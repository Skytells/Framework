<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.1.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */

    $startScriptTime=microtime(TRUE);

    require_once("Misc/Settings.php");
    require("Misc/Config/Firewall.php");
    require("Misc/Config/Terminal.php");
    require("Misc/Config/Templates.php");
    $files = glob(__DIR__.'/Misc/Config/Packages/*.php');

    if (count($files) > 0){
      foreach($files as $file) {
        require_once $file;
      }
    }

    global $Settings;
    ini_set('zlib.output_compression_level', $Settings['GZIP_COMPRESSION_LEVEL']);
    if ($Settings['ENABLE_COMPRESSION'] == true) { if(!ob_start("ob_gzhandler")) ob_start(); }else { ob_start(); }


    require __DIR__."/Library/Constants.php";

    if (IS_CORE_CLI == FALSE) {
    //define('TEMPLATES_DIR',MAINDIR . 'Templates/');
    $lang = array();
    if ($Settings['DEVELOPMENT_MODE'] == TRUE)
    {
      ini_set("display_errors", 1);
      error_reporting(E_ALL | E_STRICT);

    if ($Settings['INTELLISENSE_DEBUGGER'] === TRUE)
    {

      if (strtolower($Settings['INTELLISENSE_INTERFACE']) == 'ui') {
        require_once __DIR__ . '/Library/vendor/autoload.php';

        $IntelliSense = new \IntelliSense\Run;
        $IntelliSense->pushHandler(new \IntelliSense\Handler\PrettyPageHandler);
        $IntelliSense->register();
      }else
      {
        require_once  __DIR__. '/Library/Local/IntelliSense.php';
          \php_error\reportErrors();
      }

    }
  }
}
    require_once("Library/Autoloader.php");
    require_once("Library/Functions/Core.php");
    require_once("Library/Functions/Exceptions.php");
    DefSettings();
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    define('SITEBASE', $protocol.BASE_URL."/");
    //LoadFunctions();
    if (INTELLISENSE_DEBUGGER === FALSE){
    set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
        // error was suppressed with the @-operator
        if (0 === error_reporting()) {
            return false;
        }
        $_Content = file_get_contents(SYS_VIEWS."html/debug_log.html");
        $_Content = str_replace("{MSG}", $errstr, $_Content);
        $_Content = str_replace("{ERR_LINE}", $errline, $_Content);
        $_Content = str_replace("{ERR_NO}", $errno, $_Content);
        $_Content = str_replace("{ERR_FILE}", $errfile, $_Content);

        exit($_Content);
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    });
    set_exception_handler("default_exception_handler");
  }
    global $_SESSION;
    $_SESSION["DEV_LOADED_PAGES"] = array();
    $_SESSION["DEV_LOADED_CONTROLLERS"] = array();
    $_SESSION["DEV_LOADED_ENGINES"] = array();
    $_SESSION["DEV_LOADED_MODELS"] = array();
    $_SESSION["DEV_LOADED_HELPERS"] = array();
    $_SESSION["DB_QUERIES_C"] = 0;

    global $DBCONFIG;
    static $_DB_CONNECTION_STATUS;
    static $_LOADED_CONTROLLERS = array();
    static $_DEV_LOADED_PAGES = array();
    static $_DEV_LOADED_MODELS = array();
    static $_DEV_LOADED_ENGINES = array();
    static $_DEV_LOADED_LIBRARIES = array();
    static $_DEV_LOADED_HELPERS = array();
    static $_CONSOLE_OUTPUT   = array();
    static $_FILES_AUTOLOADED = array();
    static $_CLI_COMMANDS = array();
    static $_FRAMEWORK_VER = "2.1.0 Beta";
    $db = ($Settings["USE_SQL"]) ? new mysqli($DBCONFIG["DB_HOST"], $DBCONFIG["DB_USER"], $DBCONFIG["DB_PASS"], $DBCONFIG["DB_NAME"]) : false;


    $L_MDL = (AUTO_LOAD_MODELS && AUTO_LOAD_MODELS === true) ? MDL_DIR : "";
     Autoloader(array(
            MVC_BS,
            CL_DIR,
            FN_DIR,
            MD_DIR,
            LANG_DIR,
            DB_ENG_DIR,
            $L_MDL,

            CONTROLLERS_DIR), false);

      // For Debugging, We can print the output.
      $_AUTOLOADED = Autoloader();
      // print array of class autoload paths:
      //  print_r($_AUTOLOADED);

      // -----------------------------------

    $Core = new  Controller();
      $Core->Init();
      global $router;
