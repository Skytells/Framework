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
  function Request($value = null, $REPLACE_TAGS = TRUE)
    {
      global $db; global $_REQUEST;
      if (!isset($_REQUEST) || empty($_REQUEST) || !isset($_REQUEST[$value]) || empty($_REQUEST[$value]))
        {
          return false;
        }
      $value = $_REQUEST[$value];
      $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
      if ($db)
        {
          $value = $db->real_escape_string($value);
        }
      if ($REPLACE_TAGS) { $value = ReplaceDBQueries($value); }
      return $value;
    }

  function Get($value = null, $REPLACE_TAGS = TRUE)
      {
        global $db; global $_GET;
        if (!isset($_GET) || empty($_GET) || !isset($_GET[$value]) || empty($_GET[$value]))
          {
            return false;
          }
        $value = $_GET[$value];
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        if ($db)
          {
            $value = $db->real_escape_string($value);
          }
        if ($REPLACE_TAGS) { $value = ReplaceDBQueries($value); }
        return $value;
      }

  function Post($value = null, $REPLACE_TAGS = TRUE)
      {
            global $db; global $_POST;
            if (!isset($_POST) || empty($_POST) || !isset($_POST[$value]) || empty($_POST[$value]))
              {
                return false;
              }
            $value = $_POST[$value];
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            if ($db)
              {
                $value = $db->real_escape_string($value);
              }
            if ($REPLACE_TAGS) { $value = ReplaceDBQueries($value); }
            return $value;
      }

  function getCookie($value = null, $REPLACE_TAGS = TRUE)
      {
        global $db;
        global $_COOKIES;
        if (!isset($_COOKIES) || empty($_COOKIES) || !isset($_COOKIES[$value]) || empty($_COOKIES[$value]))
          {
            return false;
          }
        $value = $_COOKIES[$value];
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        if ($db)
          {
            $value = $db->real_escape_string($value);
          }
        if ($REPLACE_TAGS) { $value = ReplaceDBQueries($value); }
        return $value;
      }

  function ReplaceDBQueries($String)
      {
        $String = str_replace(array('SELECT *', 'SELECT id', 'SELECT password', 'UPDATE users', 'UPDATE messages', 'DROP ', 'DELETE FROM ', '--;', ';--',
                                    '(SELECT','UPDATE users', 'update ', 'select *', 'select id', 'select name', 'select password', '(select', 'drop ',
                                    'delete from ', 'union (', 'union(','.TABLE', '.table', '% select', '% SELECT'), "", $String);
        if(!empty($inp) && is_string($inp)) {
        $String =  str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $String);
          }
        return $String;
      }

  function getUrl()
    {
      $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      return $actual_link;
    }

  function checkBrowser($checkCookies = false, $checkJavascript = false)
    {
      global $_SERVER;
      if (!isset($_SERVER)){ return false; }

        $res = $_SERVER['HTTP_USER_AGENT'];
      if (empty($res) || $res == "unknown") { return false; }
      if ($checkCookies == true && $res["cookies"] == 0) { return false; }
      if ($checkJavascript == true && $res["javascript"] == 0) { return false; }

      return true;
    }

  function show_404()
    {
      header("HTTP/1.0 404 Not Found");
      require SYS_VIEWS.'/html/404.html';
      exit;
    }

  function isAjax() {
      if( !isset($_SERVER['HTTP_X_REQUESTED_WITH']) || ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') ) {
          return false;
      }
      return true;
  }

  function return_json($response = '') {
    header('Content-Type: application/json');
    exit(json_encode($response));
  }
