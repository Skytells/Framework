<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.2.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
  Class Cookies
  {
    public static function instance() {
        return new Cookies();
      }
    function __construct() {
     }

    public static function set($Key, $Val, $time, $path = null) {

        global $_COOKIE;
        if ($path == null){
        setcookie($Key, $Val, $time);
        }else{
          setcookie($Key, $Val, $time, $path);
        }
        return true;
    }

    public static function get($Key, $Protection = true) {
      global $_COOKIES; global $_COOKIE; global $db;
      if (!isset($_COOKIE) || empty($_COOKIE)) { return false; }
      if (!isset($_COOKIE[$Key]) || empty($_COOKIE[$Key])) { return false; }
      $Val = $_COOKIE[$Key];
        if ($Protection == true) {
        $Val = htmlspecialchars($Val, ENT_QUOTES, 'UTF-8');
        if ($db && USE_SQL){
            $Val = $db->real_escape_string($Val);
          }
        $Val = stripSlashesDeep($Val);
        }
      return $Val;
    }

  }
