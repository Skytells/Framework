<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.4
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
  // WHERE SKYTELLS FRAMEWORK IS INSTALLED? IF YOU'RE RUNNING ON THE ROOT
  // FOLDER OR THE MAIN (WWW), PLEASE LEAVE IT EMPTY, OTHERWISE,
  // PLEASE WRITE THE NAME OF THE DIRECTORY YOU INSTALLED SKYTELLS FW ON IT.
  $Settings["ROOT_PATH"]   = '';

  // PLEASE WRITE THE BASE URL WITHOUT (HTTP, HTTPS OR WWW) WITHOUT END-SLASHES
  // EXAMPLE: Skytells.org/Framework or Skytells.org
  $Settings["SITEBASE"]   = 'localhost';


  // TURN IT TO (TRUE) TO FORCE USING SECURE PROTOCOL (HTTPS)
  // NOTE: THIS OPTION REQUIRES (SSL) CERT. TO BE INSTALLED.
  $Settings["FORCE_SSL"]   = FALSE;
 //-----------------------------------------------------------------------------




 /*
 |-------------------------------------------------------------------------------
 | APPLICATION SETTINGS.
 |-------------------------------------------------------------------------------
 |
 | These settings needs to be configured as the way you develope your app.
 | NOTE: That these settings are important.
 */
 // The Default Namespace for your App.
 // NOTE: PLEASE DO NOT INCLUDE (\) In THE END.
 // If you do not want to work with Namespaces, leave it blank
 $Settings['APP_NAMESPACE'] = '';

 // APPLICATION INSTANCE
 // Application instance is the main container of the entire project.
 $Settings['APP_INSTANCE'] = 'App';

 // If your app is paid, and you're afraid from someone who may steal it
 // Write a Strong Key to encrypt your app, and prevent it from working on
 // unauthorized websites.
 $Settings['APP_CRYPTOKEY'] = '0A8#CR8#9SSW#';





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
 | Internationalization Settings (BUILT-IN ENGINE) ?
 |-------------------------------------------------------------------------------
 |
 | Skytells Framework comes with (2) Language Engines.
 | - Built-In Engine
 | - Skytells Engine
 | These settings to allow internationalization for your application by allowing
 | the app to support other languages.
 | --
 | MULTILANGS_DETECTION_DETECTION: This var. is required to be set true or false,
 | by enabling this option, You're giving the Framework the chance to detect
 | the language by
 | a URL parameter.
 | USE_BUILTIN_PHRASES: Allows you to use the built in languages.
 | LANG_SESID: The Session key which responsible for storing langID.
 | DEFAULTLANG: The default language.
 | NOTE: That you can use our dynamic Translation Engine also.
 | How to? you can see our documentation on our website.
 */
 // CHANGE THIS TO TRUE TO ENABLE THIS FEATURE.
 $Settings["MULTILANGS_DETECTION"] = TRUE;

 // Use the BUILT-IN Engine as the primary languages engine?
 $Settings["USE_BUILTIN_PHRASES"] = FALSE;

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
 | $OXCache : Dynamic array contains an Alternative Oxide Caching Config.
 | SF_CACHE is another cache driver which used by skytells.
 | $OXCache['ENABLED'] Enables or disables the Oxide Cache driver.
 | NOTE: That enable or disable this $OXCache cache doesn't effect the
 | Main cache configuration which used for $Settings["USE_CACHE"].
 | $OXCache['PERIOD'] : The default period for storing your cache.
 */
  $Settings["USE_CACHE"]  = TRUE;
  $Settings["CACHE_DRIVER"] = 'FileCache';
  $Settings["CACHE_DIR"]  = "Storage/Cache";
  $Settings["CACHE_TIME"] = 500;
  $Memcache["Settings"] = Array('HOST' => "127.0.0.1", 'PORT' => 11211);

  // Alternative Oxide Cache Driver.
  // Oxide Cache Driver is a powerful caching engine.
  $OXCache['ENABLED']  = FALSE;
  $OXCache['PERIOD'] = 500;
  $OXCache['config'] = [
       'cache.default' => 'file',
       'cache.prefix' => 'SF_',
       'cache.stores.file' => [
           'driver' => 'file',
           'path' => APPBASE.'Storage/Cache/FileCache'
           // APPBASE : Returns the Application path.
       ],
       'cache.stores.memcached' => [
           'driver' => 'memcached',
           'servers' => [
               [
                   'host' => getenv('MEMCACHED_HOST', '127.0.0.1'),
                   'port' => getenv('MEMCACHED_PORT', 11211),
                   'weight' => 100,
               ],
           ],
       ],
       'cache.stores.redis' => [
            'driver' => 'redis',
            'connection' => 'default'
        ],
        'database.redis' => [
            'cluster' => false,
            'default' => [
                'host' => '127.0.0.1',
                'port' => 6379,
                'database' => 0,
            ]
        ]
   ];





  /*
  |-------------------------------------------------------------------------------
  | MODULES SETTINGS
  |-------------------------------------------------------------------------------
  |
  | You can load/unload modules by turning it on or off.
  */
   $Settings['USE_MODULES'] = TRUE;
   $SF_Modules = Array (
     "Firewall" => TRUE
   );







   /*
   |-------------------------------------------------------------------------------
   | SERVICE PROVIDERS
   |-------------------------------------------------------------------------------
   |
   | Service providers are the central place of all Skytells application bootstrapping.
   | Your own application, as well as all of Skytells Framework's core services are
   | bootstrapped via service providers.
   */
    $Settings['USE_PROVIDERS'] = FALSE;
    $SF_PROVIDERS = [
     /*
      * Application Service Providers...
      */
      "AppServiceProvider" => App\Providers\AppServiceProvider::class
    ];









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
