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
Class Database extends Controller
  {

    public $cName;
    public $IS_CONNECTED = FALSE;
    public $TOTAL_QUERIES = 0;

      public function __construct()
        {
          global $db;
          global $_SESSION;

          $this->cName = "Database";
          $this->Connect();
          return $this;
        }

      public function Connect()
      {
        try
          {
            global $db;

            if($db->connect_error)
            {
                $this->IS_CONNECTED = FALSE;
                return $this->Debugger->ShowException("Failed to connect with Database: " . $conn->connect_error);
            }else{
              $this->IS_CONNECTED = TRUE;
              $_DB_CONNECTION_STATUS = $this->IS_CONNECTED;
            }


          }
          catch(Exception $e)
            {
              $this->Debugger->ShowException($e->getMessage());
            }
        return $this->IS_CONNECTED;
      }

      public function Query($Query)
        {
          global $db;
          if (!isset($Query) || empty($Query))
            {
              die(Responder::ThrowError("Cannot Perform NULL MYSQLI Query", "DB", 1));
              return false;
            }
          if ($db->query($Query))
            {
              $this->countQuery();
              return $db->query($Query);
            }else {
              return false;
            }
        }

      public function Insert($TABLE, $FIELD, $VALUE)
        {
            global $db;
            $this->countQuery();
            $SQL = $db->query("INSERT INTO $TABLE ($FIELD) VALUES ($VALUE)")
            or die (DB::Response(false,$db->error, $db->ErrorException));
            if ($SQL)
              {
                return $db->insert_id;
              }else{ return false; }
        }

      public function NumRows($QUERY)
        {
          global $db;
          if ($result = $db->query($QUERY))
          {
              $this->countQuery();
              $row_cnt = $result->num_rows;
              return $row_cnt;
          }else{ return false; }
        }

      public function Fetch($Query, $IS_ARRAY = FALSE)
        {
          global $db;
          if ($SQL = DB::Query($Query))
            {
              if ($IS_ARRAY == false)
                {
                  $this->countQuery();
                  $Result = $SQL->fetch_assoc();
                  return $Result;
                }else {
                  $Array = Array();
                  while ($row = $SQL->fetch_assoc())
                    {
                      array_push($Array, $row);
                    }
                  $this->countQuery();
                  return $Array;
                }
            }
        }

        // MySQLi Insert Array
      public function InsertArray($TABLE, $ARRAY)
        {
          if (!$ARRAY) { return false; }

          $Keys = ""; $Values = "";
          $Count = count($ARRAY);
          $DataCount = 0;
          foreach($ARRAY as $Key => $Value)
            {
              $DataCount = $DataCount +1;
              if ($Count == $DataCount)
                 {
                   $Keys = $Keys.$Key;
                   $Values = $Values."'".addslashes($Value)."'";
                 }else
                 {
                   $Keys = $Keys.$Key.",";
                   $Values = $Values."'".addslashes($Value)."',";
                 }
              }
               // INSERT
        global $db;

        if ($db->query("INSERT INTO $TABLE ($Keys) VALUES ($Values)"))
            {
              $this->countQuery();
              return $db->insert_id;
            }
            else
            {
              echo ($db->error);
              return false;
            }
        }



        public function UpdateArray($TABLE, $ARRAY, $WHERE)
          {
            if (!$ARRAY) { return false; }

            $Keys = ""; $Values = "";
            $Count = count($ARRAY);
            $DataCount = 0;
            $QUR = "";
            foreach($ARRAY as $Key => $Value)
              {
                $DataCount = $DataCount +1;
                if ($Count == $DataCount)
                   {
                     $QUR = $QUR.$Key."='".addslashes($Value)."'";
                     $Keys = $Keys.$Key;
                     $Values = $Values."'".addslashes($Value)."'";
                   }else
                   {
                     $QUR = $QUR.$Key."='".addslashes($Value)."',";
                     $Keys = $Keys.$Key.",";
                     $Values = $Values."'".addslashes($Value)."',";
                   }
                }
                 // INSERT
          global $db;
        //  return "UPDATE $TABLE SET $QUR WHERE $WHERE";
          if ($db->query("UPDATE $TABLE SET $QUR WHERE $WHERE"))
              {
                $this->countQuery();
                return $db->insert_id;
              }
              else
              {
                echo ($db->error);
                return false;
              }
          }

      // UPDATE Field
      public function Update($TABLE, $FIELD, $VALUE, $ID_KEY, $ID_VALUE)
        {
          global $Settings; global $db;
          $SQL = $db->query("UPDATE $TABLE SET $FIELD='$VALUE' WHERE $ID_KEY='$ID_VALUE'");
          if ($SQL) { $this->countQuery(); return true; }else { return false; }
        }

      // Responses
      public function Response($Status, $Response, $Code)
        {
          $RS["status"] = $Status;
          $RS["response"] = $Response;
          $RS["code"] = $Code;
          return JEncode($RS);
        }

      // Fix and Repair the Tables
      public function Fix($REPAIR = TRUE, $OPTIMIZE = TRUE, $LIMIT = FALSE)
       {
          global $DBCONFIG; global $db;
          $DB_NAME = $DBCONFIG["NAME"];
          $ArrRepair = Array();   $ArrOpt = Array();
          $Tables = $db->query("SHOW TABLES FROM $DB_NAME");
          while ( $r = $Tables->fetch_array() )
           {
             if ($REPAIR == TRUE)
              {
                $Act = $db->query("REPAIR TABLE {$r[0]}");
                $Res = $Act->fetch_assoc();
                array_push($ArrRepair, str_replace("$DB_NAME.", "",$Res));
              }
            if ($OPTIMIZE == TRUE)
               {
                 $Act = $db->query("OPTIMIZE TABLE {$r[0]}");
                 $Res = $Act->fetch_assoc();
                 array_push($ArrOpt, str_replace("$DB_NAME.", "",$Res));
                // array_push($ArrOpt, $r);
               }
           }
           $this->countQuery();
          $Tables->free();
          $Dt["repair"] = $ArrRepair;
          $Dt["optimize"] = $ArrOpt;
          $Row["data"] = $Dt;
          $Row["status"] = TRUE;
          return JEncode($Row, TRUE);
        }

      public function countQuery()
        {
          $this->TOTAL_QUERIES++;
          global $_SESSION;
          $_SESSION["DB_QUERIES_C"] = $this->TOTAL_QUERIES;

        }
  }
