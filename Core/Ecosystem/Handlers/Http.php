<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.1
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 Namespace Skytells\Handlers;
  Class Http {

    function __construct() {
    }

    /**
     * Determine if this is a secure HTTPS connection
     *
     * @return  bool    True if it is a secure HTTPS connection, otherwise false.
     */
    public static function isSSL() {
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS'] == 1) {
                return true;
            } elseif ($_SERVER['HTTPS'] == 'on') {
                return true;
            }
        }
        return false;
    }




  }



 ?>
