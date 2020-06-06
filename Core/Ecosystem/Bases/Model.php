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
 Namespace Skytells\Wrappers;
 use Skytells\Core\Runtime;
 use Skytells\Database\Capsule\Manager as Capsule;
 Class Model {
   public  $SQLManager;
   public  $DBObject;
   public function __construct() {

   }
   public function Connect($GroupID = 'Default', $args = array()) {
     try {
       global $dbconfig, $Settings, $db, $DBGroups;
       $DriverName = $DBGroups[$GroupID]['driver'];
       if (!isset($args['join'])) {
         $driver = ENV_DRIVERS_DIR.'Database/'.$DBGroups[$GroupID]['driver'].'/Init.php';
         if (!file_exists($driver)) { throw new \ErrorException("DB Driver [$DriverName] selected on Group [$GroupID] is not found as it should be in [$driver]", 1); }
          $db = require $driver;
       }
       $DB_ACTIVE_GROUP = $GroupID;
       if ($DBGroups[$GroupID]['ORM']['enabled'] === TRUE) {
         $this->Capsule[$GroupID] = new Capsule;
          $this->Capsule[$GroupID]->addConnection(['driver' => $DBGroups[$GroupID]['ORM']['driver'],'host' => $DBGroups[$GroupID]['host'],
              'database'  => $DBGroups[$GroupID]['database'], 'username' => $DBGroups[$GroupID]['username'], 'password' => $DBGroups[$GroupID]['password'],
              'charset' => $DBGroups[$GroupID]['charset'], 'collation' => $DBGroups[$GroupID]['collation'], 'prefix' => $DBGroups[$GroupID]['prefix'],
          ]);
          $this->Capsule[$GroupID]->setEventDispatcher(new \Skytells\Events\Dispatcher(new \Skytells\Container\Container));
          $this->Capsule[$GroupID]->setAsGlobal();
          $this->Capsule[$GroupID]->bootEloquent();
       }
       if ($DBGroups[$GroupID]['driver'] === 'mysqli') {
         $db_data = array ('host' => $DBGroups[$GroupID]['host'], 'username' => $DBGroups[$GroupID]['username'], 'password' => $DBGroups[$GroupID]['password'],
                            'db'=> $DBGroups[$GroupID]['database'], 'port' => $DBGroups[$GroupID]['port'], 'prefix' => $DBGroups[$GroupID]['prefix'], 'charset' => $DBGroups[$GroupID]['charset']);
         if ($dbconfig['QUERYBUILDER'] === TRUE) {
           $this->SQLManager[$GroupID] = new \SQLManager($db_data);
           if ($dbconfig['DBOBJECT'] === TRUE) {
           $this->DBObject[$GroupID] = new \DBObject();
           }
          }
         $this->db[$GroupID] = ($DBGroups[$GroupID]['raw'] == TRUE) ?
         new \mysqli( $DBGroups[$GroupID]['host'], $DBGroups[$GroupID]['username'], $DBGroups[$GroupID]['password'], $DBGroups[$GroupID]['database']) : NULL;
         $db = $this->db[$GroupID];
       }
       if (DEVELOPMENT_MODE === TRUE) {
         global $Framework, $ConnectedDBS;
         $Framework['db_connection'] = true;
         $Framework['db_drivers'][] = $DBGroups[$GroupID]['driver'];
         $Framework['dbs'][] = $DBGroups[$GroupID]['database'];
         $ConnectedDBS++;
       }
       return $this;
     } catch (Exception $e) {
      throw new \Exception($e->getMessage(), 1);
    }
   }

   public function Join($GroupID = 'Default', $args = array()) {
     return $this->Connect($GroupID, Array('join' => true));
   }

   public function Disconnect($GroupID = 'Default') {
     global $dbconfig, $Settings, $db, $DBGroups;
     if ($DBGroups[$GroupID]['driver'] === 'mysqli') {
       if (is_object($this->db)) { $this->db->close(); $this->db = null; }
     $this->SQLManager->__destruct();
     $this->SQLManager = null;
     $this->DBObject = null;
     $db = null;
    }
   }

   public function AddEloquent($File) {
     try {
       if (!is_dir(APP_ELOQUENTS_DIR)) {
         throw new \ErrorException("Eloquent dir is not exists.", 1);
       }
       if (!Contains($File, '.php')){ $File = $File.".php"; }
       $TruePath = APP_ELOQUENTS_DIR.$File;
       if (!file_exists($TruePath)){
         throw new \Exception("Error loading Eloquent: [$File], The Eloquent is not found!", 1); }
      $className = \Load::getClassNameFromFile($TruePath);
      if (class_exists($className)){ throw new \Exception("Eloquent: [$File] is already loaded, Cannot load it twice.", 1); }
         require $TruePath;
      Runtime::Report('model', $className, $TruePath);
      return $this;
     } catch (Exception $e) {
       throw new \Exception($e->getMessage(), 1);
     }
   }

   public function AddMigration($File) {
     try {
       if (!is_dir(APP_MIGRATIONS_DIR)) {
         throw new \ErrorException("Eloquent dir is not exists.", 1);
       }
       if (!Contains($File, '.php')){ $File = $File.".php"; }
       $TruePath = APP_MIGRATIONS_DIR.$File;
       if (!file_exists($TruePath)){
         throw new \Exception("Error loading Migration: [$File], The Migration is not found!", 1); }
      $className = \Load::getClassNameFromFile($TruePath);
      if (class_exists($className)){ throw new \Exception("Migration: [$File] is already loaded, Cannot load it twice.", 1); }
         require $TruePath;
      Runtime::Report('model', $className, $TruePath);
      return $this;
     } catch (Exception $e) {
       throw new \Exception($e->getMessage(), 1);
     }
   }


   /**
    * @method inject
    */
   public function inject($Type, $File, $to = false, $args = [], $newName = '') {
     Kernel::Inject($Type, $File, $to, $args, $newName);
     return $this;
   }
 }
