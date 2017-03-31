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
Class XSSProtection extends Controller
  {
    public $XREPLACE_SQL_FLAGS;
    public function __construct()
      {
        try {

          $this->XREPLACE_SQL_FLAGS = XREPLACE_SQL_FLAGS;
          $this->Run();
        } catch (Exception $e) {
          $this->Debugger->ShowError($e);
        }


      }
    public function Run()
      {
        if (AUTO_SECURE_GET) { $this->secureGet(); }
        if (AUTO_SECURE_POST) { $this->securePost(); }
        if (AUTO_SECURE_REQUEST) { $this->secureRequest(); }
        if (AUTO_SECURE_COOKIES) { $this->secureCookies(); }
        if (AUTO_SECURE_SESSIONS) { $this->secureSessions(); }
      }
    public function cleanThis($value, $REPLACE_TAGS = TRUE)
      {
        global $db; global $_REQUEST;
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        if ($db)
          {
            $value = $db->real_escape_string($value);
          }
          if ($REPLACE_TAGS) { $value = ReplaceDBQueries($value); }
        return $value;
      }
    public function secureGet()
      {
        global $_GET;
        if (isset($_GET))
        {
          foreach ($_GET as $key => $val)
          {
              if (!is_array($_GET[$key]))
                { $_GET[$key] = $this->cleanThis($val, $this->XREPLACE_SQL_FLAGS); }
          }
        }
        return $_GET;
      }
    public function securePost()
        {
          global $_POST;
          if (isset($_POST))
          {
            foreach ($_POST as $key => $val)
            {
                if (!is_array($_POST[$key]))
                  { $_POST[$key] = $this->cleanThis($val, $this->XREPLACE_SQL_FLAGS); }
            }
          }
          return $_POST;
        }
    public function secureRequest()
      {
        global $_REQUEST;
        if (isset($_REQUEST))
        {
          foreach ($_REQUEST as $key => $val)
          {
              if (!is_array($_REQUEST[$key]))
                { $_REQUEST[$key] = $this->cleanThis($val, $this->XREPLACE_SQL_FLAGS); }
          }
        }
        return $_REQUEST;
      }
    public function secureCookies()
        {
          global $_COOKIE;
          if (isset($_COOKIE))
          {
            foreach ($_COOKIE as $key => $val)
            {
                if (!is_array($_COOKIE[$key]))
                  { $_COOKIE[$key] = $this->cleanThis($val, $this->XREPLACE_SQL_FLAGS); }
            }
          }
          return $_COOKIE;
        }
    public function secureSessions()
      {
        global $_SESSION;
        if (isset($_SESSION))
        {
          foreach ($_SESSION as $key => $val)
          {
              if (!is_array($_SESSION[$key]))
                { $_SESSION[$key] = $this->cleanThis($val, $this->XREPLACE_SQL_FLAGS); }
          }
        }
        return $_SESSION;
      }


  }
