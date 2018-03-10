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
Class Uri {
  private static $IN;
  private static $CurrentValue;
  private static $DefaultReturn  = 'SELF';
  private static $instance;

  public static function getInstance() {
    if (!is_object( Uri::$instance)) { Uri::$instance = new Uri();  }
    return Uri::$instance;
  }


  public function __call($method, $arguments = []) {
      return call_user_func_array(array(Uri::getInstance(), $method), $arguments);
  }

  public static function __callStatic($method, $arguments = []) {
      return call_user_func_array(array(Uri::getInstance(), $method), $arguments);
  }

  public static function get($Key, $ReturnType = 'default') {
    global $_GET;
    return Uri::getData($_GET, $Key, $ReturnType);
  }

  public static function post($Key, $ReturnType = 'default') {
    global $_POST;
    return Uri::getData($_POST, $Key, $ReturnType);
  }

  public static function request($Key, $ReturnType = 'default') {
    global $_REQUEST;
    return Uri::getData($_REQUEST, $Key, $ReturnType);
  }

  public static function put($Key, $ReturnType = 'default') {
    if($_SERVER['REQUEST_METHOD'] == 'PUT') {
      parse_str(file_get_contents("php://input"), $post_vars);
      return Uri::getData($post_vars, $Key, $ReturnType);
    }
  }

  public static function toString($Value = '') {
    if ($Value == '' || empty($Value)) { $Value = Uri::$CurrentValue; }
    $Value = htmlspecialchars($Value, ENT_QUOTES, 'UTF-8');
    return $Value;
  }

  public static function toInt($Value = '') {
    if ($Value == '' || empty($Value)) { $Value = Uri::$CurrentValue; }
    $Value = (int)$Value;
    return $Value;
  }

  public static function toFloat($Value = '') {
    if ($Value == '' || empty($Value)) { $Value = Uri::$CurrentValue; }
    $Value = (float)$Value;
    return $Value;
  }

  public static function toArray($Value = '') {
    if ($Value == '' || empty($Value)) { $Value = Uri::$CurrentValue; }
    $ValueArray = [$Value];
    return $ValueArray;
  }

  public static function in($ArrayName) {
    $ArrayName = strtolower($ArrayName);
    switch ($ArrayName) {
      case 'post':
        Uri::$IN = $ArrayName;
        break;
      case 'get':
        Uri::$IN = $ArrayName;
        break;
      case 'request':
        Uri::$IN = $ArrayName;
        break;
      default:
          Uri::$IN = 'request';
        break;
    }
    return Uri::getInstance();
  }

  public function exists($Key, $Object = false) {
    if (!is_array($Object)) { $Object = $_REQUEST; }
    switch (Uri::$IN) {
      case 'post':
        if (isset($_POST[$Key])) { return true; } else { return false; }
        break;
      case 'get':
        if (isset($_GET[$Key])) { return true; } else { return false; }
        break;
      case 'request':
        if (isset($_REQUEST[$Key])) { return true; } else { return false; }
        break;
      default:
        if (isset($Object[$Key])) { return true; } else { return false; }
        break;
      }
      return false;
  }


  public static function setReturnType($Type) {
    Uri::$DefaultReturn = $Type;
    return Uri::getInstance();
  }


  public static function getData($Array, $Key, $ReturnType = 'SELF') {
    $Returns = ['bool', 'default', 'exist', 'exists', 'string', 'int', 'quick'];
    if (!in_array($ReturnType, $Returns)) { $ReturnType = Uri::$DefaultReturn; }
    if ($ReturnType == 'quick' || Uri::$DefaultReturn == 'quick') { $ReturnType = 'default'; }
    if (isset($Array[$Key])) {
      Uri::$CurrentValue = $Key;
      switch ($ReturnType) {
        case 'SELF':
          return Uri::getInstance();
          break;
        case 'bool':
          return (bool)$Key;
          break;
        case 'exist':
            return true;
          break;
        case 'exists':
            return true;
          break;
        case 'string':
          $Key = htmlspecialchars($Array[$Key], ENT_QUOTES, 'UTF-8');
          return (string)$Key;
          break;
        case 'int':
          $Key = (is_numeric($Array[$Key])) ? $Array[$Key] : false;
          return (string)$Key;
          break;

        case 'default':
          $Key = htmlspecialchars($Array[$Key], ENT_QUOTES, 'UTF-8');
          return (string)$Key;
          break;

        default:
          $Key = htmlspecialchars($Array[$Key], ENT_QUOTES, 'UTF-8');
          return $Key;
          break;
      }
    }
    return false;
  }


}
