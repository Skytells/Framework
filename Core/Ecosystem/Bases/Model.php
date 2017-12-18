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

 Class Model {
   public  $SQLManager;
   public  $DBObject;
   public $LoadedDrivers = Array();

   public function __construct($args = array()) {
    }


   public function Connect($GroupID = 'Default', $args = array()) {
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


   public function Disconnect($GroupID = 'Default') {
     global $dbconfig, $Settings, $db;
     if ($dbconfig[$GroupID]['dbdriver'] === 'mysqli') {
       if (is_object($this->db)) { $this->db->close(); $this->db = null; }
     $this->SQLManager->__destruct();
     $this->SQLManager = null;
     $this->DBObject = null;
     $db = null;
    }
   }



 }
