<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 3.7
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
 Namespace Skytells\Handlers;
  Class Session
  {
    public static function instance() {
        return new Session();
      }
    function __construct() {
     }

    public static function set($Key, $Val) {
      global $_SESSION;
      $_SESSION[$Key] = $Val;
      return true;
    }

    public static function get($Key, $Protection = true) {
      global $_SESSION; global $db;
      if (!isset($_SESSION) || empty($_SESSION)) { return false; }
      if (!isset($_SESSION[$Key]) || empty($_SESSION[$Key])) { return false; }
      $Val = $_SESSION[$Key];
        if ($Protection == true) {
        $Val = htmlspecialchars($Val, ENT_QUOTES, 'UTF-8');
        if (is_object($db) && get_class($db) == 'mysqli') {
           $Val = $db->real_escape_string($value);
        }
        $Val = stripSlashesDeep($Val);
        }
      return $Val;
    }

  }
