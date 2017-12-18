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


/*
|-------------------------------------------------------------------------------
| FRAMEWORK SETTINGS
|-------------------------------------------------------------------------------
|
| These settings needs to be changed before the application being uploaded
*/
  // WHERE SKYTELLS FRAMEWORK IS INSTAALLED? IF YOU'RE RUNNING ON THE ROOT
  // FOLDER OR THE MAIN (WWW), PLEASE LEAVE IT EMPTY, OTHERWISE,
  // PLEASE WRITE THE NAME OF THE DIRECTORY YOU INSTALLED SKYTELLS FW ON IT.
  $Settings["ROOT_PATH"]   = 'Framework';

  // PLEASE WRITE THE BASE URL WITHOUT (HTTP, HTTPS OR WWW) WITHOUT END-SLASHES
  // EXAMPLE: Skytells.org/Framework or Skytells.org
  $Settings["SITEBASE"]   = 'localhost/Framework';


  // TURN IT TO (TRUE) TO FORCE USING SECURE PROTOCOL (HTTPS)
  // NOTE: THIS OPTION REQUIRES (SSL) CERT. TO BE INSTALLED.
  $Settings["FORCE_SSL"]   = FALSE;
 //-----------------------------------------------------------------------------


/*
|-------------------------------------------------------------------------------
| DEVELOPMENT ENVIRONMENT
|-------------------------------------------------------------------------------
|
| These settings needs to be changed before the application being uploaded
| Please do not upload this application into WWW without turning the
| development environment off, or all of your visitors will be able to
| see the debug data, such as errors and warnning and sometimes your code.
|
*/ // This option is responsible for turning development mode on or off.
 $Settings["DEVELOPMENT_MODE"]   = TRUE;
 // The IntelliSense Debugger is responsible for displying errors and
 // Exceptions all with highliting the code, this feature will only
 // perform its events when the DEVELOPMENT_MODE is being ON.
 // Please do not keep it on while your project is being finished!
 // Benchmark : + 20ms
 $Settings["INTELLISENSE_DEBUGGER"] = TRUE;
 /**
  *You have TWO options here ( UI ) OR ( BASH )
  * @method UI :
  * Displays Erros, Exeptions, In a virtual Userinterface,
  * This Option will be good for non-advanced PHP Programmers.
  * @method BASH :
  * Usually, This method is used by the advanced programmers, it Displays
  * Errors, Warnings, Exceptions by a deffrent method, offering an advanced
  * Tools for Debugging during RunTime. */
 $Settings["INTELLISENSE_INTERFACE"] = "UI"; // UI or BASH
 //-----------------------------------------------------------------------------






 /*
 |-------------------------------------------------------------------------------
 | Internationalization Settings
 |-------------------------------------------------------------------------------
 |
 | These settings to allow internationalization for your application by allowing
 | the app to support other languages.
 */
 // CHANGE THIS TO TRUE TO ENABLE THIS FEATURE.
 $Settings["MULTILANGS"] = TRUE;
 // THE SESSION ID TO STORE THE SELECTED LANG.
 $Settings["LANG_SESID"] = "SFW_LANGUAGE";
 // THE DEFAULT LANGUAGE FOR YOUR APP ( MUST BE IN THE LANGUAGES DIR. )
 $Settings["DEFAULTLANG"] = "en_US";



 /*
 |-------------------------------------------------------------------------------
 | ENCRYPTION SETTINGS
 |-------------------------------------------------------------------------------
 |
 | These settings are important, in order to secure sessions and password,
 | You need to choose a strong encryption key.
 */
 $Settings["ENC_METHOD"] = "AES-256-CBC";
 $Settings["ENC_KEY"] = "SKY-55882";
 $Settings["ENC_IV"] = "IV-CCVVW";
 $Settings["ENC_SALT"] = "hvCE9Z@#iE";





 /*
 |--------------------------------------------------------------------------
 | Default Character Set
 |--------------------------------------------------------------------------
 |
 | This determines which character set is used by default in various methods
 | that require a character set to be provided.
 |
 | See http://php.net/htmlspecialchars for a list of supported charsets.
 |
 */
 $Settings['CHARSET'] = 'UTF-8';




 /*
 |-------------------------------------------------------------------------------
 | CACHE SETTINGS
 |-------------------------------------------------------------------------------
 |
 | Here you can control the internal caching system.
 | You can turn the Cache OFF or ON or customize the caching settings
 | USE_CACHE : If Enabled, The System will cache some of its libraries.
 | CACHE_DRIVER : FileCache, APC, Memcache.
 | $Memcache["Settings"] : If Memcache Driver is enabled.
 | CACHE_DIR : Which Dir. the Cached files will be stored on?
 */
  $Settings["USE_CACHE"]  = TRUE;
  $Settings["CACHE_DRIVER"] = 'FileCache';
  $Settings["CACHE_DIR"]  = "Storage/Cache";
  $Settings["CACHE_TIME"] = 500;
  $Memcache["Settings"] = Array('HOST' => "127.0.0.1", 'PORT' => 11211);


  /*
  |-------------------------------------------------------------------------------
  | MODULES SETTINGS
  |-------------------------------------------------------------------------------
  |
  | You can load/unload modules by turning it on or off.
  */
   $Settings['USE_MODULES'] = TRUE;
   $Modules = Array (
     "Firewall" => TRUE
   );




  /*
  |--------------------------------------------------------------------------
  | Date Format for Logs
  |--------------------------------------------------------------------------
  |
  | Each item that is logged has an associated date. You can use PHP date
  | codes to set your own date formatting
  |
  */
  $Settings['LOG_DT_FORMAT'] = 'Y-m-d H:i:s';





  /*
  |--------------------------------------------------------------------------
  | REQUIRED EXTENTIONS
  |--------------------------------------------------------------------------
  |
  | Fill up this array with the required extentions for your app.
  | Note that (tokenizer) is required by the Framework itself.
  |
  */
  $Settings['CHECK_EXTENTIONS'] = TRUE;
  $Extentions = Array('tokenizer');
