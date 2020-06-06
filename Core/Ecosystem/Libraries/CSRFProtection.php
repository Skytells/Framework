<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.9
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 Class CSRFProtection {
      public function generateToken() {
          @session_start();
          global $_SESSION;
          $_SESSION['CSRF_Token'] = md5(time() . uniqid());
          return $_SESSION['CSRF_Token'];
        }
      public function InjectElement($name = "CSRF_Token") {
          echo '<input id="'.$name.'" hidden name="'.$name.'" value="'.$this->generateToken().'" />';
        }
      public function IsValidToken($Token) {
          global $_SESSION;
          if (isset($Token) && $Token === $_SESSION['CSRF_Token']) {
                return true;
            }
            return false;
        }
 }
