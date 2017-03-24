<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.1.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
  Class CSRFProtection extends Controller
    {
      public $cName;
      public function __construct()
        {
          $this->cName = "CSRFProtection";
        }
      public function generateToken()
        {
          @session_start();
          global $_SESSION;
          // Create a new CSRF token.
        //  if (! isset($_SESSION['CSRF_Token'])) {
              $_SESSION['CSRF_Token'] = md5(time() . uniqid());
            //  return $_SESSION['CSRF_Token'];
          //}
          return $_SESSION['CSRF_Token'];
        }

      public function InjectElement($name = "CSRF_Token")
        {
          echo '<input id="'.$name.'" hidden name="'.$name.'" value="'.$this->generateToken().'" />';
        }
      public function IsValidToken($Token)
        {
          global $_SESSION;
          if (isset($Token) && $Token === $_SESSION['CSRF_Token']) {
                return true;
            }
            return false;
        }

    }
