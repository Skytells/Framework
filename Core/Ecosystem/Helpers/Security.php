<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.7
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */

function htmlEncode($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
  }


 /* ------------------------------- */
 /* Security */
 /* ------------------------------- */

 /**
  * secure
  *
  * @param string $value
  * @param string $type
  * @param boolean $quoted
  * @return string
  */
 function secure($value, $type = "", $quoted = true) {
     global $db, $dbconfig;
     if($value !== 'null') {
         // [1] Sanitize //
         /* Escape all (single-quote, double quote, backslash, NULs) */
         if(get_magic_quotes_gpc()) {
             $value = stripslashes($value);
         }
         /* Convert all applicable characters to HTML entities */
         $value = htmlentities($value, ENT_QUOTES, 'utf-8');
         // [2] Safe SQL //
        if (is_object($db) && get_class($db) == 'mysqli') {
           $value = $db->real_escape_string($value);
        }
         switch ($type) {
             case 'int':
                 $value = ($quoted)? intval($value) : intval($value);
                 break;
             case 'datetime':
                 $value = ($quoted)? set_datetime($value) : set_datetime($value);
                 break;
             case 'search':
                 if($quoted) {
                     $value = (!is_empty($value))? "%".$value."%" : "";
                 } else {
                     $value = (!is_empty($value))? "%%".$value."%%" : "";
                 }
                 break;
             default:
                 $value = (!is_empty($value))? $value : "";
                 break;
         }
     }
     return $value;
 }

 function stripSlashesDeep($value) {
           $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
           return $value;
 }

 function removeMagicQuotes() {
     if ( get_magic_quotes_gpc() ) {
         $_GET    = stripSlashesDeep($_GET   );
         $_POST   = stripSlashesDeep($_POST  );
         $_COOKIE = stripSlashesDeep($_COOKIE);
     }
  }
