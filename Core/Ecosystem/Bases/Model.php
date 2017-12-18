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
 use Skytells\Core\Runtime;
 use Illuminate\Events\Dispatcher;
 use Illuminate\Container\Container;
 use Illuminate\Database\Capsule\Manager as Capsule;
 Class Model {
   public  $SQLManager;
   public  $DBObject;

   public function __construct($args = array()) {

   }


   public function Connect($GroupID = 'Default', $args = array()) {
     try {
       global $dbconfig, $Settings, $db;
       $DriverName = $dbconfig[$GroupID]['driver'];

       $driver = ENV_DRIVERS_DIR.'Database/'.$dbconfig[$GroupID]['driver'].'/Init.php';
       if (!file_exists($driver)) { throw new \ErrorException("DB Driver [$DriverName] selected on Group [$GroupID] is not found as it should be in [$driver]", 1); }

       $DB_ACTIVE_GROUP = $GroupID;
       $db = require $driver;
       if ($dbconfig[$GroupID]['illuminate'] === TRUE && $Illuminate['ORM'] === TRUE) {
         $this->capsule = new Capsule;
          $this->capsule->addConnection([
              'driver'    => $dbconfig[$GroupID]['illuminatedriver'],
              'host'      => $dbconfig[$GroupID]['host'],
              'database'  => $dbconfig[$GroupID]['database'],
              'username'  => $dbconfig[$GroupID]['username'],
              'password'  => $dbconfig[$GroupID]['password'],
              'charset'   => $dbconfig[$GroupID]['charset'],
              'collation' => $dbconfig[$GroupID]['collation'],
              'prefix'    => $dbconfig[$GroupID]['prefix'],
          ]);
          $this->capsule->setEventDispatcher(new Illuminate\Events\Dispatcher(new Illuminate\Container\Container));
          $this->capsule->setAsGlobal();
          $this->capsule->bootEloquent();
       }
       if ($dbconfig[$GroupID]['driver'] === 'mysqli') {
         $db_data = array ('host' => $dbconfig[$GroupID]['host'],
                            'username' => $dbconfig[$GroupID]['username'],
                            'password' => $dbconfig[$GroupID]['password'],
                            'db'=> $dbconfig[$GroupID]['database'],
                            'port' => $dbconfig[$GroupID]['port'],
                            'prefix' => $dbconfig[$GroupID]['prefix'],
                            'charset' => $dbconfig[$GroupID]['charset']);
         $this->SQLManager[$GroupID] = new SQLManager($db_data);
         if ($dbconfig['QUERYBUILDER'] === TRUE) {
           $this->DBObject[$GroupID] = new DBObject();
          }
         $this->db[$GroupID] = ($dbconfig[$GroupID]['raw'] == TRUE) ?
         new mysqli( $dbconfig[$GroupID]['host'], $dbconfig[$GroupID]['username'], $dbconfig[$GroupID]['password'], $dbconfig[$GroupID]['database']) : NULL;
         $db = $this->db[$GroupID];
       }
       if (DEVELOPMENT_MODE === TRUE) {
         global $Framework;
         $Framework['db_connection'] = true;
         $Framework['db_drivers'][] = $dbconfig[$GroupID]['driver'];
         $Framework['dbs'][] = $dbconfig[$GroupID]['database'];
       }
       return true;
     } catch (Exception $e) {
      throw new \Exception($e->getMessage(), 1);
    }
   }


   public function Disconnect($GroupID = 'Default') {
     global $dbconfig, $Settings, $db;
     if ($dbconfig[$GroupID]['driver'] === 'mysqli') {
       if (is_object($this->db)) { $this->db->close(); $this->db = null; }
     $this->SQLManager->__destruct();
     $this->SQLManager = null;
     $this->DBObject = null;
     $db = null;
    }
   }


   public static function AddEloquent($File) {
     try {
       if (!is_dir(APP_ELOQUENTS_DIR)) {
         throw new \ErrorException("Eloquent dir is not exists.", 1);
       }
       if (!Contains($File, '.php')){ $File = $File.".php"; }
       $TruePath = APP_ELOQUENTS_DIR.$File;
       if (!file_exists($TruePath)){
         throw new \Exception("Error loading Eloquent: [$File], The Eloquent is not found!", 1); }
      $className = Load::getClassNameFromFile($TruePath);
      if (class_exists($className)){ throw new \Exception("Eloquent: [$File] is already loaded, Cannot load it twice.", 1); }
         require $TruePath;
      Runtime::Report('model', $className, $TruePath);
     } catch (Exception $e) {
       throw new \Exception($e->getMessage(), 1);
     }
   }


 }
