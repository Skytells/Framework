<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.3
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */


  /* Site Settings --------------------------------------------------------
      * These settings needs to be changed before the application being uploaded */
      $Settings["SITE_NAME"] = "";

      /* Site's BASE URL WITHOUT (HTTP) OR SLASHES IN THE END */
      $Settings["BASE_URL"]  = "localhost/Framework";

      /* THE MAIN SITE URL ( HERE YOU CAN INCLUDE SLASHES ) */
      $Settings["SITE_URL"]  = "localhost/Framework";

      $Settings["BASE"] = "";

      /* If your Application is running on a sub-domains or Folder, Please fill out
      * this field with the Folder name WITHOUT ANY SLASHES IN THE END,
      * If Not, Please Leave it EMPTY!. */
      $Settings["APPDIR"] = "Framework";

      /* CHANGE IT TO FALSE TO DISABLE, AND TRUE TO AUTOLOAD YOUR CONTROLLERS */
      $Settings["AUTO_LOAD_CONTROLLERS"] = TRUE;

      /* CHANGE IT TO FALSE TO DISABLE, AND TRUE TO AUTOLOAD YOUR MODELS
      If Disabled, You have to load your selected model inside the
      Controller everytime you need to connect with a single model . */
      $Settings["AUTO_LOAD_MODELS"] = FALSE;



  /* DEVELOPMENT Tools --------------------------------------------------------
     * These settings needs to be changed before the application being uploaded
     * CHANGE IT TO FALSE TO HIDE ERRORS AND WARNINGS */

      // This Option responsible for turning the development tools ON, and it
      // Will allow the Framwork display the detailed errors if found!
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




 /* Facebook Login --------------------------------------------------------
    * Please fill em out with your Facebook App Details. */
    $Settings["FACEBOOK_APPID"] = "";
    $Settings["FACEBOOK_APPSECRET"] = "";
    $Settings["FACEBOOK_REDIRECTURI"] = "";


 /* Twitter Settings -------------------------------------------------------
    * These option will be used by the Built-in Twitter Engine when needed
    * You need to fill out these field with your Twitter Application details
    * The twitter Engine is disabled by default. */
    $Settings["TWITTER_CONSUMER_KEY"] = "";
    $Settings["TWITTER_CONSUMER_SECRET"] = "";



 /* Database Setup --------------------------------------------------------
    * These are the main objects for the DB Connection, Please fill em out.
    * If Not, Leave 'em blank. */
      $Settings["USE_SQL"] = FALSE;

      $DBCONFIG["DB_HOST"]     = "localhost";
      $DBCONFIG["DB_USER"]     = "root";
      $DBCONFIG["DB_PASS"]     = "mysql";
      $DBCONFIG["DB_NAME"]     = "project1";
      $DBCONFIG["DB_PORT"]     = 3306;
      $DBCONFIG["DB_PREFIX"]   = "";
      $DBCONFIG["DB_CHARSET"]  = "utf8";


 /* Router Settings -------------------------------------------------------
    * You can switch Routing URLs ON or OFF by filling this field
    * With ( TRUE or FALSE ) ---------*/
      $Settings["USE_ROUTER"] = TRUE;

 /* Mail Settings ---------------------------------------------------------
    * Here you can manage the site's contact details.
    * Please fill 'em out ---------*/

      // This E-Mail will be used for ContactUS ..etc.
      $Settings["CONTACT_EMAIL"] = "support@domain.com";
      // This E-Mail will be used to receive the errors logs.
      $Settings["SYSTEM_EMAIL"]  = "reports@domain.com";
      // This E-Mail will be the displayed e-mail for sending mails.
      $Settings["SENDER_EMAIL"]  = "noreply@domain.com";

 /* Encryption Settings ---------------------------------------------------
    * These settings are important, in order to secure sessions and password,
    * You need to choose a strong encryption key. */
      $Settings["ENC_METHOD"] = "AES-256-CBC";
      $Settings["ENC_KEY"] = "SKY-55882";
      $Settings["ENC_IV"] = "IV-CCVVW";
      $Settings["ENC_SALT"] = "hvCE9Z@#iE";


  /* Engines Settings ---------------------------------------------------
   * These Engines are very important to run the framework's advanced
   * functionality, You can turn an Engine ( ON ) or ( OFF ) by changing
   * the value for each engine, You can add your own engies by adding the
   * Engine's File-path in this Array.  ----------*/
   $CORE_ENGINES = Array(
                          "Databases/SQLManager"   => TRUE,
                          "Databases/DBObject"     => TRUE
                        );




  /* Modules Settings ---------------------------------------------------
     * Here you can Manage / Add / Remove modules from or into the main
     * Core of the App, All modules must being uploaded into the modules's
     * Path (Application/Modules). ----------*/
     $Settings["USE_MODULES"] = TRUE;

     $MODULES = Array(
                        "Core"            => TRUE,
                        "CSRFProtection"  => TRUE,
                        "Firewall"        => TRUE, // -> Settings File : (Application/Misc/Config/Firewall.php)
                        "XSSProtection"   => TRUE
                     );



  /**
   * Security Settings ---------------------------------------------------
   * Here you can manage the internal security features, like Firewall
   * module, or CSRFProtection, If you use an third-party module
   * @category Firewall Settings File : is located in (Application/Misc/Config/Firewall.php)
   * Please make sure to enable it first. ----------*/

     // If XSSProtection Module is Enabled.
     $Settings["XREPLACE_SQL_FLAGS"]     = TRUE;
     $Settings["AUTO_SECURE_GET"]        = TRUE;
     $Settings["AUTO_SECURE_POST"]       = TRUE;
     $Settings["AUTO_SECURE_REQUEST"]    = TRUE;
     $Settings["AUTO_SECURE_COOKIES"]    = TRUE;
     $Settings["AUTO_SECURE_SESSIONS"]   = TRUE;




   /* Cache Settings ---------------------------------------------------
      * Here you can control the internal caching system.
      * You can turn the Cache OFF or ON or customize the caching settings
      * You can even exclude pages from caching ----------*/
      $Settings["USE_CACHE"]  = TRUE;
      $Settings["CACHE_DIR"]  = "Application/Storage/Cache";
      $Settings["CACHE_TIME"] = 500;
      // Pages to be excluded from caching.
      $CH_EXCLUSION = Array (
                              "Admin", "Test"
                            );


  /* Required PHP Modules --------------------------------------------------
   * Here you can put the required modules for your web-application to run
   * By simply adding the module name in the array below, so the framework
   * will check them before performing start-up functions  ----------*/
   $Settings["CHECK_REQM"] = FALSE;
   // Required Modules Array.
   $_PHP_REQM = Array(
                      "tokenizer" => "Required for the Framework.",
                      "curl"      => "cURL is required for this Framework"
                    );






  /* Compression Settings --------------------------------------------------
   * Here you can manage the compression settings for your application
   * The framework has a built-in compression Engine using gzip()
   * Please assure that gzip supported in your server ----------*/
   $Settings["ENABLE_COMPRESSION"]      = TRUE;
   // ob_gzhandler compression level use zlib.output_compression_level,
   // which is -1 per default, level 6.
   $Settings["GZIP_COMPRESSION_LEVEL"]  = 6;
