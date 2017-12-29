<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.3
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 use Skytells\UI\View;
 Class Controller {

   public function __construct($args = array()) {
     global $Extentions;
     if (CHECK_EXTENTIONS === TRUE) {
       foreach ($Extentions as $ex) {
         if (!extension_loaded($ex)) { show_error('Woops!', 'The [ '. $ex .' ] extention is missing out<br>This Extention is required for this web application, Please install it on your PHP.'); }
       }
     }
     $this->load = new \Load();
     $this->view = new View();

     // Handling Languages.
     if (MULTILANGS_DETECTION === TRUE) {
       $SISID = (empty(LANG_SESID)) ? 'SFW_LANGUAGE' : LANG_SESID;
       $LANG = (empty(DEFAULTLANG)) ? 'en_US' : DEFAULTLANG;
       if (!isset($_SESSION[$SISID]) || empty($_SESSION[$SISID])) {
         $_SESSION[$SISID] = $LANG;
       }
       // Assigning GET -X (lang)
       if (isset($_GET['lang']) && !empty($_GET['lang'])) {
         // Secure lang string from unwanted chars..
         $_GET['lang'] =  str_replace(array('../', 'http', '//', 'www', '/', '__DIR__', 'dirname', '\\'), '', $_GET['lang']);
         $_GET['lang'] = htmlspecialchars($_GET['lang'], ENT_IGNORE, 'utf-8');
         $_SESSION[$SISID] = $_GET['lang'];

       }
       // FREE UP RAM.
       unset($_GET['lang']); unset($LANG); unset($SISID);
     }

     if (isset($_GET['action']) && $_GET['action'] == 'flushcache') {
       flush_cache();
     }


   }




  public function AddAlliance($File, $to = false, $args = array(), $newName = '') {
    if (!Contains($File,".php")) { $File = $File.'.php'; }
    $Path =  APP_CONTROLLERS_DIR.'Alliances/'.$File;

    if (is_object($to)) {
      require $Path;
      $clName = Load::getClassNameFromFile($Path);
      $OwnerObject = $clName;
      $namespace = Load::getClassNamespaceFromFile($Path);
      $realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
      if (!empty($newName)) { $OwnerObject = $newName;  }
      if ($args != false && is_array($args)){
      $refClass = new ReflectionClass($realClassName);
      $to->$OwnerObject = $refClass->newInstanceArgs($args);
    } else { $to->$OwnerObject = new $realClassName; } }else {require $Path;}
    return true;
  }
   /**
    * Grant Database Access
    * @return bool
    */
   public function GrantDBAccess($GroupID = 'Default') {
     try {
       global $dbconfig, $Settings, $db;
       $DriverName = $dbconfig[$GroupID]['dbdriver'];
       if (!in_array($dbconfig[$GroupID]['dbdriver'], $this->LoadedDrivers)) {
       $driver = ENV_DRIVERS_DIR.'Database/'.$dbconfig[$GroupID]['dbdriver'].'/Init.php';
       if (!file_exists($driver)) { throw new \ErrorException("DB Driver [$DriverName] selected on Group [$GroupID] is not found as it should be in [$driver]", 1); }
       $LoadedDrivers[] = $dbconfig[$GroupID]['dbdriver'];
       }
       $DB_ACTIVE_GROUP = $GroupID;
       $db = require $driver;
       if ($dbconfig[$GroupID]['dbdriver'] === 'mysqli') {
         $db_data = array ('host' => $dbconfig[$GroupID]['hostname'],
                            'username' => $dbconfig[$GroupID]['username'],
                            'password' => $dbconfig[$GroupID]['password'],
                            'db'=> $dbconfig[$GroupID]['database'],
                            'port' => $dbconfig[$GroupID]['port'],
                            'prefix' => $dbconfig[$GroupID]['dbprefix'],
                            'charset' => $dbconfig[$GroupID]['charset']);
         $this->SQLManager[$GroupID] = new SQLManager($db_data);
         if ($dbconfig['QUERYBUILDER'] === TRUE) {
           $this->DBObject[$GroupID] = new DBObject();
          }
         $this->db[$GroupID] = ($dbconfig[$GroupID]['raw'] == TRUE) ?
         new mysqli( $dbconfig[$GroupID]['hostname'], $dbconfig[$GroupID]['username'], $dbconfig[$GroupID]['password'], $dbconfig[$GroupID]['database']) : NULL;
         $db = $this->db[$GroupID];
       }
       if (DEVELOPMENT_MODE === TRUE) {
         global $Framework;
         $Framework['db_connection'] = true;
         $Framework['db_drivers'][] = $dbconfig[$GroupID]['dbdriver'];
         $Framework['dbs'][] = $dbconfig[$GroupID]['database'];
       }
       return true;
     } catch (Exception $e) {
      throw new \Exception($e->getMessage(), 1);
    }
   }


 }
