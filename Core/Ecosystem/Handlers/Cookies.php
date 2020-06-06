<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 3.8
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
 Namespace Skytells\Handlers;
  Class Cookies {

    public static function instance() {
        return new Cookies();
      }
    function __construct() { }

    public static function set($Key, $Val, $time, $path = "/") {

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
          if (is_object($db) && get_class($db) == 'mysqli' && property_exists($db, 'real_escape_string')) {
             $Val = $db->real_escape_string($Val);
          }
        }
      return $Val;
    }

  }
