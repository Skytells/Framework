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
  Class Model
    {
      public $db;
      function __construct($Ref = "")
        {
          try {
            if (USE_SQL == FALSE)
              {
                throw new Exception("Warning: You're using Models while USQ_SQL Option is FALSE!, Please Turn it to TRUE from the Settings.php File.", 601);
              }

            $this->console = new Console();
            $this->db = new SQLManager($this->getDbConfig());
            global $_DB_CONNECTION_STATUS;
            $_DB_CONNECTION_STATUS = TRUE;

            $this->Database = new Database();
            $this->dbObject = new DBObject();
          } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);

          }

        }

      public function getDbConfig($ReturnObject = false)
        {
          $this->dbConfig = array (
                    'host' => DB_HOST,
                    'username' => DB_USER,
                    'password' => DB_PASS,
                    'db'=> DB_NAME,
                    'port' => DB_PORT,
                    'prefix' => DB_PREFIX,
                    'charset' => DB_CHARSET);
                    return $this->dbConfig;

        }


      public function getDatabase($OBJECT = TRUE)
        {
          global $db;
          $this->db = $db;

          $this->dbConfig = array (
            'host' => DB_HOST,
            'username' => DB_USER,
            'password' => DB_PASS,
            'db'=> DB_NAME,
            'port' => DB_PORT,
            'prefix' => DB_PREFIX,
            'charset' => DB_CHARSET);
            if (!isset($this->db) || !is_object($this->db)){
              $this->db = new SQLManager($this->dbConfig);
              }
            if ($OBJECT && is_object($db)) { return $db; }

            return $this->dbConfig;
         }


      public function __destruct() {

       }


    }
